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

if(isset($_POST['submit']))
{
    loginaction();
}
else
{
        sessioncheck();
}

function loginaction()
{
    
    $users = array();
    $users['admin'] = 'pass';  // Change the default username (admin) and password (pass) to something of your choice. You can have as many editor-users as You want! You only have to copy and paste the code line: $users['admin'] = 'pass'; and fill in new login data and paste it under the first one.
    
    if(array_key_exists($_POST['user'], $users))
    {
        if($_POST['password'] == $users[$_POST['user']])
        {
            $_SESSION['login']['user'] = sha1(md5($_POST['user']));
            $_SESSION['login']['password'] = sha1(md5($_POST['password']));
        }
        else
        {
            echo "<div id='message'>Wrong Username or Password</div>";
            showform();
            exit();
        }
    }
    else
    {
        echo "<div id='message'>Wrong Username or Password</div>";
        showform();
        exit();
    }
}

function sessioncheck()
{
    if(!isset($_SESSION['login']['user']) || !isset($_SESSION['login']['password']))
    {
        showform();
        exit();
    }
}

function showform()
{
?>
		<html>
        <head>
        
        <title>hh_edit_online</title>
        
            <style type="text/css">

            body {
                font-family: Helvetica;
                font-size: 12px;
                color: #555;
                background: #eee;
            }

            form {
                width: 440px;
                margin: 10% auto;
            }

            input[type="text"]{
                font-size: 14px;
                color: #555;
                width: 220px;
                height: 34px;
				padding: 4px;
                border: 1px solid #ccc; 
				float: left;
				margin-bottom: 7px;
            }

             input[type="text"]:focus{
                outline: none;
                background: #fff;
                border-color: #7395A9;
            }
			
			input[type="password"]{
                font-size: 14px;
                color: #555;
                width: 220px;
                height: 34px;
				padding: 4px;				
                border: 1px solid #ccc;
				border-left: none;  
				margin-bottom: 7px;
            }

             input[type="password"]:focus{
                outline: none;
                background: #fff;
                border-color: #7395A9;
            }
			
			input[type="Submit"] {
  				font-weight: bold;
  				color: #fff;
  				background: #7395A9;
  				padding: 5px 5%;
  				border: none;
                margin-left: 40%;

			}

			input[type="Submit"]:hover {
  				background: #7395A9;
			}			

            #message {
  				color: #dc4545;
  				text-align: center;
                }

            </style>
            </head>
        <body>

        <form method="post" action="">
        
        <input type="text" name="user" placeholder="Username" />
        <input type="password" name="password" placeholder="Password" />
        <br />
        <input type="submit" name="submit" value="Login" />
        </form>
        
        </div>

    </body>
    </html>
<?php
}
?>
