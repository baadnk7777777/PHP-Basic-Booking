<?php 
    session_start();
    $acc_file = "books.txt";
    $output ="";
    if(isset($_POST["txtisbn"])){
        $myfile  = fopen($acc_file, "a+") or die ("Unable to open file.");

        // var_dump ($filename);
        $txt = $_POST["txtisbn"].",".$_POST["txtnamebook"].",".$_FILES['file']['name'][0].",".$_POST["txtatname"].",".$_POST["txtnis"].",".$_POST["txtprice"]."\n";
        $result = fwrite($myfile, $txt);
        fclose($myfile);

        $countfiles = count($_FILES['file']['name']);

        for($i=0;$i<$countfiles;$i++){
            $filename = $_FILES['file']['name'][$i];

            move_uploaded_file($_FILES['file']['temp_name'][$i],'uploads/'.$filename);
        }

        if($result == false){
            $output.="Cannot write to file userList.txt";
        }
        else{
            // $_SESSION["name"] = $_POST["txtisbn"];
            $output.= $_POST["txtisbn"]." Have been recorded.";
        }
    }
    else $output.="Error: Not Found.";
    echo $output;
?>