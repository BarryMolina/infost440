<?php
// Reusable function to display notifications
function display_notification($notification) {
	if (!isset($notification['alert-level']) || !isset($notification['message'])) {
		return;
	}
	ob_start();
?>
	<div class='alert alert-<?php echo $notification['alert-level'] ?>' role='alert'><?php echo $notification['message'] ?></div>
<?php
	return ob_get_clean();
}

// Function to get pagination and sorting query params when reconstructing urls
function page_location_params() {
	// Adapted from source: https://stackoverflow.com/questions/3454993/get-a-subset-of-an-array-based-on-an-array-of-keys
	$location_params = array('s', 'p', 'sort');
	$params_array = array_intersect_key($_GET, array_flip($location_params));
	$query_string = http_build_query($params_array);
	return $query_string;
}
?>