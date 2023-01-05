<?php
   require_once('header.php');

	$current_hastag = $_GET['hashtag'];
 
   
	$sql = "SELECT * FROM hashtag";
	$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {  ?>
<table>
     <tr>
    <th>Author</th>
    <th>Bids</th>
    <th>Totalling</th>
    <th>Claims</th>
    <th colspan="2">Start a tweet</th>
</tr>
<?php while($row = $result->fetch_assoc()) {  ?>
	
	<tr>
		<th>@<a href="#"><?php echo  $row['author']; ?></a></th>
		<th><a href="#"><?php echo  $row['bids']; ?></a></th>
		<th><a href="#">$<?php echo number_format($row['total']);  ?></a></th>
		<th><a href="#"><?php echo $row['claims'];  ?></a></th>
		<th><a href="#">bid</a></th>
		<th><a href="#">claim</a></th>
	</tr>
	</table>
<?php } 
	} 
	else {
	  echo "0 results";
	}   
require_once('footer.php');
?>