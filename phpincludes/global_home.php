<?php

$cwd = getcwd();

$suffix_dir_path = "/data/pages";

$content_type_dir_path = $cwd.$suffix_dir_path; //path to namespaces i.e the content-type-wise directories



foreach(glob( $content_type_dir_path.'/*', GLOB_ONLYDIR) as $content_type) {
    $content_type = str_replace($content_type_dir_path.'/', '', $content_type);

   if($content_type !== "wiki" && $content_type !== "for_admin"){
    echo "<h1>$content_type</h1>";
  };
};

?>
