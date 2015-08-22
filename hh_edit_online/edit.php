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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit now</title>

<link rel="stylesheet" type="text/css" href="css/style.css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script language="javascript">
function getURLParam(strParamName){ 
var strReturn = ""; 
var strHref = window.location.href; 
if ( strHref.indexOf("?") > -1 ){ 
var strQueryString = strHref.substr(strHref.indexOf("?")); 
var aQueryString = strQueryString.split("&"); 
for ( var iParam = 0; iParam < aQueryString.length; iParam++ ){ 
if (aQueryString[iParam].indexOf(strParamName + "=") > -1 ){ 
var aParam = aQueryString[iParam].split("="); 
strReturn = aParam[1]; 
break; 
} 
} 
} 
return strReturn; 
}

$(document).ready(function() {
 
    $(".notify").click(function(e) {
		// we want to store the values from the form input box, then send via ajax below
	var content     = $('#content').attr('value');
	
		$.ajax({
			type: "POST",
			url: "editfile.php?file="+getURLParam('file'),
			data: "content="+ content,
			success: function(){
				
				
				e.preventDefault();
        $("#notification").animate({top: 0}, 300, null);
        //for css positioning problem
        $("#notification").css("position", "fixed");
 
        //Hide the bar
        $notifyTimer = setTimeout(function () {
            $("#notification").animate({top: -100}, 1000, function() {
                    //change back to absolute
                    $("#notification").css("position", "absolute");
                });
 
        }, 2000);
		

			}
		});
	return false;
	});
	
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

<div id='notification'>Saved</div>

<div id="container">

<?php 
// set file to read 
$filename = $_GET['file'];

// open file 
  $fh = fopen($filename, "r") or die("Could not open file!"); 
// read file contents 
  $data = fread($fh, filesize($filename)) or die("Could not read file!"); 
// close file 
  fclose($fh); 
// print file contents
 echo "<form class='edit' action='' method='post'>
<textarea id='content' name='content' cols='118' rows='20'> $data </textarea> 
<input type='submit' class='notify' name='Submit' value='Save'>
</form>";

?>

<a class='return' href='<?php echo $_GET['location'] ?>'>&larr; Back to root</a>

</div>

</body>
</html>