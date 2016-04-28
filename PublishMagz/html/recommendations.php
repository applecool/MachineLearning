<?php

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
$category_list = '';
while (list($id, $category) = mysqli_fetch_array($r, MYSQLI_NUM)) {
	echo '<a href="user_category.php?id=' . $id . '" class="list-group-item" title="' . $category . '">' . htmlspecialchars($category) . '
	</a>';
	$category_list = $category_list."'".$category."',";
}
?>

                    </div>
                    <!--/list-group-->

            </div>
            <!--/col-3-->


            <div class="col-9">
                <!-- CONTENT -->

                <h1>Recommendations</h1>
                <?php
 	if(mysqli_num_rows($r) === 0){
 		echo '<p class="lead">You have 0 Publications. Please create new publications to get personalized recommendations.</p>';
 		
 	} else{
 		 echo'<p class="lead">Welcome to your recommendations page, here are your personalized recommendations based on your published posts.</p>';
 		
//  		$category_list= rtrim($category_list,','); 
//  		$q = 'SELECT DISTINCT category FROM `categories` WHERE id in (
// SELECT CG.child FROM `category_grouping` CG INNER JOIN `categories` C ON C.id = CG.parent WHERE C.category IN ('.$category_list.')) AND category NOT IN ('.$category_list.')';
// $r = mysqli_query($dbc, $q);
// echo '<ul>';
// while (list( $category) = mysqli_fetch_array($r, MYSQLI_NUM)) {
// 	echo '<li>'.$category. '</li>';
	
// }
// echo '</ul>';
 		 $final_content = '';
 		 $q = "SELECT content FROM `pages` WHERE `Created_By` = '".$_SESSION['username']."'";
 		 $r = mysqli_query($dbc, $q);
 		 echo '<ul>';
 		 while(list($c) = mysqli_fetch_array($r, MYSQL_NUM)){
 		 	$final_content = $c;
 		 
 		 //echo $final_content;
 		 $data = $final_content;
 		 $result = shell_exec('python "/Applications/XAMPP/htdocs/pos/postagger.py" ' . escapeshellarg(json_encode($data)));
         echo '<li class="lead">';
         echo $result;
         echo '</li>';
     }
     echo '</ul>';
 	}
 ?>


                    <?php /* PAGE CONTENT ENDS HERE! */

// Include the footer file to complete the template:
include('./includes/footer.html');
?>