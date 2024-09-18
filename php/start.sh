#!/bin/sh

chmod a+w /var/www/html/public/assets /var/www/html/src/protected/runtime
# Start php-fpm in the background
nohup php-fpm > /var/log/php-fpm.log 2>&1 &

# Start the WebSocket server
nohup php /var/www/html/src/protected/ws/ws_server.php > /var/log/ws_server.log 2>&1 &

composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction
composer dump-autoload --optimize
wait
