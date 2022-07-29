# TesteSignoWeb

Instruções de execução:
* git clone https://github.com/raryelcostasouza/TesteSignoWeb.git
* cd TesteSigno/blog 
* Copiar o arquivo .env-example para .env
* Atualizar arquivo .env com o nome do banco de dados MySQL, login e senha
    * DB_DATABASE=
    * DB_USERNAME=
    * DB_PASSWORD=
* composer install && npm install
* php artisan migrate
* php artisan serve
* Acessar http://localhost:8000/