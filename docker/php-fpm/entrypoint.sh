#!/bin/sh

yarn && npm run production

echo "Running PHP..."

php-fpm -F
