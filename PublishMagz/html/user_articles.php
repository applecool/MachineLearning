<?php

// This file is the home page.
// This script is begun in Chapter 3.

// Require the configuration before any PHP code as the configuration controls error reporting:
require('./includes/config.inc.php');
// The config file also starts the session.

// To test the sidebars:
//$_SESSION['user_id'] = 1;
//$_SESSION['user_admin'] = true;
$_SESSION['user_not_expired'] = true;
//$_SESSION=array();

// Require the database connection:
require(MYSQL);

// Next block added in Chapter 4:
// If it's a POST request, handle the login attempt:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include('./includes/login.inc.php');
}

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
				<h3 class="text-success"> User Content</h3>
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
			
<h1>Publications</h1>
 <p class="lead">Welcome to PublishMagz, a site where you can write any kind of informative content and publish them as magazines so that the whole world can learn and benefit from your knowledgeable and fun articles.</p>
 
 <?php
 	if(mysqli_num_rows($r) === 0){
 		echo '<p class="lead">You have 0 Publications. Please create new publications by going to the <a href="add_page.php">Add Page</a> from the navigation bar.</p>';
 	}
 ?>
	
<?php /* PAGE CONTENT ENDS HERE! */

// Include the footer file to complete the template:
include('./includes/footer.html');
?>