## About Project

Video Project using:

- PHP 8.1
- Laravel 9
- Mysql 8
- Docker

## Installation
For start project, you need to install docker and docker-compose, after that you can run this command :

```bash
docker-compose up -d
```
```bash
docker exec myapp composer install
```
```bash
docker exec myapp php artisan migrate --seed
```
```bash
docker exec myapp php artisan key:generate
```

## Extend Artisan Commands
```bash
docker exec myapp php artisan season:reating
```



