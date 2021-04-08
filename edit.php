<?php 
    session_start();
    $key = $_POST['edit-id'];

    $isbn = $key;
    $data[1] = $_POST['txtnamebook'];
    $data[2] = $_FILES['image']['name'];
    $data[3] = $_POST['txtatname'];
    $data[4] = $_POST['txtnis'];
    $data[5] = $_POST['txtprice'];

    // var_dump ( $isbn);
    // var_dump ( $name);
    
    var_dump ($key);
    
    $acc_file = "books.txt";
    
    if(isset($_POST['txtnamebook'])) {
       
       
        $myread = fopen($acc_file, "r+") or die ("Unable to open file");
        
        while(!feof($myread)) {
            $str = trim(fgets($myread));
            if($str != "") {
                $arr = explode (",", $str);

                if($arr[0] == $key) {

                    

                    $content = file_get_contents("$acc_file");
                    var_dump ($content);

                    $contents[1] = str_replace($arr[1],$data[1],$content);
                    $contents[2] = str_replace($arr[2],$data[2],$content);
                    $contents[3] = str_replace($arr[3],$data[3],$content);
                    $contents[4] = str_replace($arr[4],$data[4],$content);
                    $contents[5] = str_replace($arr[5],$data[5],$content);

                    for($i=1;$i<=5;$i++){
                        
                        $content = file_get_contents("$acc_file");
                        $contents[$i] = str_replace($arr[$i],$data[$i],$content);
                        file_put_contents($acc_file,$contents[$i]);
                        var_dump($data[$i]);
                        
                    }
                }
            }
        }
    }
    fclose($myread);


?>