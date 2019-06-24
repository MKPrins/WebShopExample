### Admin credentials
```
Username: admin@webshop.nl
Password: secret
```

## Quick start guide

Once you've cloned the repository and inside the project folder; run the following command to install all the prerequisites.
```
composer install
```

Next up your gonna want to rename `.env.example` to `.env` and reconfigure the .env file to match your server configuration.
The main things you want to focus are `APP_URL`, `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD`.

It will probably look somewhat like this.
```
APP_URL=http://localhost/WebShopExample/public

DB_DATABASE=webshopexample
DB_USERNAME=root
DB_PASSWORD=toor
```

Next is generating a unique key for your application using the following command.
```
php artisan key:generate
```
We also need to link our storage to the public folder using;
```
php artisan storage: link
```
And last, we need to migrate our database tables. Appending the `--seed` tag also creates a 100 database dummy records of Products.
```
php artisan migrate:fresh --seed
```

## Minimum server requirements
```
PHP >= 7.1.3
PHP GD library extension #Standard on XAMPP and most apache servers.
```
