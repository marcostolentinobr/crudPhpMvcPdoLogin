# Exemplo de CRUD MVC com PHP, Pdo e Login

.Projeto voltado a fazer um crud em MVC com Login  
.Cadastra Curso, não edita quando vinculado  
.Cadastra Formação, não edita quando vinculado  
.Cadastra Pessoa  
 - Vinculado a um curso 
 - Vinculado a 0 ou mais cursos  

.Listagem de pessoa ordenado por maior pontuação descrescente, depois nome crescente
.Logar e/ou cadastrar com tabela USUARIO contendo:  
 - ID_USUARIO BIGINT autoincrement [PK]
 - CPF varchar(11) not null
 - Nome varchar(50) not null  
 - Senha  varchar(20) not null 

.Cada usuário que cadastrar uma pessoa terá sua chave vinculada

## Requisitos

.PHP  
.Pdo  
.Mysql  

## PHP - Habilitar

.short_open_tag

## Instação

.Crie um banco de dados  
.Execute o arquivo Artefatos/BD.sql no banco de dados criado

## Configuração

.Configure o banco de dados no inicio do arquivo index.php

## Autor

.Marcos Tolentino
