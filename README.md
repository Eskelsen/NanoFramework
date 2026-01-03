# NanoFramework
Smallest PHP framework

## Instalação
Clone o repositório
```shell
git clone https://github.com/Eskelsen/NanoFramework.git .
```
Rode o composer
```shell
composer install
```
Crie o arquivo de configurações a partir do modelo
```shell
cp app/config.lock app/config.php
```
---
> ⚠️ Configure as constantes conforme necessário.
---
Rode as migrations
```shell
php app/nano mig up
```
