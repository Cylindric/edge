#!/bin/bash
yum -y install httpd24 > /var/log/installapache.out 2>&1
yum -y install mysql mysql-server php5-mysql > /var/log/installmysql.out 2>&1
yum -y install php55 php55-intl php55-mysqlnd php55-mbstring > /var/log/installphp.out 2>&1
yum -y install git expect > /var/log/installother.out 2>&1
curl -s https://getcomposer.org/installer | php

mysql_install_db

#/usr/bin/mysql_secure_installation
rootpass=`tr -cd '[:alnum:]' < /dev/urandom | fold -w30 | head -n1`
echo $rootpass > /var/www/edge/mysqlpw
mysql -u root <<-EOF
UPDATE mysql.user SET Password=PASSWORD('$rootpass') WHERE User='root';
DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
DELETE FROM mysql.user WHERE User='';
DELETE FROM mysql.db WHERE Db='test' OR Db='test\_%';
FLUSH PRIVILEGES;
EOF


mkdir -p /var/www/edge/htdocs/webroot
mkdir -p /var/www/edge/log

cat > /etc/httpd/conf.d/edge.conf <<EOF
<VirtualHost *:80>
    DocumentRoot "/var/www/edge/htdocs/webroot"
    ServerName edge.hanfordonline.co.uk
    ErrorLog "/var/www/edge/log/error.log"
    CustomLog "/var/www/edge/log/access.log" common
    <Directory "/var/www/edge/htdocs/webroot">
		AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF



edgepass=`tr -cd '[:alnum:]' < /dev/urandom | fold -w30 | head -n1`

echo $edgepass > /var/www/edge/edgepw
chown root:root /var/www/edge/edgepw
chmod 400 /var/www/edge/edgepw


edgepass=`cat /var/www/edge/edgepw`
rootpass=`cat /var/www/edge/mysqlpw`
mysql -uroot -p$rootpass -e 'CREATE DATABASE IF NOT EXISTS edge;';
mysql -uroot -p$rootpass -e "GRANT ALL PRIVILEGES ON edge.* TO \"edge\"@\"localhost\" IDENTIFIED BY \"$edgepass\";"
mysql -uroot -p$rootpass -e 'FLUSH PRIVILEGES;';

mysql -uroot -p$rootpass -e 'CREATE DATABASE IF NOT EXISTS edgetest;';
mysql -uroot -p$rootpass -e "GRANT ALL PRIVILEGES ON edgetest.* TO \"edge\"@\"localhost\" IDENTIFIED BY \"$edgepass\";"
mysql -uroot -p$rootpass -e 'FLUSH PRIVILEGES;';

echo "" > /var/www/edge/slack.webhook_url
