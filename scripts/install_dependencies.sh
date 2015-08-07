#!/bin/bash
yum -y install httpd24 > /var/log/installapache.out 2>&1
yum -y install mysql php5-mysql > /var/log/installmysql.out 2>&1
yum -y install php55 php55-intl php55-mysqlnd > /var/log/installphp.out 2>&1
yum -y install git expect > /var/log/installother.out 2>&1
curl -s https://getcomposer.org/installer | php


mkdir -p /var/www/edge/htdocs/webroot
mkdir -p /var/www/edge/log

cat > /etc/httpd/conf.d/edge.conf <<EOF
<VirtualHost *:80>
    DocumentRoot "/var/www/edge/htdocs/webroot"
    ServerName edge.hanfordonline.co.uk
    ErrorLog "/var/www/edge/log/error.log"
    CustomLog "/var/www/edge/log/access.log" common
    <Directory "/var/www/edge/htdocs/webroot">
        Require all granted
    </Directory>
</VirtualHost>
EOF

