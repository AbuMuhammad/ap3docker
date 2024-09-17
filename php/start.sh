#!/bin/sh
# Start php-fpm in the background
nohup php-fpm > /var/log/php-fpm.log 2>&1 &

# Start the WebSocket server
nohup php /var/www/html/src/protected/ws/ws_server.php > /var/log/ws_server.log 2>&1 &

wait
