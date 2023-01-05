# factbid2
This is the PHP front end which displays the hashtags, bids and claims table from the mysql database
There is a separate back end process which polls the tweets and stores them in a tweet table and calls a mysql procedure to populate hashtags, bids and claims

--Deployment instructions for front end when logged in as root:
apt install git
cd /var/
mkdir git
cd git
git clone https://github.com/aaronfactbid/factbid2.git
rm -rf /var/www/html
ln -s /var/git/factbid2/ /var/www/html

--populating the mysql database
#I use ssh port forwarding so I can run sqlyog locally
ssh -p 2222 -i aaron_dev_factbid aaron@dev.factbid.org -L 3306:127.0.0.1:3306
#I created the database like this
CREATE DATABASE factbid CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci;
#and created a user for php
GRANT ALL ON *.* TO my_user@'%' IDENTIFIED BY 'my_password';
#then update the config.php file in /var/www/html to use the credentials
