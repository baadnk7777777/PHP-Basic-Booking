<?php 
    session_start();
    $key = $_POST['edit-id'];
    
    
    $acc_file = "books.txt";
    
    if(isset($_POST['txtnamebook'])) {
       
       
        $myread = fopen($acc_file, "r+") or die ("Unable to open file");
        
        while(!feof($myread)) {
            $str = trim(fgets($myread));
            $i = 0;
            if($str != "") {
                $arr = explode (",", $str);

                if($arr[0] == $key) {

                    
                    
                    
                }
            }
        }
    }


?>