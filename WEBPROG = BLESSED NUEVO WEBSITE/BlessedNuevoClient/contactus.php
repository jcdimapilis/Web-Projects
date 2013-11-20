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
			<li id="t-about" class="active"><a href="contactus.php"><strong>Contact us<em>info &amp; contact</em></strong></a></li>
			<li id="t-offers" ><a href="offers.php"><strong>Offers<em>things that we sell</em></strong></a></li>
		</ul>
	</nav>
</div> <!-- end #header -->		

<div id="wrapper">
<div id="content"  style= "text-indent: 30px">

<h3 style="text-align: left; text-indent: 10px;">Company Address:</h3>

<p>104 San Miguel St. San Antonio Valley 6, Barangay San Isidro, Sucat Paranaque City, Philippines, 1700</p>

<h3 style="text-align: left; text-indent: 10px;">Contact Numbers:</h3>

<p>Telefax: +632 8253113</p>
<p>Telephone #: +632 542 2416 </p>
<p>Mobile #: +639 27 3548904 / +639 25 10333</p>

<p>E-mail Address: blessednuevo@yahoo.com / bmorota@yahoo.com (Ms. Barbara Morota)</p>

<h3 style="text-align: left; text-indent: 10px;">Ask us anything!</h3>
<p style="text-align: left; text-indent: 10px;">We'll try our best to respond to them as soon as possible.</p>


<FORM METHOD=POST ACTION="method.php">
                    <TABLE>
                    <TR>
                        <TD>Name :</TD>
                        <TD><INPUT TYPE="text" NAME="name" placeholder= "Name goes here..."></TD>
                    </TR>
                    <TR>
                        <TD>Email :</TD>
                        <TD><INPUT TYPE="text" NAME="email" placeholder= "e-mail here..."></TD>
                    </TR>
                    <TR>
                        <TD>Message :</TD>
                        <TD><textarea style="resize:none; left: 65px;" placeholder="Insert message here..." name="message" cols="25" rows="5"></textarea></TD>
                    </TR>
                    <TR>
                        <TD> </TD>
                        <TD><INPUT TYPE="submit" name="submit" value="Post"></TD>
                    </TR>
</TABLE>


</FORM>

</div> <!-- end #content -->

<div id="footer">
	<p>Copyright &copy 2010 <a href="http://www.misteryoshi.tumblr.com" class= "tip" title="Creator">yoshilog</a></p> 
</div> <!-- end #footer -->

		</div> <!-- End #wrapper -->
	</body>
</html> 