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
session_unset();
session_destroy();
header("Location: index.php");
?>