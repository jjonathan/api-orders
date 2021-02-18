# Projeto de api de cadastro de pedidos:

# Instalação:
Para todas as opções, é necessário criar um arquivo na pasta raiz do projeto chamado .env (pode só copiar o .env.example ```cp .env.example .env```)

## opção 1:
### Rodar os comando abaixo:
- ```composer install```
- ```vendor/bin/sail up -d``` mais detalhes sobre o sail [aqui](https://laravel.com/docs/8.x/sail)
- ```vendor/bin/sail artisan migrate```

obs.: A porta 80 local deve estar disponível

## opção 2:
subir o docker com docker-compose, e quando finalizar rodar:

```docker-compose exec app php artisan migrate```

para que suba todas as migrations do banco de dados (criando assim as tabelas)

## opção 3 (sem docker):
- Criar todo o ambiente (instalando todas as dependencias php + dependencias).
- Editar o arquivo .env adicionando as informações necessárias do banco (DB_*)
- rodar: ```composer install```
- rodar: ```php artisan migrate```
- rodar: ```php artisan serve```

# Lista de rotas:
- POST: http://host/api/order/new
- GET: http://host/api/order/list

## rota: http://host/api/order/new
A rota ```new``` é do tipo POST, e deve receber no corpo da requisição um json, como o abaixo:
```
{
    "name" : "Jonathan Machado",
    "email" : "jmachado@outlook.com",
    "cpf" : "12345678901",
    "cep": "123456",
    "shipping": 7,
    "value": 10,
    "items": [
        {
            "sku": "123456a8",
            "desc": "Laptop",
            "value": 50,
            "qtd": 1
        }
    ]
}
```
Obs.: Para que seja mostrado os erros (por exemplo, cpf que não contenha 11 digitos), caso ocorram, é necessário passar duas variáveis no header da requisição:
- Accept: application/json
- Content-Type: application/json

Caso não sejam enviados, a aplicação entende que a requisição não é via API (não está esperando um json) e caso venha a dar erros, redireciona para http://host

## rota: http://host/api/order/list
Uma rota do tipo GET que lista todas as ordens criadas (já listando os itens das ordens)
