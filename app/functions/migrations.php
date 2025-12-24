<?php

use App\Core\Data;

define('MIGS_FILE', APP . 'data/migs.json');
define('MIGS_DIR', APP . 'data/');

function read_migs(): array {
    return file_exists(MIGS_FILE) ? json_decode(file_get_contents(MIGS_FILE), true) : [];
}

function save_migs(array $migs): void {
    file_put_contents(MIGS_FILE, json_encode($migs, JSON_PRETTY_PRINT));
}

function load_migration(string $file): array {
    $up = $down = [];
    include MIGS_DIR . "$file.php";
    return compact('up', 'down');
}

function alert(array $migrations, string $action = 'executadas'): void {
    if (empty($migrations)) {
        echo "\033[32mNenhuma migration pendente.\033[0m\n";
        exit;
    }

    echo "As seguintes migrations serão $action:\n";
    foreach ($migrations as $m) {
        echo "\033[33m- $m\033[0m\n";
    }

    echo "Deseja continuar? [s/N] ";
    $continue = strtolower(trim(fgets(STDIN)));
    if ($continue !== 's') {
        exit;
    }
}

function migrate(string $file, array &$migs, bool $up = true) {
    $mig = load_migration($file);
    $sqls = $up ? $mig['up'] : $mig['down'];
    foreach ($sqls as $sql) {
        if (!($u = Data::query($sql))) {
            return false;
        }
    }
    if ($up) {
        $migs[$file] = time();
        return true;
    }
    unset($migs[$file]);
    return true;
}

function up($n = PHP_INT_MAX): void {
    $all = array_map(fn($f) => basename($f, '.php'),glob(MIGS_DIR . '*.php'));

    $migs = read_migs();

    $pending = array_slice(array_diff($all, array_keys($migs)),0,$n);

    alert($pending, 'executadas');

    foreach ($pending as $file) {
        if (migrate($file, $migs, true)) {
            echo "\033[32mMigration $file executada.\033[0m\n";
        } else {
            echo "\033[31mFalha ao executar migration $file.\033[0m\n";
            save_migs($migs);
            exit;
        }
    }
    save_migs($migs);
}

function down($n = 1): void {
    $migs = read_migs();
    $n = $n ? $n : 1;
    $loaded = array_slice(array_reverse(array_keys($migs)),0,$n);

    alert($loaded, 'revertidas');

    foreach ($loaded as $file) {
        if (migrate($file, $migs, false)) {
            echo "\033[32mMigration $file revertida.\033[0m\n";
        } else {
            echo "\033[31mFalha ao reverter migration $file.\033[0m\n";
            save_migs($migs);
            exit;
        }
    }
    save_migs($migs);
}

function create($migrate){
    $mig_name = date('ymdHi_') . slugify($migrate,'_');
    $ctn = file_get_contents(APP . 'data/migration.lock');
    $ctn = str_replace('[migration]',$migrate,$ctn);
    return file_put_contents(APP . 'data/' . $mig_name . '.php', $ctn) ? $mig_name : false;
}
