<?php
 $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
                === 'on' ? "https" : "http") . 
                "://" . $_SERVER['HTTP_HOST'] . 
                $_SERVER['REQUEST_URI'];
	
$site_url =  "https://".$_SERVER['SERVER_NAME'];	
	
	/** DB Connection file */
	require_once('config.php');
	header("Cache-Control: public, max-age=600");
	
	function tweet_bid($hashtag,$id_twitter,$author_username,$template,$tweet_url) {
		$url = "https://twitter.com/intent/tweet?";
		
		if( $template == NULL ) {
			$template = "I bid $20 for #" . $hashtag . ". #factbid. Track bids and add your own at https://factbid.org/" . $hashtag;
		}

		$url .= "text=" . urlencode($template);
		if( $tweet_url == NULL ) {
			$url .= "&url=https://twitter.com/" . $author_username . "/status/" . $id_twitter;
		}
		else
		{
			$url .= "&url=" . $tweet_url;
		}
		/* $url .= "&via=" . $author_username . "&in_reply_to=" . $id_twitter; */
		return $url;
	}

	function tweet_claim($hashtag,$id_twitter,$author_username) {
		$url = "https://twitter.com/intent/tweet?";
		
		$template = "Here is the evidence for #" . $hashtag . " and my donation instructions. #factbidclaim";

		$url .= "text=" . urlencode($template);
		$url .= "&url=https://twitter.com/" . $author_username . "/status/" . $id_twitter;
		/* $url .= "&via=" . $author_username . "&in_reply_to=" . $id_twitter; */
		return $url;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>

	<link rel="stylesheet" href="<?php echo $site_url ;	?>/css/style.css">
	<link rel="stylesheet" href="<?php echo $site_url ;	?>/fonts/stylesheet.css">
</head>
<body>
	<div class="container">
	<header>
		<div class="">
			<nav class="header-logos">
				<table style="background-color:#ecf0f3; width:100%; table-layout:fixed;">
					<tr>
						<td style="width:auto;">
							<div class="fect_logo">
								<a href="<?php echo $site_url ; ?>"><img src="<?php echo $site_url ; ?>/images/logo-round-medium.png"></a>
							</div>
						</td>
						<td style="text-align:center;">
							<div class="wrapper_logo" style="display:inline-block;">
								AI identifies missing facts humanity needs<br>
								We crowdsource them
							</div>
							<br>
							<div class="wrapper_logo" style="display:inline-block; margin-top:10px;">
								<ul style="padding:0; list-style:none; display:inline-flex; justify-content:center; align-items:center; margin:0;">
									<li><a href="https://twitter.com/factbid"><img src="<?php echo $site_url ; ?>/images/Twitter.png"></a></li>
									<li><a href="https://rumble.com/factbid"><img src="<?php echo $site_url ; ?>/images/rumble.png"></a></li>
									<li><a href="https://youtube.com/@factbidorg"><img src="<?php echo $site_url ; ?>/images/youtube.png"></a></li>
									<li><a href="https://factbid.substack.com/about"><img src="<?php echo $site_url ; ?>/images/SubStack.png"></a></li>
									<li><a href="https://github.com/aaronfactbid"><img src="<?php echo $site_url ; ?>/images/Git_Hub.png"></a></li>
									<li><a href="mailto:admin@factbid.org"><img src="<?php echo $site_url ; ?>/images/Mail.png"></a></li>
								</ul>
							</div>
						</td>
					</tr>
				</table>
			</nav>
		</div>
	</header>
