# Simple laravel ecommerce based on amp(apache, mysql, php) server using Docker

### How to use

```bash
git clone https://github.com/wonsz1/laravel.git
if you want your database data persist then configure proper volumes for db in docker-compose.yml
cd laravel
docker-compose up -d
docker exec -it docker_id bash
you can get docker_id by command `docker ps` which list containers
php artisan make:migrations 
go to http://localhost:8000/public/
```
### Additional

You should setup proper path in docker-composer.yml for html and mysql

### Component Versions

| Component |     Version       |
|-----------|-------------------|
|Apache     | `2.4.10 (Debian)` |
|MySQL      | `mysql:5.7`       |
|PHP        | `php:5.6-apache`  |
|phpMyAdmin | `4.7.0`           |

