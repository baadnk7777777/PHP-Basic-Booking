<?php 
                            $myfile = fopen("books.txt", "r") or die ("Unable to open file.");
                            $num_row =0;
                            while(!feof($myfile)) {
                                $str = fgets($myfile);
                                $num_row++;
                                $arr="";
                               
                                if($str != "") {
                                    $arr = explode(',', $str);
                                    $key = $_POST['btn'];
                                    echo $key;
                                //     if($key == $arr[6]) {
                                //         echo $key;
                                //     }
                                 }
                            }
                            fclose($myfile);
                        ?>