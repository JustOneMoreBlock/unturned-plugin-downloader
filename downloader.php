<?php

/* This doesn't work and the first attempt to make an automatic downloader. */

$key = "";

header("Content-Type: text/plain");
$action = filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING);

function api($api)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $req = json_decode(curl_exec($ch));
    curl_close($ch);
    Return $req;
}

$api = api("http://api.rocketmod.net/plugins/unturned/" . $key . "");

$ci  = array(
    "GlobalBan"     => "rocketmod",
    "ZaupShop"      => "adopted",
    "AntiCombatLog" => "maintained",
    "ChatControl"   => "rocketmod"
);

foreach ($api as $key) {
    if ($action == $key->name) {
        foreach ($ci as $build => $server) {
            if ($key->name == $build) {
                if ($server == "rocketmod") {
                    echo "https://ci.rocketmod.net/view/3) fr34kyn01535's Plugins/job/" . $build . "/lastSuccessfulBuild/artifact/bin/Release/" . $build . ".zip";
                } elseif ($server == "adopted") {
                    echo "https://ci.dev.rocketmod.net/view/4) Adopted Plugins/job/" . $build . "/lastSuccessfulBuild/artifact/bin/Release/" . $build . ".zip";
                } elseif ($server == "maintained") {
                    echo "https://ci.dev.rocketmod.net/view/3) Maintained Plugins/job/" . $build . "/lastSuccessfulBuild/artifact/bin/Release/" . $build . ".zip";
                } elseif ($key->name == $build) {
                    foreach ($key->versions as $dl) {
                        echo $dl->url . "\r\n";
                    }
                }
            }
        }
    }
}

?>