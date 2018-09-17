# Marsubook
An address book for Marsupilamis based on symfony project. 

Checkout the live demo [here !](https://youtu.be/BQ6YJhuWiL8)

## Run the app locally

To get it working, follow these steps:

**Download Composer dependencies**

After cloning the project, install the dependencies using composer. It will also prompt you to enter your database settings:

```
$composer install
```
**Configure the the .env File**

First, make sure you have an `.env` file (you should).
If you don't, copy `.env.dist` to create it.

Next, look at the configuration and make any adjustments you
need - specifically `DATABASE_URL`.

**Setup the Database**

Again, make sure `.env` is setup for your computer. Then, create
the database & tables!

```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```
If you get an error that the database exists, that should
be ok. But if you have problems, completely drop the
database (`doctrine:database:drop --force`) and try again.

**Start the built-in web server**
```
$ php app/console server:run
```

you should be able to run the app on [localhost:8000](http://127.0.0.1:8000)

## Complete guides 

If you're having trouble with anything above, you could try reading:

[The official Symfony4 quick start guide](https://symfony.com/doc/current/setup.html)

