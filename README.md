## Setup

1. composer install
1. Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
1. configure database in env
1. php artisan key:generate
1. php artisan migrate:fresh --seed
1. (optional) php artisan passport:install
1. php artisan serve