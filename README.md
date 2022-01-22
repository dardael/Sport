# Sport

Run the project and build the images
docker-compose up -d --build

Run the project
docker-compose up -d

Build front files and watch them
npm run watch

Install composer library
docker-compose run --rm php composer require my-library

Run PHPUnit
docker-compose exec php php ./vendor/bin/phpunit