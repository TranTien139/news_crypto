docker run --rm -v $(pwd):/app composer/composer install

docker-compose up

docker-compose exec app php artisan key:generate

docker-compose exec app php artisan cache:clear

docker-compose exec app php artisan migrate --seed

run: localhost:4002