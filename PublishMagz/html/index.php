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

// Include the header file:
include('./includes/header.html');

/* PAGE CONTENT STARTS HERE! */
?><h1>Welcome</h1> 
 <p class="lead">Welcome to PublishMagz, a site where you can write any kind of informative content and publish them as magazines so that the whole world can learn and benefit from your knowledgeable and fun articles.</p>
	<p>Simple, easy to use and free service which lets you publish your content as beautiful magazines or high quality pdf's. Sit right, relax and your high quality pdf or magazine will be ready in a blink of your eye. We are proud to incorporate amazing text processing algorithms to provide you good feedback based on the content you have written. The powerful algorithms will provide you details on your written content like lexical diversity (how many various words have been used and repeated through out the article) so that you can modify your content with other unused words which helps you remove the redundancy in your writing. We bring you recommendations and favorites to you so that you never miss a beautiful article or a magazine created and shared by your peers through out the world. Its a gorgeous platform, go create your first magazine right now and this is just a start. There is much to come in the later releases. Stay tuned and publish your magazines with PublishMag.</p>


<?php /* PAGE CONTENT ENDS HERE! */

// Include the footer file to complete the template:
include('./includes/footer.html');
?>
