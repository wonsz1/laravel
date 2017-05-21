# Simple amp(apache, mysql, php) server using Docker

### How to use

```bash
git clone https://github.com/wonsz1/docker_amp.git
cd docker_amp/
docker-compose up -d
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

