#!/bin/bash

composer install

service nginx start

service php8.1-fpm start

tail -f /var/log/nginx/error.log
