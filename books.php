<?php 
    session_start();
    $acc_file = "books.txt";
    $output ="";
    $path = 'uploads/';



    if(isset($_POST['txtisbn'])){

        $img = $_FILES['image']['name'];
        
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "$path/$img");

        // ******************************************************
        $myfile  = fopen($acc_file, "a+") or die ("Unable to open file.");

        // var_dump ($filename);
        $key = $_POST["txtisbn"];  
        $txt = $_POST["txtisbn"].",".$_POST["txtnamebook"].",".$img.",".$_POST["txtatname"].",".$_POST["txtnis"].",".$_POST["txtprice"].","."$key"."\n";
        $result = fwrite($myfile, $txt);
        fclose($myfile);

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