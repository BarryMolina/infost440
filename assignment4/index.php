<?php
include('header.php');
include('mysqli_connect.php');

// Grab all guestbook entries right away
$query = "SELECT guestbook_id, CONCAT(fname, ' ', lname) as name, comment, DATE_FORMAT(date, '%M %e, %Y') as date FROM guestbook";
$results = mysqli_query($dbc, $query);
?>

<main>
	<div class="container">
		<h1>The Guestbook</h1>
		<!-- Guestbook entires in Bootstrap table -->
		<table class="table">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Comment</th>
					<th scope="col">Date</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Generate entry rows
				while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
					$id = $row['guestbook_id'];
					$name = $row['name'];
					$comment = $row['comment'];
					$date = $row['date'];

					echo "<tr>";
					echo "<th scope='row'>$id</th>";
					echo "<td class='text-nowrap'>$name</td>";
					echo "<td>$comment</td>";
					echo "<td class='text-nowrap'>$date</td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	</div>
</main>

<?php include('footer.php'); ?>