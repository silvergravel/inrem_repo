
<?php

//fetching global definition of namespace names-----------------------------------------//

$cwd = getcwd();
include $cwd.'/var_config.php';

//--------------------------------------------------------------------------------------//

//check URI to see which language space we are in, accordingly put the
//respective language selection button in active state


$compatible_language_codes = array("en", "hi");
$directoryURI = $_SERVER['REQUEST_URI'];
$components = explode('=', $directoryURI);
$first_part = $components[1];
$current_language_code = substr($first_part, 0, 2);
if($current_language_code == "en"){
  $current_language = $english;
} else if ($current_language_code == "hi"){
  $current_language = $hindi;
} else if (!in_array($current_language_code, $compatible_language_codes)){
  $current_language = NULL;
}

//detects if its login page, in which case, it doesn't display the language selection option.
// honestly im not sure if this is necessary

// $this_is_login = false;
// $detect_login_pg = explode('?', $directoryURI);
// if(strpos($detect_login_pg[1], "login") !== false){
//   $this_is_login = true;
// } else{
//   $this_is_login = false;
// };


?>

<!-- the php on the <ul> is an extension of the logic for display/hide lang selection based on login page -->

<ul class="nav navbar-nav" id = "linklist">

        <li class="<?php if ($current_language==$english) {echo "active"; } else  {echo "noactive";}?>">
          <a href="<?php if ($current_language==$english) {echo "#"; } else  {echo "/".$root_folder."/doku.php?id=".$english.":start";}?>">English</a>
        </li>
        <li class="<?php if ($current_language==$hindi) {echo "active"; } else  {echo "noactive";}?>">
          <a href="<?php if ($current_language==$hindi) {echo "#"; } else  {echo "/".$root_folder."/doku.php?id=".$hindi.":start";}?>">Hindi</a>
        </li>

</ul>
</body>
