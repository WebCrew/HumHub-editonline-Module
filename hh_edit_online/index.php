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
 * @license   GPL v3
 * @link      http://web-crew.org
 */
session_start();
require_once('Login.php');

if (isset($_POST['Submit'])) {
	

// increase script timeout value
ini_set("max_execution_time", 300);
// create object
$zip = new ZipArchive();
// open archive
if ($zip->open("Backup.zip", ZIPARCHIVE::CREATE) !== TRUE) {
die ("Could not open archive");
}
// initialize an iterator
// pass it the directory to be processed
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("../"));
// iterate over the directory
// add each file found to the archive
foreach ($iterator as $key=>$value) {
$zip->addFile(realpath($key), $key) or die ("Could not add file: $key");
}
// close and save archive
$zip->close();

 header("Content-type: application/zip");
 header("Content-Disposition: attachment; filename=Backup.zip");
 header("Pragma: no-cache");
 header("Expires: 0");
 readfile("Backup.zip");
 unlink("Backup.zip");
 exit;
 
 
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>hh_edit_online</title>
<meta name="description" content="HumHub Edit Online Module">

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


$("td").hover( function() {
        $(this).find(".opendir").show();
        $(this).find(".editfile").show();
        $(this).find(".deletefile").show();
    });

$("td").mouseleave( function() {
        $(this).find(".opendir").hide();
        $(this).find(".editfile").hide();
        $(this).find(".deletefile").hide();
    });
	
	
$(".deletefileid").click(function(){
$(this).find(".attentionbar").slideToggle("fast");
});


$(function() {
	$(window).scroll(function() {
		
		if($(this).scrollTop() != 0) {
			$('#top').fadeIn();	
			$('#top p').fadeIn();
		} else {
			$('#top').fadeOut();
			$('#top p').fadeOut();
		}
	});
 
	$('#top').click(function() {
		$('body,html').animate({scrollTop:0},500);
		
	});	
});
  
});
</script>

</head>

<body>

<div id="navcontainer">


<div class="nav">ACTIONS</div>

<ul class="navpanel top">
<a href='create.php?location=index.php'><li class="first">Create File</li></a>
<a href='createdir.php'><li>Create Folder</li></a>
<a href='upload.php'><li>Upload File</li></a>
<a href='uploadzip.php'><li>Upload ZIP</li></a>
<a href='Logout.php'><li class="last">Logout</li></a>
</ul>

</div>

<div id="container">

<?php

echo "<table>";

if ($handle = opendir("..")) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            if (is_dir(".."."/".$entry) === true){
                
				echo "<tr>";
  				echo "<td><a class='dir' href='open.php?dir=$entry\n'>$entry\n</a> <a class='opendir' href='open.php?dir=$entry\n'>Open</a></td>";
				
            }
			
			else
			
			{
				
			echo "<tr>";
				
			$filetype = substr($entry, strrpos($entry, '.') + 1);

		if ($filetype=="html")
	  		echo "<td><a class='file filehtml' href='edit.php?file=../$entry\n&location=index.php'>$entry\n</a> <a class='editfile' href='edit.php?file=../$entry\n&location=index.php'>Edit</a>
			
			<div class='deletefileid'><a class='deletefile'>Delete</a>
			
						<div class='attentionbar'>Are you sure you want to delete $entry?<a class='confirmdelete' href='delete.php?file=../$entry\n&location=index.php'>Yes</a><a class='noconfirmdelete'>No</a></div></div></td>";
	  
	  elseif ($filetype=="php")
	  		echo "<td><a class='file filephp' href='edit.php?file=../$entry\n&location=index.php'>$entry\n</a> <a class='editfile' href='edit.php?file=../$entry\n&location=index.php'>Edit</a>
			
			<div class='deletefileid'><a class='deletefile'>Delete</a>
			
						<div class='attentionbar'>Are you sure you want to delete $entry?<a class='confirmdelete' href='delete.php?file=../$entry\n&location=index.php'>Yes</a><a class='noconfirmdelete'>No</a></div></div></td>";
	  
	  elseif ($filetype=="css")
	  		echo "<td><a class='file filecss' href='edit.php?file=../$entry\n&location=index.php'>$entry\n</a> <a class='editfile' href='edit.php?file=../$entry\n&location=index.php'>Edit</a>
			
			<div class='deletefileid'><a class='deletefile'>Delete</a>
			
						<div class='attentionbar'>Are you sure you want to delete $entry?<a class='confirmdelete' href='delete.php?file=../$entry\n&location=index.php'>Yes</a><a class='noconfirmdelete'>No</a></div></div></td>";
	  
	  elseif ($filetype=="js")
	  		echo "<td><a class='file filejs' href='edit.php?file=../$entry\n&location=index.php'>$entry\n</a> <a class='editfile' href='edit.php?file=../$entry\n&location=index.php'>Edit</a>
			
			<div class='deletefileid'><a class='deletefile'>Delete</a>
			
						<div class='attentionbar'>Are you sure you want to delete $entry?<a class='confirmdelete' href='delete.php?file=../$entry\n&location=index.php'>Yes</a><a class='noconfirmdelete'>No</a></div></div></td>";
	  
	  elseif ($filetype=="xml")
	  		echo "<td><a class='file filexml' href='edit.php?file=../$entry\n&location=index.php'>$entry\n</a> <a class='editfile' href='edit.php?file=../$entry\n&location=index.php'>Edit</a>
			
			<div class='deletefileid'><a class='deletefile'>Delete</a>
			
						<div class='attentionbar'>Are you sure you want to delete $entry?<a class='confirmdelete' href='delete.php?file=../$entry\n&location=index.php'>Yes</a><a class='noconfirmdelete'>No</a></div></div></td>";
	  
	  elseif ($filetype=="sql")
	  		echo "<td><a class='file filesql' href='edit.php?file=../$entry\n&location=index.php'>$entry\n</a> <a class='editfile' href='edit.php?file=../$entry\n&location=index.php'>Edit</a>
			
			<div class='deletefileid'><a class='deletefile'>Delete</a>
			
						<div class='attentionbar'>Are you sure you want to delete $entry?<a class='confirmdelete' href='delete.php?file=../$entry\n&location=index.php'>Yes</a><a class='noconfirmdelete'>No</a></div></div></td>";
	  
	  elseif ($filetype=="txt")
	  		echo "<td><a class='file filetxt' href='edit.php?file=../$entry\n&location=index.php'>$entry\n</a> <a class='editfile' href='edit.php?file=../$entry\n&location=index.php'>Edit</a>
			
			<div class='deletefileid'><a class='deletefile'>Delete</a>
			
						<div class='attentionbar'>Are you sure you want to delete $entry?<a class='confirmdelete' href='delete.php?file=../$entry\n&location=index.php'>Yes</a><a class='noconfirmdelete'>No</a></div></div></td>";
	  
	  elseif ($filetype=="less")
	  		echo "<td><a class='file fileless' href='edit.php?file=../$entry\n&location=index.php'>$entry\n</a> <a class='editfile' href='edit.php?file=../$entry\n&location=index.php'>Edit</a>
			
			<div class='deletefileid'><a class='deletefile'>Delete</a>
			
						<div class='attentionbar'>Are you sure you want to delete $entry?<a class='confirmdelete' href='delete.php?file=../$entry\n&location=index.php'>Yes</a><a class='noconfirmdelete'>No</a></div></div></td>";
	  
	else

			echo "<td><a class='file fileother'>$entry\n</a> 
			
			<div class='deletefileid'><a class='deletefile'>Delete</a>
			
						<div class='attentionbar'>Are you sure you want to delete $entry?<a class='confirmdelete' href='delete.php?file=../$entry\n&location=index.php'>Yes</a><a class='noconfirmdelete'>No</a></div></div></td>";
				
            }
        }
    }
    closedir($handle);
}

echo "</table>";


echo "<form class='downloadform' action='' method='post'>
<input type='Submit' class='download' name='Submit' value='Download files as ZIP' />
</form>";

?>

<div id="top"><p>&uarr;</p></div>

</div>

</body>
</html>