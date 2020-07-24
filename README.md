# hitbtc-semi-auto-bot
Hitbtc semi auto bot on this bot place buy order manually sell order place auto.
Requirement :
php
mysql
cronjob
create database and edit connect.php file 
upload trade2.sql in database

copy all file :
connect.php  ( database connection)
orderform.php ( order form)
orderformsubmit.php  (order place on hitbtc and save data in database )
ordersemi.php ( place sell order if buy order complateed )

set cron job 1 minute for ordersemi.php
edit apikey in orderformsubmit.php and ordersemi.php
