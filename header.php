<?php
 $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
                === 'on' ? "https" : "http") . 
                "://" . $_SERVER['HTTP_HOST'] . 
                $_SERVER['REQUEST_URI'];
	
$site_url =  "https://".$_SERVER['SERVER_NAME'];	
	
	/** DB Connection file */
	require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>

	<link rel="stylesheet" href="<?php echo $site_url ;	?>/factbid/css/style.css">
</head>
<body>
	<header>
		<div class="container">
			<nav class="header-logos">
				<div class="fect_logo">
					<a href="<?php echo $site_url ;	?>/factbid"><img src="<?php echo $site_url ;	?>/factbid/images/FACT-LOGO.png"></a>
				</div>
				<div class="wrapper_logo">
					<ul>
						<li><a href="#"><img src="<?php echo $site_url ;	?>/factbid/images/Twitter.png"></a></li>
						<li><a href="#"><img src="<?php echo $site_url ;	?>/factbid/images/SubStack.png"></a></li>
						<li><a href="#"><img src="<?php echo $site_url ;	?>/factbid/images/Git_Hub.png"></a></li>
						<li><a href="#"><img src="<?php echo $site_url ;	?>/factbid/images/Mail.png"></a></li>
					</ul>
				</div>
			
		
	</nav>
		
	</header>

</body>
</html>