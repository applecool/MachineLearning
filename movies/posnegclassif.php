<html>
<body>


<?php

echo '<h2>Positive or Negative text categorization</h2>';
echo '<p>Enter text to categorize such as:';
echo '<br />It was as funny as I remember and brilliant because it is subtle. It just knocks it ';
echo 'out of the park. I love everything about this movie, one of my favorite Pixar movies of all time, ';
echo '5/5 Schmoes. The new sound/3D adds to the greatness that is Nemo. </p>';

//echo exec("pwd");
//echo $output[1];
////////////////////////////////////////////////////////////////////////////////////

//$command = "/var/chroot/home/content/31/5769131/html/cgi/ricardo.py";
//$temp = exec($command, $output);
//echo $temp; //this has data

////////////////////////////////////////////////////////////////////////////////////

echo '<br /><form action="" method="post"><textarea name="username" cols="60" rows="5"> </textarea><input type="submit" value="Click" /></form>';
$test = $_POST['username'];
echo $test;
echo '<br />';


//echo $_POST['select'];
$object_page->edit_status = $_POST['listbox'];
//echo $object_page->edit_status;



//$data = array('as', 'df', 'gh');
$data = 'Robert';
$data = $test;
$command = '/Applications/XAMPP/htdocs/movies/moviereviews.py ';
$result = shell_exec($command . escapeshellarg(json_encode($data)));

$resultData = json_decode($result, true);
var_dump($resultData);
echo "<br />";
echo $resultData;
echo "<br />";


?>



<br />
<a href="http://www.rcalix.com">rcalix.com</a>
</body>
</html>
