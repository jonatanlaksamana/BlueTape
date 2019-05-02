# BlueTape

## Prerequisites untuk testing

-PHP version 7.2 or higher
-Xampp
-Xdebug

## Setup

Dengan menggunakan git bash :
- Pastikan sudah di directory /c
- masuk ke directory dengan command: cd xampp/htdocs
- clone project dengan command: git clone https://github.com/jonatanlaksamana/BlueTape
- Setelah selesai clone, masuk ke directory bluetape dengan command: cd bluetape

- Buka folder xampp dalam Local Disk( drive C:)
- Masuk folder Apache/config/extra
- Kemudian buka file httpd-vhosts.conf
- ubah DocumentRoot dan ServerName seperti kode dibawah ini 
======================================================================
        <VirtualHost *:80>
            ##ServerAdmin webmaster@dummy-host2.example.com
            DocumentRoot "C:/xampp/htdocs/bluetape/www"
            ServerName bluetape.dev
            ##ErrorLog "logs/dummy-host2.example.com-error.log"
            ##CustomLog "logs/dummy-host2.example.com-access.log" common
        </VirtualHost>
======================================================================

Buka kembali git bash :
- copy file auth-dev.php dengan command: cp www/application/config/auth-dev.php www/application/config/auth.php
- copy file database-dev.php dengan command: cp www/application/config/database-dev.php www/application/config/database.php

-create database bluetape di database management system (phpmyadmin) 
-buka folder bluetape/www/application/config/database.php, kemudian pastikan :
    'username' => 'root',
	'password' => '',
	'database' => 'bluetape'
-migrate database dengan cara buka browser lalu ketik: localhost/migrate

##Testing Run
Dengan menggunakan git bash :
- Pastikan sudah di directory /c
- masuk ke directory dengan command: cd xampp/htdocs/www
-untuk testing gunakan command : php index.php tests testall
-untuk melihat Semua Test Document (code coverage dan test plan), masuk ke folder bluetape/TestDocuments