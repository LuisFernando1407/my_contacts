<h3>Requisitos</h3>

- PHP 7.1 ou superior
- Composer [https://getcomposer.org/]
- MySQL 5.3 ou superior
- Apache 2.4

<h3>Instalação</h3>

- Acesse a pasta do projeto e crie um arquivo **_.env_** (no mesmo ninvel do arquivo **_.env.example_**)
- Copie tudo que tem no arquivo **_.env.example_** e coloque dentro do arquivo **_.env_** (Nessa etapa configure o arquivo **_.env_** com as informações do seu banco de dados)
- Acesse a paste do projeto via terminal em seguida execute o comando **composer install**
- Após execução do comando execute **php artisan key:generate**

<h3>Criação das tabelas (DB)</h3> 

- Via SQL crie um banco de dados e set no arquivo **_.env_**
- Execute o comando **php artisan migrate**

<h3>Execução do projeto</h3>

- Na pasta do projeto execute o comando **php artisan serve**, assim será mostrado **localhost:port**(geralmente 8000)
- Agora basta acessar no navegador **localhost:port**
