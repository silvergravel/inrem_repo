
<?php

//fetching global definition of namespace names-----------------------------------------//

$cwd = getcwd();
include $cwd.'/namespace_names.php';

//--------------------------------------------------------------------------------------//
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



?>



<ul class="nav navbar-nav" id = "linklist">
        <li class="<?php if ($current_language==$english) {echo "active"; } else  {echo "noactive";}?>">
          <a href="<?php if ($current_language==$english) {echo "#"; } else  {echo "/dokuwiki/doku.php?id=".$english.":start";}?>">English</a>
        </li>
        <li class="<?php if ($current_language==$hindi) {echo "active"; } else  {echo "noactive";}?>">
          <a href="<?php if ($current_language==$hindi) {echo "#"; } else  {echo "/dokuwiki/doku.php?id=".$hindi.":start";}?>">Hindi</a>
        </li>

</ul>
</body>
