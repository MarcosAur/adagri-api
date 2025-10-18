# ADAGRI-API

API do sistema **ADAGRI**, desenvolvida em **Laravel**, com ambiente totalmente containerizado via **Docker Compose**.  

---

## Tecnologias Principais

- [Laravel 12+](https://laravel.com)
- [PHP 8.3+](https://www.php.net/)
- [PostgreSQL](https://www.postgresql.org/)
- [Composer](https://getcomposer.org/)
- [Docker Compose](https://docs.docker.com/compose/)

---

## Instruções de Instalação

- Executar o comando para que os containers sejam carregados
```bash
docker compose up -d
```

- Acessar o container para rodar os comandos de instalação do laravel. Esse passo não foi executado diretamente na inicialização do container caso seja necessária alguma modificação de portas ou configurações relacionadas ao projeto

```bash
docker exec -it application_api bash
composer install
php artisan migrate
php artisan db:seed
php artisan storage:link
```