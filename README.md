
# Banking Application

## Requirements

1. Laravel 10
2. PHP 8.0 to upper
3. Node 16 to upper
4. Composer 2.5

### Install Procedure

1. Download or clone the source code from github repository.
2. Extract the zip file.
3. Create a database.
4. Goto project folder.
5. Copy .env.example filr to .env and Edit the .env file for database connection.
6. Run command below
   
```sh
npm install or yarn

npm run dev or yarn dev
```

    DB_DATABASE=your_database_name
    
    DB_USERNAME=your_database_username
    
    DB_PASSWORD=your_database_passward

7. Then run below command:

```sh
composer install

php artisan key:generate

php artisan migrate

php artisan serve
```


