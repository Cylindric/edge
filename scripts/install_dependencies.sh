#!/bin/bash
yum -y install httpd24 > /var/log/installapache.out 2>&1
yum -y install mysql php5-mysql > /var/log/installmysql.out 2>&1
yum -y install php55 php55-intl php55-mysqlnd > /var/log/installphp.out 2>&1
yum -y install git expect > /var/log/installother.out 2>&1
