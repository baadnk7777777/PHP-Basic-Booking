   <?php 
   if(isset($_POST['txtisbn'])){
       $acc_file = "img.txt";
       $myfile  = fopen($acc_file, "a+") or die ("Unable to open file.");
       $txt = $_FILES['file']['name'][0]."\n";
       $result = fwrite($myfile, $txt);
           fclose($myfile);
   
    // Count total files
    $countfiles = count($_FILES['file']['name']);
   
    // Looping all files
    for($i=0;$i<$countfiles;$i++){
     $filename = $_FILES['file']['name'][$i];
    
     // Upload file
     move_uploaded_file($_FILES['file']['tmp_name'][$i],'uploads/'.$filename);
    
    }
    for($i=0;$i<$countfiles;$i++){
       $filename = $_FILES['file']['name'][$i];
       echo $_FILES['file']['name'][$i];
       ?>
<?php echo "<br> <br>" ?>
<!-- <img src="uploads/<?php echo $_FILES['file']['name'][$i]; ?>" width="10%"> -->
<?php echo "<br> <br>" ?>
<?php
    }
   } 
   ?>