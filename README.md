# singasakti
repository for singasakti
<!-- commment -->
How to run in local:

- Clone your project
- Create empty database `monevpro`
- Go to the folder application using cd command on your cmd or terminal 

    Run `cd singasakti`
- Run `composer install` on your cmd or terminal
- Copy `.env.example` file to `.env` on the root folder. 

    Run `copy .env.example .env` if using command prompt Windows

    or `cp .env.example .env` if using terminal, Ubuntu
- Run `php artisan key:generate`
- Run `php artisan migrate:fresh --seed`
- Run `php artisan serve`
- Go to http://localhost:8000/

