<?php
$pass = 'marek';

$database_salt = bin2hex(openssl_random_pseudo_bytes(mt_rand(128, 512)));
$program_salt  = bin2hex(openssl_random_pseudo_bytes(128));

$hash = explode(base64_decode('JDYkcm91bmRzPTUwMDA='),
                crypt($pass, base64_decode('JDYkcm91bmRzPTUwMDA=') . $program_salt . $database_salt)
        )[1];

echo $hash;

if (hash_equals($hash, $hash)) {
    echo '<p>OK</p>';
} else {
    echo '<p>BAD</p>';
}