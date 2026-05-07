<?php
$envPath = __DIR__ . "/../.env";
if (file_exists($envPath)) {
    $env = parse_ini_file($envPath);
    if ($env) {
        if (!defined("EMAIL_USER")) define("EMAIL_USER", $env["EMAIL_USER"] ?? "");
        if (!defined("EMAIL_PASS")) define("EMAIL_PASS", $env["EMAIL_PASS"] ?? "");
        if (!defined("GOOGLE_CLIENT_ID")) define("GOOGLE_CLIENT_ID", $env["GOOGLE_CLIENT_ID"] ?? "");
        if (!defined("GOOGLE_CLIENT_SECRET")) define("GOOGLE_CLIENT_SECRET", $env["GOOGLE_CLIENT_SECRET"] ?? "");
        if (!defined("FACEBOOK_APP_ID")) define("FACEBOOK_APP_ID", $env["FACEBOOK_APP_ID"] ?? "");
        if (!defined("FACEBOOK_APP_SECRET")) define("FACEBOOK_APP_SECRET", $env["FACEBOOK_APP_SECRET"] ?? "");
        if (!defined("FACEBOOK_REDIRECT")) define("FACEBOOK_REDIRECT", $env["FACEBOOK_REDIRECT_URI"] ?? "");
        if (!defined("GROQ_API_KEY")) define("GROQ_API_KEY", $env["GROQ_API_KEY"] ?? "");
        if (!defined("APP_URL")) define("APP_URL", $env["APP_URL"] ?? "");
    }
}

// Fallback para APP_URL se não estiver no .env ou se estivermos no local
if (!defined("APP_URL") || (isset($is_localhost) && $is_localhost)) {
    if (isset($full_url)) {
        if (!defined("APP_URL")) define("APP_URL", $full_url);
    }
}
?>