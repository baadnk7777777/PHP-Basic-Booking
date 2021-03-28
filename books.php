<?php 
    session_start();
    $acc_file = "books.txt";
    $output ="";
    if(isset($_POST["txtisbn"])){
        $myfile  = fopen($acc_file, "a+") or die ("Unable to open file.");
        $txt = $_POST["txtisbn"].",".$_POST["txtnamebook"].",".$_POST["inputfile"].",".$_POST["txtatname"].",".$_POST["txtnis"].",".$_POST["txtprice"]."\n";
        $result = fwrite($myfile, $txt);
        fclose($myfile);
        if($result == false){
            $output.="Cannot write to file userList.txt";
        }
        else{
            $_SESSION["name"] = $_POST["txtisbn"];
            $output.= $_POST["txtisbn"]." Have been recorded.";
        }
    }
    else $output.="Error: Not Found.";
    echo $output;
?>