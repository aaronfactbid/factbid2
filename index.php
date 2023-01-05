<?php 
	 /* Header file **/
	require_once('header.php'); 



	setlocale(LC_MONETARY,"en_US");
?>

<!--------banner------------->
<section>
	<div class="container">
		<div class="fact_banerr">
			<div>
				<h1>How It Works</h1>
				<p>The next time it seems we’re not getting the whole story, come up with a unique hashtag for whatever facts are missing that a whistleblower could provide.  Write a tweet indicating the controversy and what facts the whistleblower would need to prove.  Include the amount you are willing to bid (with a $ € or £ before), or offer the whistleblower.  Include your hashtag plus #factbid.  Get your friends to tweet your hashtag plus their bid and #factbid.<br>
					<br>

The first tweet with your hashtag is the ‘author’ and links to the original tweet.  Everyone can start a tweet with the hashtags filled in and a default bid of $20 by clicking ‘bid’.  Edit the amount and tweet before sending.
<br>
					<br>
Potential whistleblowers can see all the bidders and communicate with them using the author’s tweet.  When you have confirmed you have the data to satisfy the bidders, click ‘claim’ to start a tweet with #factbidclaim.  It must include links to the facts and your donation instructions.
</p>
			</div>
	</div>
</section>
<section class="factbid_wrapsec">
	<div class="container">
		<div class="factbid_wrap">
			<h1>List of factbid tweets</h1>

			<div class="fact_bidtable">
				<table>


<?php	
	$sql = "SELECT * FROM `hashtag` WHERE `exclude`=0 ORDER BY `sort`;";
	$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {  ?>
     <tr>
    <th>Author</th>
    <th>Bids</th>
    <th>Totalling</th>
    <th>Claims</th>
    <th colspan="2">Start a tweet</th>
</tr>
<?php while($row = $result->fetch_assoc()) {
	 ?>
	  <tr>
		<td colspan="6">
			<h2><a href="/<?php echo  $row['hashtag']; ?>">#<?php echo  $row['hashtag']; ?></a></h2>
	<p><?php echo  $row['title']; ?> </p>
		</td>
	</tr>
	<tr>
	
		<th>@<a href="https://twitter.com/<?php echo $row['author'];?>/status/<?php echo $row['tweet_id'];?>"><?php echo $row['author']; ?></a></th>
		<th><a href="/<?php echo  $row['hashtag']; ?>"><?php echo  $row['bids']; ?></a></th>
		<th><a href="/<?php echo  $row['hashtag']; ?>">$<?php echo number_format($row['total']);  ?></a></th>
		<th><a href="/<?php echo  $row['hashtag']; ?>/claims"><?php echo $row['claims'];  ?></a></th>
		<th><a href="#">bid</a></th>
		<th><a href="#">claim</a></th>
	</tr>
<?php
	   }
	}
	 else {
	  echo "0 results";
	}   ?>


</table>
			</div>
		</div>
	</div>
</section>
<?php require_once('footer.php'); ?>