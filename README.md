## CRUD DE ESCOLAS

Aplicação web do tipo monolitica criada com:
- PHP para o backend ^7.4
- HTML, CSS e Javascript para o frontend
-MySQL/MariaDB para o banco de dados

## Funcionalidades
- CRUD de Alunos
- CRUD de Professores
- CRUD de Cursos
- CRUD de Categorias
- CRUD de Usuários

## Passo a Passo executar o projeto
Certifique-se que seu computador tem os software:
-PHP
-MySQL ou MariaDB
-Editor de texto (VS Code, por exemplo)
-Navegador Web
-Composer (Gerenciador de pacotes do PHP)

## Clone o projeto
Baixe ou faça o clone do repositorio:
`git clone https://github.com/gleidsonteixeira/crud-php-oo.git`

Após isso entre no diretorio que foi gerado
`cd crud-php-oo`

## Habilitar as extensões do PHP
Abra o diretório de instalação do PHP, encronte o arquivo *php.ini-production*, renomeie-o para *php.ini* e abra-o com algum de editor de texto.


Encontre as seguintes linhas e descomente-as, removendo ; das seguintes linhas:
-pdo_mysql
-curl
-mb_string
-openssl

## Instalar as dependencias
Dentro do diretório da aplicação execute:
`composer install`
Certifique-se que um diretório chamado **/vendor** foi criado.

## Banco de Dados
 O banco de dados é do tipo relacional e contém tabelas com até 2 níveis de normatização.

 ## Criando o banco de dados
 Entre no seu cliente de banco de dados e execute o comando:

```sql
    CREATE DATABASE db_escola;
```

## Migrar a estrutura do banco de dados
Ainda dentro do cliente de banco de dados, copie e cole o conteúdo do aqruivo **db.sql** e execute.

certifique-se que as tabelas foram criadas executando o comando:
```sql
    SHOW TABLES;
```
Se o resultado for a lista das tabelas existente, deu certo.
## Configure as credencias de acesso
Encontre o arquivo **/config/database.php** e edite-o conforme as crendencias do seu usuário do banco de dados.

## Crie o primeiro usuário de acesso
Dentro do diretório da aplicação, execute no terminal o comando

`php config/create-admin.php`;

Isso criará um usuário com as credenciais:

|Nome|email|Senha|
|-   |-    |-    |
|Administrador|admin@admin.com|123456|

## Executando a aplicação
Para executar e testar a aplicação, dentro do terminal execute:
`php -S localhost:porta -t public`
