# E-learning-platform
This project is a school management platform.

This project was created by Akrem Boussaha and Karim Mezni as part of our dissertation. 

Before installation make sure that PHP7.4, and mongodb are installed.

# Requirements

**PHP7.4**

**MongoDB**

# Installation

lunch those commands:

    composer install
    sudo apt-get install php7.4-dev
    
Installation of MongoDbDriver

    sudo percl install mongo db
    sudo nano /etc/php7.4/cli/php.ini
    
Include extension=mongodb.so at the bottom of the PHP .ini configuration file, then save it

Restart the apache server

    sudo systemctl restart apache2
    
 
    
# Generate the SSH keys for Api Token authentication:

    $ mkdir -p config/jwt
    $ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
    $ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
    
# Run the project

    sudo php -S 127.0.0.1:8000 -t public
    
# Credentials to login 

    login : admin0@admin.com
    password: admin
   
    
# API Documentation WIP

    http://127.0.0.1:8000/api/docs 
    
# WIP : Work in Progress

commit 7602d0ac83722b01c34005c85a0f7ef89a6b9275 from AWS EC2 instance 

modif