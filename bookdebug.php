<?php

session_start();

    $acc_file = "img.txt";
    $output ="";
    // $tmp_name = $_FILES["file"]["tmp_name"];
    if(isset($_POST["file[]"])){
        $countfiles = count($_FILES['file']['name']);
        for($i=0;$i<$countfiles;$i++){
            $filename = $_FILES['file']['name'][$i];
           
            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'][$i],'uploads/'.$filename);
           
           }
           
        $myfile  = fopen($acc_file, "a+") or die ("Unable to open file.");
        $txt = $_FILES['file']['name'][0]."\n";
        $result = fwrite($myfile, $txt);
        fclose($myfile);
        if($result == false){
            $output.="Cannot write to file userList.txt";
        }
        else{
            $_SESSION["name"] = $_POST["file[]"];
            $output.= $_POST["file[]"]." Have been recorded.";
        }
    }
    else $output.="Error: Not Found.";
    echo $output;
?>