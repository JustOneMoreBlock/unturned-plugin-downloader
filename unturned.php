<?php

/*

Visit https://dev.rocketmod.net/
Click on a plugin such as GlobalBans: https://dev.rocketmod.net/plugins/global-ban/
In the URL you will see "global-ban"
Example: unturned.php?download=global-ban

Example: unturned.php?download=plugin_slug

Ideal Usage:
wget --no-check-certificate "http://yourdomain.com/unturned.php?download=plugin_slug" -O plugin_slug.zip"
*/

$plugin = filter_input(INPUT_GET, "download", FILTER_SANITIZE_STRING);

if($plugin) {
    header('Content-type: application/zip');
    header('Content-Disposition: attachment; filename="'.$plugin.'.zip"');
    readfile('http://dev.rocketmod.net/plugins/'.$plugin.'/latest.zip');
}

?>