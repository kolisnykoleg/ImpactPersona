<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Need to enable https://myaccount.google.com/lesssecureapps

$config = [
    'protocol' => 'smtp',
    'smtp_host' => 'ssl://smtp.gmail.com',
    'smtp_port' => '465',
    'smtp_user' => 'impact.persona.disc@gmail.com',
    'smtp_pass' => 'ImpactPersona1245',
    'crlf' => "\r\n",
    'newline' => "\r\n",
];
