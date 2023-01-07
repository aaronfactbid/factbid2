# factbid2
This is the PHP front end which displays the hashtags, bids and claims table from the mysql database
There is a separate back end process which polls the tweets and stores them in a tweet table and calls a mysql procedure to populate hashtags, bids and claims

--Deployment instructions for front end when logged in as root:
apt install git
cd /opt
git clone https://github.com/aaronfactbid/factbid2.git
rm -rf /var/www/html
ln -s /opt/factbid2 /var/www/html
#enable modrewrite so /HashTag works
a2enmod rewrite
systemctl restart apache2
#add the following block to /etc/apache2/sites-available/000-default.conf and 000-default-le-ssl.conf
<Directory /var/www/html>
	Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
# add the following to /var/www/html/.htaccess
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /list.php?hashtag=$1 [L,QSA]
#Then restart so all /Hashtag redirects to /list.php?hashtag=Hashtag
systemctl restart apache2


#I test changes locally before committing and then when ready to update do: cd /var/www/html; cp config.php ~/; git reset --hard; git pull; cat ~/config.php > config.php


--populating the mysql database
#I use ssh port forwarding so I can run sqlyog locally
ssh -p 2222 -i aaron_dev_factbid aaron@dev.factbid.org -L 3306:127.0.0.1:3306
#I created the database like this
CREATE DATABASE factbid CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci;
#and created a user for php
GRANT ALL ON *.* TO my_user@'%' IDENTIFIED BY 'my_password';
#then update the config.php file in /var/www/html to use the credentials
#to log all queries for debug purposes add to /etc/mysql/conf.d/mysql.cnf
[mysqld]
log_slow_queries
log_queries_not_using_indexes =1
long_query_time = 1
slow_query_log = 1
general_log = 1
slow_query_log_file = /var/log/mysql/slow_query.log
general_log_file = /var/log/mysql/query.log
