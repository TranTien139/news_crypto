docker run --rm -v $(pwd):/app composer install

docker-compose up -d

cp .env.example .env

docker-compose exec app php artisan key:generate

docker-compose exec app php artisan config:clear

docker-compose exec app php artisan config:cache

docker-compose exec app php artisan migrate

run: localhost:4015