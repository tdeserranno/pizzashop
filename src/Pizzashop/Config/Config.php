<?php

/** Application config file
 *  Contains defined constants needed for DB access
 *  (could be rewritten to class format?)
 */

define('DB_USER', 'Thomas');
define('DB_PASS', 'e6627');

$dbhost = 'localhost';
$dbname = 'pizzashop';
$dsn = 'mysql:host='.$dbhost.';dbname='.$dbname;
define('DB_DSN', $dsn);
