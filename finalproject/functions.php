<?php
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
