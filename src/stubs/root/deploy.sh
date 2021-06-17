#!/bin/bash

if [ ${1:-1} == 'down' ]; then
  cd laradock || exit
  docker-compose down
  cd ..
  exit 0
fi

export COMPOSER_ALLOW_SUPERUSER=1

production_path='UPDATE_PRODUCTION_PATH'

if [ $production_path == 'UPDATE_PRODUCTION_PATH' ]; then
    echo $production_path
fi

env=$(if [ "$(pwd)" = $production_path ]; then echo 'production'; else echo "local"; fi)

echo " "
if [ "$env" == 'production' ]; then
  echo "$env $production_path"
  service apache2 stop #digital ocean try to run apache2 on startup

else
  echo "$env $(pwd)"
fi

echo "--- php: $(php -r 'echo PHP_VERSION;') ---"
echo "--- composer: $(composer -V | awk '{ print $3 }') ---"

if [ "$env" != 'production' ]; then
  echo "--- npm: $(npm -v || echo 'run: npm install') ---"
  echo "--- node: $(node -v || echo 'run: node install') ---"
fi

#check if prod passwords have been changed
if [ "$env" == "prod" ]; then
  if [ ! -f "./laradock/.env.prod" ]; then
    cp ./laradock/.env.prod.example ./laradock/.env.prod
    echo '.env.prod Added '
  fi

  if [ ! -f ".env" ]; then
    cp .env.example .env
    echo '.env Added '
  fi

  if grep -q "^MYSQL_ROOT_PASSWORD.*changeme" laradock/.env.prod; then
    echo '--- NEED TO CHANGE DB_PASSWORD in laradock/.env.prod ---'
    exit 1
  fi

  if grep -q "^DB_PASSWORD.*root" .env; then
    echo '--- NEED TO CHANGE DB_PASSWORD in .env ---'
    exit 1
  fi
fi

#check permissions
chmod -R 777 storage

# run laradock
if [ "$env" == 'production' ]; then
  #  PROD

  if [ ${1:-1} == 'build' ]; then
    docker-compose --env-file ./laradock/.env.prod -f laradock/docker-compose.yml build \
      nginx \
      php-worker \
      laravel-horizon
  else
    docker-compose --env-file ./laradock/.env.prod -f laradock/docker-compose.yml up -d \
      nginx \
      php-worker \
      laravel-horizon
  fi
else
  #  LOCAL

  if [ ${1:-1} == 'build' ]; then
    cd laradock || exit
    docker-compose build \
      nginx \
      mysql \
      php-worker \
      laravel-horizon \
      mailhog \
      phpmyadmin
  else
    cd laradock || exit
    docker-compose up -d \
      nginx \
      mysql \
      php-worker \
      laravel-horizon \
      mailhog \
      phpmyadmin
    cd ..


    echo 'Website: http://localhost'
    echo 'Phpmyadmin: http://localhost:8081 root:root'
    echo 'Redis: http://localhost:9987 laradock:laradock'
  fi

fi

#check composer packages are installed
if [ ! -d "vendor" ]; then
  docker exec -it laradock_workspace_1 sh -c 'composer -n install;'
else
  echo 'composer was installed'
fi

# check if .env set
if [ ! -f ".env" ]; then
  docker exec -it laradock_workspace_1 sh -c "php artisan key:generate"
fi

#check npm packages are installed
if [ ! -d "node_modules" ]; then
  echo 'No dependencies installed. Trying to run npm install.'
  docker exec -it laradock_workspace_1 sh -c "npm install"
else
  echo 'npm was installed'
fi

#run migrations
if [ ${1:-1} == 'fresh' ]; then
  docker exec -it laradock_workspace_1 sh -c "php artisan migrate:fresh"
else
  docker exec -it laradock_workspace_1 sh -c "php artisan migrate"
fi

$SHELL
