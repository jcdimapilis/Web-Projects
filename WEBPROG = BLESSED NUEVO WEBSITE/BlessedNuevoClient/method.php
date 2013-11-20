<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<meta charset="utf-8">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script src="js/slides.min.jquery.js"></script>
    <script>
        $(function(){
            $('#slides').slides({
                preload: true,
                preloadImage: 'img/loading.gif',
                play: 3500,
                pause: 2000,
                hoverPause: true,
                animationStart: function(current){
                    $('.caption').animate({
                        bottom:-35
                    },100);
                    if (window.console && console.log) {
                        // example return of current slide number
                        console.log('animationStart on slide: ', current);
                    };
                },
                animationComplete: function(current){
                    $('.caption').animate({
                        bottom:0
                    },200);
                    if (window.console && console.log) {
                        // example return of current slide number
                        console.log('animationComplete on slide: ', current);
                    };
                },
                slidesLoaded: function() {
                    $('.caption').animate({
                        bottom:0
                    },200);
                }
            });
        });
    </script>

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<meta name="author" content="" />

<link rel="stylesheet" type="text/css" href="style.css" media="screen" />

<title>Nuevo Fresco Marine Corporation</title>

</head>

    <body>

<div id="header">

<nav role="navigation">
        <ul type = "none" class="group">
            <li id="t-home" ><a href="home.php"><strong>Home <em>the corporation</em></strong></a></li>
            <li id="t-profile" ><a href="aboutus.php"><strong>About Us<em>profile</em></strong></a></li>
            <li id="t-about" ><a href="contactus.php"><strong>Contact us<em>info &amp; contact</em></strong></a></li>
            <li id="t-offers" ><a href="offers.php"><strong>Offers<em>things that we sell</em></strong></a></li>
        </ul>
    </nav>
</div> <!-- end #header -->     

<div id="wrapper" style="text-align:center;">

<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "nuevo_fresco_messages";

mysql_connect($db_host,$db_user,$db_password) or die(mysql_error());
mysql_select_db($db_name) or die(mysql_error());

if($_POST['submit']) {
// 1. Validate it, by checking all the form inputs were filled in
    if(!$_POST['name']) {
        echo 'Error ! : No name entered';
        die;
    }
    if(!$_POST['email']) {
        echo 'Error ! : No email entered';
        die;
    }
    if(!$_POST['message']) {
        echo 'Error ! : No message entered';
        die;}
}

$message = strip_tags($_POST['message'], '');
$email = strip_tags($_POST['email'], '');
$name = strip_tags($_POST['name'], '');

$message_length = strlen($message);
    $author_length = strlen($name);
    if($message_length > 150) {
        echo "Error ! : Your message was too long, messages must be less than 150 chars";
        die;
    }
    if($author_length > 150) {
        echo "Error ! : Your name was too long, names must be less than 150 chars";
        die;}
    else
        echo "Thank you, your message has been sent.";
$query = "INSERT INTO nuevo_fresco_messages (NAME, EMAIL_ADDRESS, MESSAGE) VALUES('$name', '$email', '$message')";

mysql_query($query);

?>

<div id="content"  style= "text-indent: 30px">

<?php
echo "Thank you. Please refer to navigation bar to leave page."?>

</div> <!-- end #content -->

<div id="footer">
    <p>Copyright &copy 2010 <a href="http://www.misteryoshi.tumblr.com" class= "tip" title="Creator">Nuevo Fresco | yoshilog</a></p> 
</div> <!-- end #footer -->

        </div> <!-- End #wrapper -->
    </body>
</html> 
  