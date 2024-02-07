<?php
// <!-- Write -->
$create = "Isi File\n";
file_put_contents("file.txt", $create, FILE_APPEND);

// <!-- Read -->
$write = file_get_contents("file.txt");
echo $write;
?>