<?php
// Google reCAPTCHA v2 keys
// Get your keys at: https://www.google.com/recaptcha/admin/create
define('RECAPTCHA_SITE_KEY',   '6LeZvJQsAAAAAIlanbP18RMiRxc2bGHKNlvnUjTF');
define('RECAPTCHA_SECRET_KEY', '6LeZvJQsAAAAAHO5nIvL0jVsnh5dQ3Bol7ylAR2O');

function verifyRecaptcha(string $response): bool {
    if (empty($response)) return false;
    $url  = 'https://www.google.com/recaptcha/api/siteverify';
    $data = ['secret' => RECAPTCHA_SECRET_KEY, 'response' => $response];
    $ctx  = stream_context_create([
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data),
            'timeout' => 10,
        ]
    ]);
    $result = @file_get_contents($url, false, $ctx);
    if ($result === false) return false;
    $json = json_decode($result);
    return isset($json->success) && $json->success === true;
}
