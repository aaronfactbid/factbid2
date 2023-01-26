<?php 
	 /* Header file **/
	require_once('header.php'); 



	setlocale(LC_MONETARY,"en_US");
?>

<!--------banner------------->
<section>
		<div class="fact_banerr">
			<div>
				<h1>How it works</h1>
				<p>Create a hashtag for some fact that a whistleblower could produce, like #EpsteinClientList.
				Tweet an explanation including what facts you are offering to reward a whistleblower to provide and how much you are willing to bid.  The tweet must include your hashtag plus #factbid.
				For example, create a video or blog post explaining some controversy you want to resolve and attach it to a tweet that has your hashtag, like: <b><i>I bid $50 for a whistleblower to produce the #EpsteinClientList.  #factbid</b></i></p>
				<p>This page lists all tweets with some hashtag(s) plus #factbid and a valid bid, meaning $ € or £ followed by an amount.
				Whatever tweet is the first with that hashtag is shown as the 'author'.  This page shows the hashtag and total tweets.  Select the hashtag to see the full list of tweets.
				Get your followers to tweet their own bid.  The easiest way is to click the 'bid' link, which starts a tweet with the hashtags filled in, ready to edit the amount and send.
				</p>
				<p>To learn more visit <a href="https://factbid.substack.com/about">https://factbid.substack.com/about</a></p>
			</div>
</section>
<section class="factbid_wrapsec">
		<div class="factbid_wrap">
			<h1>List of #factbid tweets</h1>
			<p>There is a 10 minute delay before tweets appear.</p>

			<div class="fact_bidtable">
				


<?php	
	$sql = "SELECT * FROM `hashtag` WHERE `exclude`=0 ORDER BY `sort`;";
	$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {  ?>
	<table>
     
     <thead><tr>
    <th>Author</th>
    <th>Bids</th>
    <th>Total</th>
    <th>Claims</th>
    <th colspan="2">Start a tweet</th>
</tr></thead>
<?php while($row = $result->fetch_assoc()) {
	 ?>
	  <tr>
		<td colspan="6">
			<h2>#<a href="/<?php echo  $row['hashtag']; ?>"><?php echo  $row['hashtag']; ?></a></h2>
	<p><?php echo  $row['title']; ?> </p>
		</td>
	</tr>
	<tr>
		<th>@<a href="https://twitter.com/<?php echo  $row['author_username']; ?>/status/<?php echo  $row['id_twitter']; ?>"><?php echo  $row['author_username']; ?></a></th>
		<th><a href="/<?php echo  $row['hashtag']; ?>"><?php echo  $row['bids']; ?></a></th>
		<th>$<?php echo number_format($row['total']);  ?></th>
		<th><a href="/claims.php?claims=<?php echo $row['id_hashtag']; ?>"><?php echo $row['claims']; ?></a></th>
		<th><a href="<?php echo tweet_bid($row['hashtag'],$row['id_twitter'],$row['author_username'],$row['template']); ?>">bid</a></th>
		<th><a href="<?php echo tweet_claim($row['hashtag'],$row['id_twitter'],$row['author_username']); ?>">claim</a></th>
	</tr>
<?php
	   } ?>
	   </table>
<?php	}
	 else {
	  echo "No tweets with #factbid yet.  You can be the first.";
	}   ?>



			</div>
		</div>
</section>
<?php require_once('footer.php'); ?>
