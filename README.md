## Requirements

- [Git](https://git-scm.com/downloads)
- [PHP ^8.2](https://www.php.net/manual/en/install.php)
- [Composer](https://getcomposer.org/download/)
- [Docker](https://docs.docker.com/desktop/)

## Installation

Clone this repository using git.

```bash
git clone https://github.com/the-repository-url
```

Install Laravel dependency.

```bash
composer install
```

In Laravel 11.x, when you install dependencies, the `.env.example` file will automatically
be copied to `.env`. However, if the `.env` file does not exist, you can copy it manually.

```bash
cp .env.example .env
```

Generate Laravel key.

```bash
php artisan key:generate
```

In Laravel 11.x, when you install dependencies, a `database.sqlite` file will automatically be created in the
`database/`
folder, and migrations will be run automatically. However, if this hasn't been done, you can do it manually.

```bash
// create database.sqlite
touch database/database.sqlite
// run the migrations
php artisan migrate
```

Run the essentials seeder

```bash
// User seeder for creating default user
php artisan db:seed --class=UserSeeder
// Settings seeder for default configuration
php artisan db:seed --class=SettingSeeder
```

After you run the migration, here the default credentials for you to login
- **email:** _admin@admin.com_
- **password:** _password_

## Run the project

You can run the project with laravel artisan or using docker

- With artisan

```bash
php artisan serve
```

- With docker

```bash
docker compose up -d
```

Project location:

| Method  |       Location        |
|:-------:|:---------------------:|
| artisan | http://localhost:8000 |
| docker  | http://localhost:1020 |

## Deployment

- Create `nginx/conf.d/` folder in your project. Add `app.conf` file with content in below.

```nginx configuration
server {
	listen 80;
	listen [::]:80;

	root /var/www/web/public;

	index index.php;

	charset utf-8;

	error_log /var/log/nginx/error.log;
	access_log /var/log/nginx/access.log;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
        gzip_static on;
    }

	location ~ \.php$ {
	    try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass php:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
	}
}
```

- Create `php/` folder in your project. Add `local.ini` file without any content. If you want to set
  custom php configuration you can add the content inside `local.ini`.


- Create `docker-compose.yml`

```yaml
services:
    web-server:
        image: nginx:latest
        container_name: web-server
        restart: unless-stopped
        tty: true
        ports:
            - "1020:80"
        volumes:
            - larapay_source:/var/www/web
            - ./nginx/conf.d:/etc/nginx/conf.d
        links:
            - php
        networks:
            - laravel_docker-net

    php:
        image: akmalmp241/larapay-php8.3-fpm
        container_name: php_docker
        restart: unless-stopped
        working_dir: /var/www/web
        tty: true
        environment:
            SERVICE_NAME: php
            SERVICE_TAGS: dev
        volumes:
            - larapay_source:/var/www/web
            - ./php/local.ini:/usr/local/php/etc/php/conf.d/local.ini
        networks:
            - laravel_docker-net

volumes:
    larapay_source:
        name: larapay_source

networks:
    laravel_docker-net:
        driver: bridge
```

You can use your own docker image. Change `akmalmp241/larapay-php8.3-fpm` to your own image.

- Run `docker compose up -d`. Your app will run in port `:1020`. If you want to make the app
  run in port `:80` you can edit `docker-compose.yml` like in below.

```yaml
        ports:
            - "80:80"
```

This makes your app that was previously running on port `:1020` run on port `:80`.
