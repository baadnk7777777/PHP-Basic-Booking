<?php 
    session_start();
    $acc_file = "books.txt";
    $output =""; 
    if (isset($_POST["txtnamebook"]) ) {
        $myfile  = fopen($acc_file, "a+") or die ("Unable to open file.");
        $readfile = fopen($acc_file, "r") or die ("Unable to open file");
        // var_dump ($filename);

        while (!feof($readfile)) {
            $str = fgets($readfile);
            $arr = "";

            if($str != "" ) {
                $arr = explode (",", $str);
                
                if($arr[0] == $_POST["ISBN"]){
                    $arr[1] = $_POST["txtnamebook"];
                    $txt = $arr[1] = $_POST["txtnamebook"];
                    $result = fwrite($myfile, $txt);
                    fclose($myfile);
                }
            }
        }

        // $txt = $_POST["txtisbn"].",".$_POST["txtnamebook"].",".$_FILES['file']['name'][0].",".$_POST["txtatname"].",".$_POST["txtnis"].",".$_POST["txtprice"].","."$key"."\n";
        // $result = fwrite($myfile, $txt);
        // fclose($myfile);

        // if($result == false){
        //     $output.="Cannot write to file userList.txt";
        // }
        // else{
        //     // $_SESSION["name"] = $_POST["txtisbn"];
        //     $output.= $_POST["txtisbn"]." Have been recorded.";
        // }
      fclose($readfile);
    }
    
    else $output.="Error: Not Found.";
    echo $output;
    
?>