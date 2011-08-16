<?php

// Example config values, all possible values can be found in <<INSTALL_PATH>>/config/config.php
$config['loggingdir'] = '/var/log/surfconext/';
$config['debug'] = false;

$config['auth.adminpassword'] = 'admin';

// To generate a secret salt run the following command from the shell:
// tr -c -d '0123456789abcdefghijklmnopqrstuvwxyz' </dev/urandom | dd bs=32 count=1 2>/dev/null;echo
$config['secretsalt'] = 'YOUR_SECRET_SALT';

$config['technicalcontact_name'] = 'SURFconext Beheer';
$config['technicalcontact_email'] = 'unix@prolocation.net';