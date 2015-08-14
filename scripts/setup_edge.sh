#!/bin/bash

cd /var/www/edge/htdocs
~/composer.phar -n install

chmod u+x /var/www/edge/htdocs/bin/cake


edgepass=`cat /var/www/edge/edgepw`
slackurl=`cat /var/www/edge/slack`
sed -i "s/'username' => '.*'/'username' => 'edge'/g" /var/www/edge/htdocs/config/app.php
sed -i "s/'password' => '.*'/'password' => '$edgepass'/g" /var/www/edge/htdocs/config/app.php
sed -i "s/'webhook_url' => '.*'/'webhook_url' => '$slackurl'/g" /var/www/edge/htdocs/config/app.php

bin/cake migrations migrate


chown -R apache:apache /var/www/edge/htdocs
find /var/www/edge/htdocs -type d -exec chmod 550 {} \;
find /var/www/edge/htdocs -type f -exec chmod 440 {} \;

find /var/www/edge/htdocs/logs -type d -exec chmod 770 {} \;
find /var/www/edge/htdocs/logs -type f -exec chmod 660 {} \;
find /var/www/edge/htdocs/tmp -type d -exec chmod 770 {} \;
find /var/www/edge/htdocs/tmp -type f -exec chmod 660 {} \;

