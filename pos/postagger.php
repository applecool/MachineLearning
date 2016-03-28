<html>
<body>


<?php

echo '<h2>Part-of-Speech Tagger using Naive Bayes and the Brown Corpus</h2>';
echo '<p>Enter the sentence you wish to tag such as:';
echo '<br /> Truly, truly, I say to you, a slave is not greater than his master, nor is one who is sent greater than the one who sent him. </p>';

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
$data = $test;
//$command = "/Applications/XAMPP/htdocs/pos/pos_check.py";
//$result = shell_exec($command . escapeshellarg(json_encode($data)));
$result = shell_exec('python "/Applications/XAMPP/htdocs/pos/postagger.py" ' . escapeshellarg(json_encode($data)));
$resultData = json_decode($result, true);
//var_dump($resultData);
echo "<br />";
//echo $result;
echo $resultData;
echo "<br />";


?>



<br />

</body>
</html>
