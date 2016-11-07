#!/usr/bin/env bash

if [ ! -d runtime ]; then
mkdir -p  runtime
fi
chmod -R 777 runtime

if [ ! -d web/assets ]; then
mkdir -p  web/assets
fi
chmod -R 777 web/assets

chmod +x tests/codeception/bin/yii
password=`cat config/db.php | grep "'password'" | awk -F "'" '{ print $4 }'`
database=`cat config/db.php | grep dsn | awk -F "=" '{ print $4 }'| sed "s/',//g"`
echo $password
echo $database
mysql -uroot -p$password --connect-expired-password <<EOF
create database if not exists $database DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci
EOF