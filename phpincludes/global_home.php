<?php

$cwd = getcwd();

include $cwd.'/var_config.php';

$suffix_dir_path = "/data/pages";

$content_type_dir_path = $cwd.$suffix_dir_path; //path to namespaces i.e the content-type-wise directories



foreach(glob( $content_type_dir_path.'/*', GLOB_ONLYDIR) as $content_type) {
    $content_type = str_replace($content_type_dir_path.'/', '', $content_type);

   if($content_type !== "wiki" && $content_type !== "for_admin"){

    $link_to_url = "/".$root_folder."/doku.php?id=".$content_type.":start";

    echo "<h1><a href=$link_to_url>$content_type<a></h1>";
  };
};

?>
