# hitbtc-semi-auto-bot
Hitbtc semi auto bot on this bot place buy order manually sell order place auto using cron job.
<br>
<b>Requirement :</b><br>
php<br>
mysql<br>
cronjob<br>
ordelist.php  (order list)<br>
hitbtc api V2<br><br>

create database and edit connect.php file <br>
upload trade2.sql in database<br><br>

copy all file :<br>
connect.php  ( database connection)<br>
orderform.php ( order form)<br>
orderformsubmit.php  (order place on hitbtc and save data in database )<br>
ordersemi.php ( place sell order if buy order complateed )<br><br>

if you use base scaner signal then use :<br>
orderformbase.php<br>
orderformsubmitbase.php<br>


set cron job 1 minute for ordersemi.php<br>
edit apikey in all file.
