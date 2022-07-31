Inicialização:
    1 - Necessário ter Docker e Docker-Compose instalados na máquina;
    2 - Entrar na pasta raiz do projeto e executar o seguinte comando pelo terminal:

docker run --rm \
-u "$(id -u):$(id -g)" \
-v $(pwd):/var/www/html \
-w /var/www/html \
laravelsail/php81-composer:latest \
composer install --ignore-platform-reqs 

    3 - Ainda no terminal, rodar o comando para iniciar a aplicação: php artisan init

    4 - Após análise, necessário rodar comando para encerrar a aplicação: php artisan exit