# Um projetinho Laravel

### Rodando o projetinho
* dokcer e docker-compose instalado
no terminal rode o comando `docker-compose up`
depois de subir os containers do php e mysql precisamos rodar algumas coisas do php dedntro do container

```SHELL
docker exec -t php composer install
docker exec -t php php artisan migrate --seed
```

e para rodar os testes: `docker exec -t php php artisan test`

##### Observações
o .env já está nos commits
está rodando diretamente pelo artisan, sem nginx ou apache
tem um arquivo de swagger com as rotas da API
