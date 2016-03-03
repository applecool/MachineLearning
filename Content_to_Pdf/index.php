<?php
if(isset($_POST['submit'])){

    //Get the form information
    $name = $_POST['name'];
    $email = $_POST['email'];
    $content = $_POST['content'];

    //Name Validation - If the name is set or not?
    if($name ==''){
        $error[] = 'Name is a required field';
    }

    //Email address validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         $error[] = 'Please enter a valid email address';
    }

    //if no errors carry on
    if(!isset($error)){

        //create html of the data
        ob_start();
        ?>

        <h1>Data from form</h1>
        <p>Name: <?php echo $name;?></p>
        <p>Email: <?php echo $email;?></p>
        <p>Content: <?php echo $content;?></p>

        <?php
        $body = ob_get_clean();

        $body = iconv("UTF-8","UTF-8//IGNORE",$body);

        include("mpdf/mpdf.php");
        $mpdf=new \mPDF('c','A4','','' , 0, 0, 0, 0, 0, 0);

        //write html to PDF
        $mpdf->WriteHTML($body);

        //output pdf
        $mpdf->Output('output.pdf','D');

        //save to server
        //$mpdf->Output("mydata.pdf",'F');



    }

    $method = "POST";
    $url = "http://www.joomag.com/api/2.0/magazines";
    $params = array('title'=>'My New Magazine', 'description'=>'New Magazine Description');

    ksort($params);

    $paramsStr = implode($params);
    $sig = hash_hmac('sha256', $method . $url . $paramsStr, 'sec_c90bf438870945347596d5bb31308817aff2afb80c71bc23b2d0b9036d9f7d2f2e4c0e21a3cd1b77cce51487d3de69e84bd4b6a02bd3c895cd42a5aab39fa904');

    $headers = array(
    	'key:' . 'api_4cb3b53d38f80064bc6befe66a9092b8',
    	'sig:' . $sig,
    	// other headers...
    );

    $ch = curl_init();
    // other curl options...
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 

}

//if their are errors display them
if(isset($error)){
    foreach($error as $error){
        echo "<p style='color:#ff0000'>$error</p>";
    }
}
?>

<form action='' method='post'>
<p><label>Name</label><br><input type='text' name='name' value=''></p>
<p><label>Email</label><br><input type='text' name='email' value=''></p>
<p><label>Content</label><br><textarea rows="4" cols="50" name="content" value=""></textarea></p>
<p><input type='submit' name='submit' value='Submit'></p>
</form>
