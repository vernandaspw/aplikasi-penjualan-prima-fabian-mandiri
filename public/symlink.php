<?php
$target =$_SERVER['DOCUMENT_ROOT'].'/storage/app/public';
$link = $_SERVER['DOCUMENT_ROOT'].'/public_html/storage';
symlink($target, $link);
echo "Done";
?> 