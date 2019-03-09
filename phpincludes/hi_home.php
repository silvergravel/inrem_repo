<?php

//fetching global definition of namespace names-----------------------------------------//

$cwd = getcwd();
include $cwd.'/var_config.php';

//--------------------------------------------------------------------------------------//

echo "<style>";
include "css/main.css";
echo "</style>";

$home_lang = $hindi;

$suffix_dir_path = "/data/pages/".$home_lang;

$home_lang_content_dir_path = $cwd.$suffix_dir_path; //path to namespaces i.e the content-type-wise directories

echo "<div class='home-content'>";

//-------------- this entire shebang here searches each folder in a -------------------//
//-------------- language namespace and systematically displays it  -------------------//
//-------------- on the lannguage homepage.                         -------------------//
foreach(glob( $home_lang_content_dir_path.'/*', GLOB_ONLYDIR) as $locations) {

if($locations !== $home_lang_content_dir_path."/".$contr_forms){ //do not display the contents of admin folder
  $display_locations = str_replace($home_lang_content_dir_path.'/', '', $locations);


  echo "<h6 class='location'>$display_locations</h6>";

  foreach(glob( $locations.'/*', GLOB_ONLYDIR) as $formats) {

    $display_formats = str_replace($locations.'/', '', $formats);
    $display_formats = str_replace('_', ' ', $display_formats);

    echo "<h5 class='format'>$display_formats</h5>";

    $topics = scandir($formats);

    foreach ($topics as $key => $val) {
      if($val != "." && $val != ".." && $val[0] != "."){


        $file_contents = file_get_contents($formats.'/'.$val); //open up each file

        $filename = str_replace('.txt', '', $val); //get only filename w/o extension. we need it to define the href below

        $singleLine = explode("\n", $file_contents);
        $titleLine = $singleLine[3];



         $titleLineArray = explode(" ", $titleLine);

         //get the markup character that is used before and after the words.
         //this one is just getting the markup before the word (but it will always be the same as the one after)
         $first = reset($titleLineArray);


         $title = trim($titleLine,"======"); //get rid of the markup character so now only the title text is left
         $title = trim($title);


        $link_to_url = "/".$root_folder."/doku.php?id=".$home_lang.":".basename($locations).":".basename($formats).":".$filename;
        //
        echo "<h3 class='topic'><a href=$link_to_url>$title</a></h3>";

      };
    };

};
echo "<hr>";
}
};
//--------------------------------------------------------------------------------------//

echo "</div>";

?>
