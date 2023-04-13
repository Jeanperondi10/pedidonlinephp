# Ambiente de desenvolvimento com Docker + PHP FPM 8.1.x + Composer + Nginx + MariaDB

## Requisitos

* Docker
* Docker compose

## Docker

Crie um arquivo `.env` com o conte�do de `.env-sample`.

### Buildar os Containers:

`docker-compose up -d --build`

### Parar todos os Containers:

`docker-composer down -v` 

### Remover todos os Containers parados:

`docker system prune`

### Acessar o Container do MariaDB e ter acesso ao banco:

`docker exec -it mariadb bash`

# Acessar banco

`mysql -h localhost -u user -p`

### Acessar aplica��o:

`localhost:8888`

# Composer

## Instalar

`docker-compose run --rm php-fpm composer install `

## Requerir pacote:

`docker-compose run --rm php-fpm composer require autor/pacote`

## Limpar docker 
`docker-compose down`
`docker rm -f $(docker ps -a -q)`
`docker volume rm $(docker volume ls -q)`
`docker-compose up -d`

<!-- Permissão diretório escrita --> 
`sudo chown -R username directory_name`
`find /var/www/public/ -type d -exec chmod 755 {} \;`
`find /var/www/public/ -type f -exec chmod 644 {} \;`


# É necessário criar o .env na raiz 