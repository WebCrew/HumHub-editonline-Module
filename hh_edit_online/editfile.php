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

$filename = $_GET['file'];

$contentdata = $_REQUEST['content'];

// open file  
$fw = fopen($filename, 'w') or die('Could not open file!'); 
// write to file 
// added stripslashes to $contentdata 
$fb = fwrite($fw,stripslashes($contentdata)) or die('Could not write  
to file'); 
// close file 
fclose($fw);

?>

