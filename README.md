# TesteSignoWeb

Instruções de execução:
* git clone https://github.com/raryelcostasouza/TesteSignoWeb.git
* cd blog 
* Atualizar arquivo .env com o nome do banco de dados MySQL, login e senha
    * DB_DATABASE=
    * DB_USERNAME=
    * DB_PASSWORD=
* php artisan migrate
* php artisan serve
* Acessar https://localhost:8000/