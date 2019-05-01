<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config['domain'] = 'http://localhost';
//$config['domain'] = 'http://127.0.0.1/';
$config['google-clientid'] = '755661919348-psqarioap9frv49rv8jtk38sekm8gqjt.apps.googleusercontent.com';
$config['google-clientsecret'] = '8AIBa2Lkv4YuQBPgQwc_WSgI';
$config['google-redirecturi'] = $config['domain'] . '/auth/oauth2callback';

$config['email-config'] = Array(
    'protocol' => 'smtp',
    'smtp_host' => 'smtp.googlemail.com',
    'smtp_port' => 587,
    'smtp_user' => 'jonatanlaksamanapurnomo@gmail.com',
    'smtp_pass' => 'choco123123',
    'smtp_crypto' => 'tls',
    'mailtype' => 'html',
    'charset' => 'iso-8859-1'
);
