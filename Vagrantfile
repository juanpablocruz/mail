# -*- mode: ruby -*-
# vi: set ft=ruby :

@script = <<SCRIPT
MYSQL_PASSWORD="toor"
DBNAME = "mail"

apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 7F0CEB10
add-apt-repository ppa:ondrej/php

apt-get update
apt-get install -y python-software-properties zip
apt-get install -y apache2 acl pkg-config libssl-dev libsslcommon2-dev git
echo "ServerName localhost" >> /etc/apache2/apache2.conf

echo mysql-server-5.5 mysql-server/root_password password $MYSQL_PASSWORD | debconf-set-selections
echo mysql-server-5.5 mysql-server/root_password_again password $MYSQL_PASSWORD | debconf-set-selections
apt-get install -y mysql-server

apt-get install -y php php-mysql php-curl php-gd php-dev php-cli php-pear php-intl php-mcrypt php-apcu
apt-get update
apt-get install -y php-mbstring php-zip php-libsodium zip
phpenmod mcrypt
a2enmod rewrite

mysql -uroot -p$MYSQL_PASSWORD -e "CREATE DATABASE $DBNAME" >> /vagrant/vm_build.log 2>&1
mysql -uroot -p$MYSQL_PASSWORD -e "grant all privileges on $DBNAME.* to 'root'@'localhost' identified by '$MYSQL_PASSWORD'" > /vagrant/vm_build.log 2>&1

curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
chown -R www-data:www-data /var/www

# Configure Apache
echo "<VirtualHost *:80>
	DocumentRoot /var/www/public
	AllowEncodedSlashes On

	<Directory /var/www/public>
		Options +Indexes +FollowSymLinks
		DirectoryIndex index.php index.html
		Order allow,deny
		Allow from all
		AllowOverride All
	</Directory>

	ErrorLog ${APACHE_LOG_DIR}/zend-error.log
	CustomLog ${APACHE_LOG_DIR}/zend-access.log combined
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

service apache2 restart
SCRIPT

Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/xenial64"
  config.vm.network "private_network", ip: "192.168.33.101"
  config.vm.synced_folder ".", "/var/www"


  config.vm.provider "virtualbox" do |vb|
    vb.memory = "4096"
  end

  config.vm.provision 'shell', inline: @script
end
