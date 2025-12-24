<?php

# users

$up[] = 'CREATE TABLE nano_users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,

    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,

    created_at TEXT NOT NULL
);';

$down[] = 'DROP TABLE IF EXISTS nano_users';
