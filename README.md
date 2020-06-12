# URL SHORTENER

## How to start

1. If you don't have it already, [install Composer](https://getcomposer.org/download/).
2. Run `composer install`
3. Create database (see instructions below)
4. See the following usage instructions

## CLI usage

`cd src`

`php Router.php 'url'`

Examples:
- `php Router.php 'https://www.google.com'`
- `php Router.php 'https://drive.google.com?utm_source=linkedin&utm_medium=social&utm_campaign=get-drive&utm_content=get'`


### Create database

```SQL
CREATE DATABASE `url_shortener` DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
```

### Create tables

```SQL
use `url_shortener`;

CREATE TABLE `shortUrl` ( 
    `id` INT AUTO_INCREMENT,
    `originalUrl` VARCHAR(255) NOT NULL,
    `shortUrl` VARCHAR(255) NOT NULL,
    `utmCampaign` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `urlCounter` ( 
    `utmCampaign` VARCHAR(255),
    `count` INT NOT NULL,
    PRIMARY KEY (`utmCampaign`)
) ENGINE=InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

```

### Configuration file to connect to database

> Create a new file :\

>`.env`
>
> Copy the contents of the file .env.example and replace credentials
>
```
DATABASE = 'mysql'
DATABASE_HOST = 'localhost'
DATABASE_NAME = 'url_shortener'
DATABASE_USER = 'root'
DATABASE_PASSWORD = ''
```
