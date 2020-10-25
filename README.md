CLI RSS reader
================


Installation
------------
Create `.env` file
```dotenv
APP_ENV=prod
```

Install dependencies

``` bash
$ composer install
```

Usage
-----

``` bash
./bin/console fetch-rss --feed="national geographic" --limit=3

```


Testing
-------

``` bash
$ ./vendor/bin/phpunit
```


Credits
-------

- [Created using Package Skeleton](https://github.com/SammyK/package-skeleton)


License
-------

The MIT License (MIT).
