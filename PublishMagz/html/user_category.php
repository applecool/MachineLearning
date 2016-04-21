<?php

// This page displays the articles listed within a given category.
// This script is created in Chapter 5.

// Require the configuration before any PHP code as the configuration controls error reporting:
require('./includes/config.inc.php');
// The config file also starts the session.

// Require the database connection:
require(MYSQL);

// Validate the category ID:
if (filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
	$cat_id = $_GET['id'];

	// Get the category title:
	$q = 'SELECT category FROM categories WHERE id=' . $cat_id;
	$r = mysqli_query($dbc, $q);
	if (mysqli_num_rows($r) !== 1) { // Problem!
		$page_title = 'Error!';
		include('./includes/header.html');
		echo '<div class="alert alert-danger">This page has been accessed in error.</div>';
		include('./includes/footer.html');
		exit();
	}
	
	// Fetch the category title and use it as the page title:
	list($page_title) = mysqli_fetch_array($r, MYSQLI_NUM);
	include('./includes/header.html');
	?>
	<!-- Begin page content -->
      <div class="container">

		<div class="row">

			<div class="col-3">
			<?php // Should we show the login form?
if (!isset($_SESSION['user_id'])) {
	require('includes/login_form.inc.php');
}
?>
				<h3 class="text-success">Content</h3>
			<div class="list-group">
<?php // Dynamically generate the content links:
$q = 'SELECT DISTINCT C.id, C.category FROM `categories` C INNER JOIN `pages` P ON C.id = P.categories_id WHERE p.Created_By ="'.$_SESSION['username'].'" ORDER BY category';
$r = mysqli_query($dbc, $q);
while (list($id, $category) = mysqli_fetch_array($r, MYSQLI_NUM)) {
	echo '<a href="user_category.php?id=' . $id . '" class="list-group-item" title="' . $category . '">' . htmlspecialchars($category) . '
	</a>';
}
?>
			  
			</div><!--/list-group-->

			</div><!--/col-3-->


		  <div class="col-9">
			<!-- CONTENT -->
<?php
	echo '<h1>' . htmlspecialchars($page_title) . '</h1>';
	
	// Print a message if they're not an active user:
	// Change the message based upon the user's status:
	if (isset($_SESSION['user_id']) && !isset($_SESSION['user_not_expired'])) {
		echo '<div class="alert"><h4>Expired Account</h4>Thank you for your interest in this content. Unfortunately your account has expired. Please <a href="renew.php">renew your account</a> in order to access site content.</div>';
	} elseif (!isset($_SESSION['user_id'])) {
		echo '<div class="alert">Thank you for your interest in this content. You must be logged in as a registered user to view site content.</div>';
	}
	elseif (isset($_SESSION['user_id']))
{
	// Get the pages associated with this category:
	$q = 'SELECT id, title, description FROM pages WHERE categories_id=' . $cat_id . ' AND Created_By="'.$_SESSION['username'].'" ORDER BY date_created DESC';
	$r = mysqli_query($dbc, $q);
	if (mysqli_num_rows($r) > 0) { // Pages available!
	
		// Fetch each record:
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

			// Display each record:
			echo '<div><h4><a href="page.php?id=' . $row['id'] . '">' . htmlspecialchars($row['title']) . '</a></h4><p>' . htmlspecialchars($row['description']) . '</p></div>';

		} // End of WHILE loop.
		
	} else { // No pages available.
		echo '<p>There are currently no pages of content associated with this category. Please check back again!</p>';
	}

} else { // No valid ID.
	$page_title = 'Error!';
	include('./includes/header.html');
	echo '<div class="alert alert-danger">This page has been accessed in error.</div>';
} // End of primary IF.
}?>

			<?php
// Include the HTML footer:
include('./includes/footer.html');
?>