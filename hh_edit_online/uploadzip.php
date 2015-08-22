<?php
/**
 * HumHub CMS - Edit Online Module
 *
 * PHP version >= 5.3
 *
 * @category  PHP
 * @package   hh_edit_online
 * @author    Andreas Holzer <palareas@gmail.com>
 * @copyright 2015 Andreas Holzer
 * @license   MIT
 * @link      http://web-crew.org
 */
session_start();
require_once('Login.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload ZIP</title>

<link rel="stylesheet" type="text/css" href="css/style.css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
	
$(".nav").click(function(){
    $("ul").toggle();
  });
  
$(document).click(function() {
    $("ul").hide();
});

$(".nav").click(function(e) {
    e.stopPropagation();
    return false;
}); 
  
});
</script>

</head>

<body>

<div id="navcontainer">


<div class="nav">ACTIONS</div>

<ul class="navpanel top">
<a href='create.php'><li class="first">Create File</li></a>
<a href='createdir.php'><li>Create Folder</li></a>
<a href='upload.php'><li>Upload File</li></a>
<a href='uploadzip.php'><li>Upload ZIP</li></a>
<a href='Logout.php'><li class="last">Logout</li></a>
</ul>

</div>

<div id="container">

<h2>Upload ZIP</h2>

<form class="edit" action="" method="post" enctype="multipart/form-data">

<div class="confirmsecond">File:</div>

<input type="file" name="file" class="fileupload" />

<div class="confirmsecond">Location:</div>

<select name='folder'>

<?php

function ListFolder($path)
{
    //using the opendir function
    $dir_handle = @opendir($path) or die("Unable to open $path");
    
    //Leave only the lastest folder name
    $dirname = $path;
    
    //display the target folder.
    echo ("<option>$dirname\n</option>");
    while (false !== ($file = readdir($dir_handle))) 
    {
        if($file!="." && $file!="..")
        {
            if (is_dir($path."/".$file))
            {
                //Display a list of sub folders.
                ListFolder($path."/".$file);
            }
            else
            {
                //Display a list of files.

            }
        }
    }
    echo "</ul>\n";
    echo "</li>\n";
    
    //closing the directory
    closedir($dir_handle);
}

ListFolder("..");
?>

</select>

<input type="submit" class="filetype" name="Submit" value="Upload">
</form>

<a class='return' href='index.php'>&larr; Back to root</a>

</div>

<?php

if (isset($_POST['Submit'])) {
	
if($_FILES["file"]["name"]) {
	$filename = $_FILES["file"]["name"];
	$source = $_FILES["file"]["tmp_name"];
	$type = $_FILES["file"]["type"];
 
	$name = explode(".", $filename);
	$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
	foreach($accepted_types as $mime_type) {
		if($mime_type == $type) {
			$okay = true;
			break;
		} 
	}
 
	$continue = strtolower($name[1]) == 'zip' ? true : false;
	if(!$continue) {
		echo "<div class='attention'>The file you are trying to upload is not a .zip file. Please try again.</div>";
	}
 
	$target_path = $_REQUEST['folder'] . "/".$filename;  // change this to the correct site path
	if(move_uploaded_file($source, $target_path)) {
		$zip = new ZipArchive();
		$x = $zip->open($target_path);
		if ($x === true) {
			$zip->extractTo($_REQUEST['folder'] . "/"); // change this to the correct site path
			$zip->close();
					
			unlink($target_path);
			
			echo "<div class='attentiongreen'>Your .zip file was uploaded and unpacked.</div>";
		}
	} else {	
		
			echo "<div class='attention'>There was a problem with the upload. Please try again.</div>";
	}
}

}

?>

</body>
</html>
