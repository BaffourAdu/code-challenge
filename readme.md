# Testing Code Challenge
A very simple code challenge about Testing in Laravel

## Installation
**Note:** Make sure you have composer installed or you may downlaod composer at => https://getcomposer.org/download/

1. git clone
2. Open the console and cd into your project root directory
3. Create your database
4. Rename .env.example file to .env inside your project root
5. Update .env with your database information.
6. Run composer install or php composer.phar install
7. Run php artisan key:generate
8. Run php artisan migrate
9. Run php artisan db:seed to run seeders (Incase of an error run => composer dump-autoload)
10. Run php artisan serve

**Project Url:** http://localhost:8000

## Tests
To all the tests, run the command below;
```bash
vendor/bin/phpunit
``` 


