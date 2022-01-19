# Weather Application

Built using Laravel 7 Framework/ HTML / CSS / JS / and MySQL. Simple app to get weather of a specific city.

you can demo at: https://decisioningit.dipatek.net

## Local Development

### Requirements for Docker setup

- Docker CE v17.12.0+, installation guides for [Ubuntu](https://docs.docker.com/engine/installation/linux/docker-ce/ubuntu/) and [Mac](https://docs.docker.com/docker-for-mac/install/)
- Docker compose [installation guide](https://docs.docker.com/compose/install/)

#### Setup

Copy the contents of `src/.env.example` to `src/.env`. change the values accordingly

From the root directory boot the application. If you get a **permissions** error you will have to run the commands with `sudo`.

```sh
docker-compose up -d or docker-compose up to monitor the containers
```
For the first setup on local You may want to run migration in order to have table ready for your database to receive weather data. to do so , ssh the apache container then point to www and run the necessary commands.

`docker exec -it apache bash` and `cd www`

```sh
php artisan migrate
```

### Requirements for non docker environment

- php >=7.3
- composer
- mysql >= 5.7
- npm
- node

### Setup 

Copy the contents of `src/.env.example` to `src/.env`. and change the values accordingly

run the app from `src` folder: php artisan serve 

### fisrt run after setup

always run artisan command from src folder:

- composer install
- npm install (optional)
- npm run dev (optional)
- install db `php artisan migrate`

## Generale Note

there is a cron job scheduled in laravel to run every 30min to fetch weather for city as params e.g Montreal

you can manually run the following command

- php artisan weather:cron Montreal
- php artisan schedule:work ( This command will run in the foreground and invoke the scheduler every minute until you terminate the command) this is how manually you can run cron

alternatively you can set a cron job to your server: 

```
* * * * * cd /path-to-your-project_source_codes && php artisan schedule:run >> /dev/null 2>&1
```

- there is also unit test that can be run: `./vendor/bin/phpunit` or `./vendor/bin/phpunit --group testGettingWeatherData` you will have to be inside src forlder to run it or inside docker container if you are runing a container

## Extra

There is a database design that I included to show how I came up with my tables and relationships check the resources folder
