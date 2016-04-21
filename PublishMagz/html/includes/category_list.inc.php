 
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
$q = 'SELECT * FROM categories ORDER BY category';
$r = mysqli_query($dbc, $q);
while (list($id, $category) = mysqli_fetch_array($r, MYSQLI_NUM)) {
	echo '<a href="category.php?id=' . $id . '" class="list-group-item" title="' . $category . '">' . htmlspecialchars($category) . '
	</a>';
}
?>
			  <a href="pdfs.php" class="list-group-item" title="PDFs">PDF Guides
			  </a>
			</div><!--/list-group-->

			</div><!--/col-3-->


		  <div class="col-9">
			<!-- CONTENT -->
			