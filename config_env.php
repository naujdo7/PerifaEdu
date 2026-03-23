<?php
$env = parse_ini_file(__DIR__ . "/.env");

define("EMAIL_USER", $env["EMAIL_USER"]);
define("EMAIL_PASS", $env["EMAIL_PASS"]);
define("GOOGLE_CLIENT_ID",     $env["GOOGLE_CLIENT_ID"]);
define("GOOGLE_CLIENT_SECRET", $env["GOOGLE_CLIENT_SECRET"]);