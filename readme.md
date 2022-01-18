# Movie Booking Application

Built using Laravel 8 Framework/ HTML / CSS / JS / and MySQL. Simple booking system for movie ticket

you can demo at: https://payfast.dipatek.net

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
For the first setup on local You may want to seed data. to do so , ssh the apache container then point to www and run the necessary commands.

`docker exec -it apache bash` and `cd www`

```sh
php artisan migrate:fresh --seed
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

- npm install (optional)
- npm run dev (optional)
- install dummy data: `php artisan migrate:fresh --seed`

## Generale Note

There is 3 users with different role will be created after running a first migration seed

1. super_admin: 
- username: `ddiderson@gmail.com` password: `passowrd`

2. admin: 
- username: `didi@gmail.com` password: `123456`

3. customer: 
- username: `larry@gmail.com` password: `123456`

feel free to create your own user and assign permissions or you can register from the refistration form and default role will customer.

