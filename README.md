# BlueTape

## Prerequisites untuk testing

-PHP version 7.2 or higer
-Xampp
-Xdebug

## Setup

- masuk ke di directory c/xampp/htdocs
- git clone https://github.com/jonatanlaksamana/BlueTape
- cd bluetape
- Set Apache server mengarah ke direktori www
- cp www/application/config/auth-dev.php www/application/config/auth.php
- cp www/application/config/database-dev.php www/application/config/database.php

##Testing Run
-pergi ke folder www
-php www/index.php tests testall
-untuk melihat Semua Test Document (code coverage , test plan)
-pergi ke directory bluetape
-semua TestDocument berada pada folder document test
