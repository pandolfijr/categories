# Projeto Laravel API de Categorias

Este projeto é uma API desenvolvida em Laravel 10 com PHP 8.2, utilizando Docker para o ambiente de desenvolvimento. 

A API permite a criação, listagem, visualização e exclusão de categorias/sub-categorias, além de relacioná-las.

## 🚀 Começando
### 📋 Pré-requisitos

Para rodar o projeto na sua máquina, você precisará ter as seguintes ferramentas instaladas:
```
- Docker
- Docker Compose
- Composer
```

### 🔧 Instalação do Projeto

Clone o repositório do projeto

```
git clone https://github.com/pandolfijr/categories.git
cd categories
```

Instale o composer

```
composer install

```

Construa e inicie os contêineres Docker

```
docker-compose up -d --build

```

Acesse o shell do contêiner em execução do Docker para rodar as migrations, responsáveis por gerar as tabelas do sistema

```
docker exec -it lojacorr_app /bin/bash

```

Dentro do contêiner, rode o comando para criar as tabelas:
```
php artisan migrate

```

Após o término do comando, você já pode sair do Shell
```
exit

```

Para obter as rotas que foram criadas, utilize o comando:

```
php artisan route:list
```
```
GET|HEAD        api/category ..........................................................................................category.index › CategoryController@index
POST            api/category ..........................................................................................category.store › CategoryController@store
GET|HEAD        api/category/{category} ...............................................................................category.show › CategoryController@show
PUT|PATCH       api/category/{category} ...............................................................................category.update › CategoryController@update
DELETE          api/category/{category} .............................................................................. category.destroy › CategoryController@destroy
GET|HEAD        api/sub-category ......................................................................................sub-category.index › SubCategoryController@index
POST            api/sub-category ......................................................................................sub-category.store › SubCategoryController@store
GET|HEAD        api/sub-category/create ...............................................................................sub-category.show › SubCategoryController@show
PUT|PATCH       api/sub-category/{sub_category} .......................................................................sub-category.update › SubCategoryController@update
DELETE          api/sub-category/{sub_category} .......................................................................sub-category.destroy › SubCategoryController@destroy
```
## ⚙️ Executando os testes

Utilizando Insomnia, Postman ou outra ferramenta de teste de API utilize as rotas mencionadas acima para fazer requisições e obter os registros das tabelas.
Para facilitar, foi adicionado na raiz do projeto o arquivo chamado RoutesInsomnia.json, que se trata das rotas exportadas. Com ele, basta acessar o Insomnia e importá-lo, e os testes estarão prontos, bastando apenas executá-los.

### 🔩 Exemplos

As rotas index, não possuem body. Ou seja, basta apenas executar com a URL

```
GET - http://localhost:8002/api/category
GET - http://localhost:8002/api/sub-category

```


As rotas para show e delete, também não possuem body, porém você deve especificar o ID na URL

```
GET: http://localhost:8002/api/category/1
GET: http://localhost:8002/api/sub-category/1
DELETE: http://localhost:8002/api/sub-category/1
DELETE: http://localhost:8002/api/category/1

```

As rotas para store possuem body.
```
POST: http://localhost:8002/api/category
BODY:
{
	"name" : "Category"
}



```

```
POST: http://localhost:8002/api/sub-category
BODY:
{
	"name" : "Sub-Category",
	"category_id" : "1"
}

```

Assim como as rotas store, as update também possuem body.
```
PUT: http://localhost:8002/api/category/1
BODY:
{
	"name" : "Category Updated"
}



```

```
POST: http://localhost:8002/api/sub-category/1
BODY:
{
	"name" : "Sub-Category Updated",
	"category_id" : "1"
}

```


## 🛠️ Construído com

* [Laravel](https://laravel.com/docs/10.x/releases) - Laravel


## 📌 Versão

1.0

## ✒️ Autor

* **Desenvolvedor** - [Jean Pandolfi](https://github.com/pandolfijr/)
