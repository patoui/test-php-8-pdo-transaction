<?php

declare(strict_types=1);

$v = $_SERVER['argv'][1] ?? '';

$pdo = new PDO('mysql:host=tppt_mysql;port=3306;dbname=tppt;charset=utf8mb4', 'root', 'strong-password');

$pdo->beginTransaction();
// Demonstration purposes ONLY, do not inject values into SQL like this.
$pdo->exec("CREATE TABLE IF NOT EXISTS users_$v (id BIGINT UNSIGNED NOT NULL)");

/**
 * In PHP 8 this will trigger the following fatal error:
 * Fatal error: Uncaught PDOException: There is no active transaction in /var/www/index.php:21
 * Stack trace:
 *  #0 /var/www/index.php(21): PDO->commit()
 *  #1 {main}
 *  thrown in /var/www/index.php on line 21
 */
$pdo->commit();
