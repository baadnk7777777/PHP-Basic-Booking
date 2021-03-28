<?php 
    session_start();
    $acc_file = "account.txt";
    $output ="";
    if(isset($_POST["txtus"])){
        $myfile  = fopen($acc_file, "a+") or die ("Unable to open file.");
        $txt = $_POST["txtname"].",".$_POST["txtus"].",".$_POST["txtps"]."\n";
        $result = fwrite($myfile, $txt);
        fclose($myfile);
        if($result == false){
            $output.="Cannot write to file userList.txt";
        }
        else{
            $_SESSION["name"] = $_POST["txtname"];
            $output.= $_POST["txtname"]." Have been recorded.";
        }
    }
    else $output.="Error: Not Found.";
    echo $output;
?>