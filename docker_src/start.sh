#!/bin/sh

#php artisan config:clear

chown -R www-data:www-data /data/www
chown -R 777 /data/www

mkdir -p /data/www/storage
mkdir -p /data/www/storage/app/public
mkdir -p /data/www/storage/logs
mkdir -p /data/www/storage/tmp_uploads
mkdir -p /data/www/storage/framework/cache
mkdir -p /data/www/storage/framework/sessions
mkdir -p /data/www/storage/framework/views
chmod -R a+rw /data/www/storage

cd /data/www && composer install --no-scripts --no-autoloader
cd /data/www && composer update
cd /data/www && composer dump-autoload
cd /data/www && php artisan passport:keys

apache2ctl -D FOREGROUND