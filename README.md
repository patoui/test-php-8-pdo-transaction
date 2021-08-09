## PHP 8 transaction issue

Steps to reproduce using this repository:

1. Clone this repository

```
git clone git@github.com:patoui/test-php-8-pdo-transaction
```

2. Start docker

```
docker-compose up
```

3. Run script against PHP 7.4 container, will work without error (container running php 7.4.11)

```
docker exec -it tppt_php74 /bin/bash -c "php index.php 74"
```

4. Run script against PHP 8.0 container, will trigger fatal error (container running php 8.0.9)

```
docker exec -it tppt_php8 /bin/bash -c "php index.php 8"
```
5. Enter MySQL CLI

```
docker exec -it tppt_mysql mysql -uroot --password="strong-password" -D 'tppt'
```

6. Display tables to see both of the above runs have worked but PHP 8 reports a fatal error

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
