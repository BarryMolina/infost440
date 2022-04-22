<?php
include('header.php');
include('mysqli_connect.php');

//***********************************************
//PAGINATION SETUP START
//From Textbook Script 10.5 - #5
//***********************************************

// Number of records to show per page:
$display = 5;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
	// Count the number of records:
	$q = "SELECT COUNT(guestbook_id) FROM guestbook";
	$r = mysqli_query($dbc, $q);
	$rowp = mysqli_fetch_array($r, MYSQLI_NUM);
	$records = $rowp[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil($records / $display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

//***********************************************
//PAGINATION SETUP END
//***********************************************

//***********************************************
//SORTING SETUP START
//From Textbook Script 10.5 - #5
//***********************************************

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'date';

// Determine the sorting order:
switch ($sort) {
	case 'lname':
		$order_by = 'lname ASC';
		break;
	case 'fname':
		$order_by = 'fname ASC';
		break;
	case 'date':
		$order_by = 'date DESC';
		break;
	default:
		$order_by = 'date DESC';
		$sort = 'date';
		break;
}

//Sort buttons
echo '<div align="center">';
echo '<strong> Sort By: </strong>';
echo '<a href="?sort=fname">First Name</a> |';
echo '<a href="?sort=lname">Last name</a> |';
echo '<a href="?sort=date">Date</a>';
echo '</div>';

//***********************************************
//SORTING SETUP END
//***********************************************

// Grab all guestbook entries right away
// OLD $query = "SELECT guestbook_id, CONCAT(fname, ' ', lname) as name, comment, DATE_FORMAT(date, '%M %e, %Y') as date FROM guestbook";
$query = "SELECT guestbook_id, CONCAT(fname, ' ', lname) as name, comment, DATE_FORMAT(date, '%M %e, %Y') as date FROM guestbook ORDER BY $order_by LIMIT $start, $display";

$results = mysqli_query($dbc, $query);
?>

<main>
	<div class="container">
		<h1>The Guestbook</h1>
		<!-- Guestbook entires in Bootstrap table -->
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Comment</th>
					<th scope="col">Date</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Generate entry rows
				while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
					$name = $row['name'];
					$comment = $row['comment'];
					$date = $row['date'];

					echo "<tr>";
					echo "<td class='text-nowrap'>$name</td>";
					echo "<td>$comment</td>";
					echo "<td class='text-nowrap'>$date</td>";
					echo "<td><img src='./icons/pencil.svg'/><img src='./icons/trash3.svg'/></td>";
					// 	echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
					// 	<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
					// </svg></td>';
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		<?php
		//***********************************************
		//PAGINATION PREVIOUS AND NEXT PAGE BUTTONS/LINKS START
		//***********************************************

		// Make the links to other pages, if necessary.
		if ($pages > 1) {

			echo '<br /><p>';
			$current_page = ($start / $display) + 1;

			// If it's not the first page, make a Previous button:
			if ($current_page != 1) {
				echo '<a href="?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
			}

			// Make all the numbered pages:
			for ($i = 1; $i <= $pages; $i++) {
				if ($i != $current_page) {
					echo '<a href="?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
				} else {
					echo $i . ' ';
				}
			} // End of FOR loop.

			// If it's not the last page, make a Next button:
			if ($current_page != $pages) {
				echo '<a href="?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
			}

			echo '</p>'; // Close the paragraph.

		} // End of links section.

		//***********************************************
		//PAGINATION PREVIOUS AND NEXT PAGE BUTTONS/LINKS END
		//***********************************************
		?>
	</div>
</main>

<?php include('footer.php'); ?>