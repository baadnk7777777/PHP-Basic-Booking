<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php 
if(isset($_POST['sub'])){
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

    <?php 
   $myimg = fopen("img.txt", "r") or die ("Unable to open file.");
   while(!feof($myimg)) {
    $str = fgets($myimg);
    // $num_row++;
    $arr="";
    if($str != "") {
        $arr = explode(',', $str);
        ?>
        <img src="uploads/<?php  echo $arr[0] ?>" alt="" width="20%">
        <?php
    }
}
fclose($myimg);
    ?>

    <form method='post' action='' enctype='multipart/form-data'>
        <input type="file" name="file[]" id="file" multiple>

        <input type='submit' name='sub' value='Upload'>
    </form>
    <img src="uploads/<?php $filename ?> " alt="">


    <form method='post' enctype='multipart/form-data' action="" id="frmupload">
        <input type="file" class="custom-file-input" id="file" name="file[]" multiple>
        <input type='submit' name='btnsub' value='Upload'>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
</body>


</html>