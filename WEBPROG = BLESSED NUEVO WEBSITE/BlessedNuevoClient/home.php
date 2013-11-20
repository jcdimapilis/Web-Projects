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
/*	
	<div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : 'YOUR_APP_ID', // App ID
            channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml      : true  // parse XFBML
          });
          FB.ui({ 
            method: 'feed' 
          });
        };
        // Load the SDK Asynchronously
        (function(d){
           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           ref.parentNode.insertBefore(js, ref);
         }(document));
      </script>
*/
	
	
	
<div id="header">

<nav role="navigation">
		<ul type = "none" class="group">
			<li id="t-home" class="active"><a href="home.php"><strong>Home <em>the corporation</em></strong></a></li>
			<li id="t-profile" ><a href="aboutus.php"><strong>About Us<em>profile</em></strong></a></li>
			<li id="t-about" ><a href="contactus.php"><strong>Contact us<em>info &amp; contact</em></strong></a></li>
			<li id="t-offers" ><a href="offers.php"><strong>Offers<em>things that we sell</em></strong></a></li>
		</ul>
	</nav>
</div> <!-- end #header -->		

<div id="wrapper">
<!-- start of Image Slide -->
<div id="container">
	<h2 style = "text-align: center;">Greetings!</h2>
<h4 style = "text-align: center;">We are from Nuevo Fresco Marine Corporation!</h4>
		<div id="carousel">
			<div id="slides">
				<div class="slides_container">
					<div class="slide">
						<a href="offers.php" title="Food" target="_blank"><img src="img/slide-2.jpg" width="570" height="270" alt="Slide 2"></a>
						<div class="caption">
							<p>Take a glimpse of what we have to offer!</p>
						</div>
					</div>
					<div class="slide">
						<a href="aboutus.php" title="Tunas" target="_blank"><img src="img/slide-3.jpg" width="570" height="270" alt="Slide 3"></a>
						<div class="caption">
							<p>Only the freshest!</p>
						</div>
					</div>
					<div class="slide">
						<a href="contactus.php" title="Opinions" target="_blank"><img src="img/slide-4.jpg" width="570" height="270" alt="Slide 4"></a>
						<div class="caption">
							<p>Tell us more about what you think.</p>
						</div>
					</div>
				</div>
				<a href="#" class="prev"><img src="img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src="img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
			</div>
			<img src="img/example-frame.png" width="739" height="341" alt="Example Frame" id="frame">
		</div>
	</div> <!-- End of Image Slide -->
<div id="content" style= "text-indent: 30px">
<h3> Welcome to Nuevo Fuesco's site! </h3>
<p> Our motto is "Always Fresh!"</p>
<p> As our name implies, we strive to provide you with only the freshes quality tuna daily from an EU - HACCP approved processing plant...</p>
<p> We follow the basic - steps Quality Check Process to come up with a globally competitive product... </p>


<p> Small as it is, Nuevo Fresco Marine Trading Corp. is considered a world-class processing plant with its HACCP compliance.</p>

<a href="aboutus.php" class= "tip" title="From producing, to packaging - we keep it clean!"><img src="images/small 5.jpg" style="display:block; margin-left: auto; margin-right: auto;"></img></a>

</div> <!-- end #content -->


<div id="footer">
	<p>Copyright &copy 2010 <a href="http://www.misteryoshi.tumblr.com" class= "tip" title="Creator">dsgnsby111</a></p> 
</div> <!-- end #footer -->

		</div> <!-- End #wrapper -->

	</body>

</html>
