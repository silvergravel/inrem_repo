<?php

$lang_namespace="";

if(!empty($INFO['namespace'])){

$page_namespace_array = preg_split("/:/", $INFO['namespace']);
$lang_namespace = $page_namespace_array[0];

}else{
  $lang_namespace = english;
}


?>
