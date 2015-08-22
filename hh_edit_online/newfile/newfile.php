<?php

$filename = "../" . $_GET['folder'] . "/" . $_GET['filename'];
$fh = fopen($filename, 'w') or die("can't open file");
$stringData = $_REQUEST['content'];
fwrite($fh, $stringData);
fclose($fh);

?>