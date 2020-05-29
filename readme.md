
About the Project

This api (Crud Assignment) project was built with laravel 6.5.0 and php 7.4.3

Requirement

The system php version must be greater than 7.2

How to run the program
1. Clone or download the repo
2. install xampp
3. install composer from https://getcomposer.org/.
4. Create a database(ice_and_fire) on phpmyadmin(xampp)
5. Open terminal(command prompt, linux terminal or mac) and cd into the project folder(CrudAssignment)

Run the following command

1. Composer install
2. php artisan serve --port=8080

Open another terminal and navigate to the project folder then run the following command

1. php artisan key:generate
2. php artisan migrate.
3. php artisan db:seed.
4. Test api with postman or other http client application
