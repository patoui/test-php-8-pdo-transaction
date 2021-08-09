## PHP 8 transaction issue

Transaction fatal error

```
Fatal error: Uncaught PDOException: There is no active transaction
```

This is caused by a backwards compatibility change in PHP 8.0 for PDO MySQL, here is the excerpt from the documentation:

"PDO::inTransaction() now reports the actual transaction state of the connection, rather than an approximation maintained by PDO. If a query that is subject to "implicit commit" is executed, PDO::inTransaction() will subsequently return false, as a transaction is no longer active."

Link for the above [migration to 8.0](https://www.php.net/manual/en/migration80.incompatible.php)

### Steps to reproduce

#### 1. Clone this repository

```
git clone git@github.com:patoui/test-php-8-pdo-transaction
```

After cloning, change to the directory `cd test-php-8-pdo-transaction`

#### 2. Start docker

```
docker-compose up
```

#### 3. Run script against PHP 7.4 container

Will work without error (container running php 7.4.11)

```
docker exec -it tppt_php74 php index.php 74
```

#### 4. Run script against PHP 8.0 container

Will trigger fatal error (container running php 8.0.9)

```
docker exec -it tppt_php8 php index.php 8
```

Error should look similar to

```
Fatal error: Uncaught PDOException: There is no active transaction in /var/www/index.php:21
Stack trace:
#0 /var/www/index.php(21): PDO->commit()
#1 {main}
  thrown in /var/www/index.php on line 21
```

#### 5. Enter MySQL CLI

```
docker exec -it tppt_mysql mysql -uroot --password="strong-password" -D 'tppt'
```

#### 6. Display tables

See both of the above runs have worked but PHP 8.0 reports a fatal error

```
show tables;
```

Should look similar to:

```
mysql> show tables;
+----------------+
| Tables_in_tppt |
+----------------+
| users_74       |
| users_8        |
+----------------+
2 rows in set (0.00 sec)
```

See `index.php` for code to reproduce the issue
