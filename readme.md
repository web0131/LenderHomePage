# LenderHomePage Code Challenge

## Prerequisites

1. **php**@_7.1.3+_
2. **node**@_10.6.0+_
3. **npm**@_6.9.0+_
4. **mysql**@_5.5.7+_

## Installation

Install the php dependencies using [composer](https://getcomposer.org/):

```
composer install
```

Install the node dependencies using [npm](https://docs.npmjs.com/cli-documentation/):

```
npm install
```

Copy `.env.example` to `.env`:

```
cp .env.example .env
```

Set the following database variables in `.env` file for your development environment:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Run the database migrations and seedings using [artisan](https://laravel.com/docs/5.8/artisan):

```
php artisan migrate
```

```
php artisan db:seed
```

Start hot reloading for the application's interface:

```
npm run hot
```

Start serving the application:

```
php artisan serve
```

Load the application URL in your browser:

```
http://localhost:8000
```

## Documentation Resources

The following are links to documentation websites relevant to the code challange:

-   [Laravel](https://laravel.com/docs/5.8)
-   [Vue](https://vuejs.org/v2/guide/)
-   [Vue Router](https://router.vuejs.org)
-   [Vuex](https://vuex.vuejs.org/guide/)
-   [Vuetify](https://vuetifyjs.com/en/getting-started/quick-start)
-   [Axios](https://github.com/axios/axios)
