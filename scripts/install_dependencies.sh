#!/bin/sh

sudo apt-get -y update
sudo apt-get -y install postgresql postgresql-contrib php5-cli php5-fpm php5-pgsql php5-intl nginx git expect
sudo mysql_install_db
sudo /usr/bin/mysql_secure_installation

sudo sed -i 's/;cgi\.fix_pathinfo=1/cgi\.fix_pathinfo=0/g' /etc/php5/fpm/php.ini
sudo service php5-fpm restart

curl -s https://getcomposer.org/installer | php


cat > /tmp/chpw <<EOF
#!/bin/sh
# \\
exec expect -f "\$0" \${1+"\$@"}
set password [lindex \$argv 1]
spawn passwd [lindex \$argv 0]
sleep 1
expect "assword:"
send "\$password\r"
expect "assword:"
send "\$password\r"
expect eof
EOF
chmod a+x /tmp/chpw


cat > /etc/nginx/sites-available/edge <<EOF
server {
        listen   80;
        server_name edge.hanfordonline.co.uk;

        root /var/www/edge/App/webroot/;
        index index.php;

        access_log /var/www/edge/App/log/access.log;
        error_log /var/www/edge/App/log/error.log;

        location / {
                try_files \$uri \$uri/ /index.php?\$args;
        }

        location ~ \.php\$ {
                try_files \$uri =404;
                fastcgi_pass unix:/var/run/php5-fpm.sock;
                fastcgi_index index.php;
                fastcgi_param SCRIPT_FILENAME $document_root\$fastcgi_script_name;
                include fastcgi_params;
        }
}
EOF

EDGEPW=`tr -cd '[:alnum:]' < /dev/urandom | fold -w30 | head -n1`
sudo useradd -s /bin/false -d /var/www/edge edge
sudo /tmp/chpw edge $EDGEPW


sudo -i -u postgres createuser edge
sudo -i -u postgres createdb edge
sudo -u postgres psql -U postgres -d edge -c "ALTER USER edge WITH password '$EDGEPW';"


sudo mkdir -p /var/www/
sudo chown -R ubuntu:ubuntu /var/www/

cd /var/www/
git clone -b master https://github.com/Cylindric/edge.git
mkdir -p /var/www/edge/App/log
mkdir -p /var/www/edge/App/tmp
find /var/www/edge -type d -exec chmod 775 {} \;
find /var/www/edge -type f -exec chmod 664 {} \;
chmod a+x /var/www/edge/App/bin/cake
sudo chmod -R a+w /var/www/edge/App/log
sudo chmod -R a+w /var/www/edge/App/tmp


cd /var/www/edge/App/
php ~/composer.phar -n install

sed -i "s/'driver' => '.*'/'driver' => 'Cake\\\Database\\\Driver\\\Postgres'/g" /var/www/edge/App/config/app.php
sed -i "s/'username' => '.*'/'username' => 'edge'/g" /var/www/edge/App/config/app.php
sed -i "s/'password' => '.*'/'password' => '$EDGEPW'/g" /var/www/edge/App/config/app.php
sed -i "s/'database' => '.*'/'database' => 'edge'/g" /var/www/edge/App/config/app.php

sudo ln -sf /etc/nginx/sites-available/edge -T /etc/nginx/sites-enabled/edge


cd /var/www/edge/App
bin/cake migrations migrate
