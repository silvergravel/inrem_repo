<?php
// Program to display URL of current page.
$cwd = getcwd();
include $cwd.'/var_config.php';

$img_src = "/".$root_folder."/phpincludes/media/whatsapp_share.png";

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https";
else
    $link = "http";

// Here append the common URL characters.
$link .= "://";

// Append the host(domain name, ip) to the URL.
$link .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL
$link .= $_SERVER['REQUEST_URI'];

$whatsapp_share_prefix = "whatsapp://send?text=";

//THE link that does the whatsapp share magic
$whatsapp_share_href = $whatsapp_share_prefix.$link;



// whatsapp share button
echo "<a href=$whatsapp_share_href data-action='share/whatsapp/share'><img height='20' src=$img_src></a>";


?>

<!-- <img src="/inrem_repo/share.png"> -->
