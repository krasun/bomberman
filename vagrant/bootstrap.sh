#!/bin/sh

# install and configure system libraries, php and php extensions
apt-get update
apt-get install -y php5-cli

# install composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

cd /home/vagrant/bomberman
composer install

cd /home/vagrant/bomberman
nohup php bin/server.php > /dev/null 2>&1 &