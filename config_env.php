<?php

$env = parse_ini_file(__DIR__ . "/.env");

define("EMAIL_USER", $env["EMAIL_USER"]);
define("EMAIL_PASS", $env["EMAIL_PASS"]);

?>