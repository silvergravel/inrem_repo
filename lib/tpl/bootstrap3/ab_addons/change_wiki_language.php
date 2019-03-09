
<?php

//fetching global definition of namespace names-----------------------------------------//

$cwd = getcwd();
include $cwd.'/var_config.php';

//if we are inside a language namespace,then make a var that stores the page ID, sans the language namespace.
//we will use this for switching to the corresponding pages when user switches from one lannguage to another.

if (!empty($INFO['namespace'])){
  $id_void_lang_ns = preg_replace("/$lang_namespace/","",$ID);
} else{
  $id_void_lang_ns = ":start";
}


// hide language controls on all pages except the content viewing and contributing pages.
function show_hide_lang_ctrl($namespace_info, $action_info) {
    if(empty($namespace_info) || $action_info !== "show")
    {echo "display:none";} else { echo "display:block";}
}

?>



<ul class="nav navbar-nav" style="<?php show_hide_lang_ctrl($INFO['namespace'], $ACT); ?>" >

        <li class="<?php if ($lang_namespace==$english) {echo "active"; } else  {echo "noactive";}?>">
          <a href="<?php if ($lang_namespace==$english) {echo "#"; } else  {echo DOKU_BASE."doku.php?id=".$english.$id_void_lang_ns;}?>">English</a>
        </li>
        <li class="<?php if ($lang_namespace==$hindi) {echo "active"; } else  {echo "noactive";}?>">
          <a href="<?php if ($lang_namespace==$hindi) {echo "#"; } else  {echo DOKU_BASE."doku.php?id=".$hindi.$id_void_lang_ns;}?>">Hindi</a>
        </li>

</ul>
</body>
