<?php
/**
 * Praktikum DBWT. Autoren:
 * Antonia, Badelt, 3728150
 * Alice, Kelberer, 3731224
 */

$zeit = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];

$eintrag = $zeit . "  IP: " . $ip . "  Browser: " . $browser . "\n";


$datei = fopen("accesslog.txt", "a");

if ($datei) {
    fwrite($datei, $eintrag);
    fclose($datei);
} else {
    echo "Datei konnte nicht geöffnet werden.";
}

?>
