<?php 
$dirname = "files/logoselect/";
$images = glob($dirname."*");

foreach($images as $image) {

unlink($image);
}
?>