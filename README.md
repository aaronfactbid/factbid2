# factbid2
This is the PHP front end which displays the hashtags, bids and claims table from the mysql database
There is a separate back end process which polls the tweets and stores them in a tweet table and calls a mysql procedure to populate hashtags, bids and claims

--Deployment instructions for front end when logged in as root, tested on a Contabo LAMP instance:
apt install git zip
cd /opt
git clone https://github.com/aaronfactbid/factbid2.git
rm -rf /var/www/html
ln -s /opt/factbid2 /var/www/html
mkdir /var/www/html/download/
chmod 777 /var/www/html/download/

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

#I test changes locally before committing and then when ready to update do:
cd /var/www/html; cp config.php ~/; git reset --hard; git pull; cat ~/config.php > config.php

