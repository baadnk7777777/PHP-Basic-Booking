<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <title>Booking</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="title-background">
        <div class="container-fluid">
            <!-- nav-bar -->
            <nav class="nav navbar-expand-lg navbar-light">
                <a href="" class="navbar-brand">
                    <img src="images/PSU_CoC.png" alt="Logo">
                </a>
                <span class="navbar-text">
                    <h3 class="titleheading">Employee </h3>
                </span>
                <?php 
                    if(!isset($_SESSION["name"])) {

                ?>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="" class="nav-link" data-toggle="modal" data-target="#modalLogin">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link" data-toggle="modal" data-target="#modalSignup">SignUp</a>
                    </li>
                </ul>

                <?php 
                    }else{

                ?>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" id="book">Book </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"><?php echo  $_SESSION["name"] ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Logout</a>
                    </li>
                </ul>
                <?php 
                    }
                ?>
            </nav>
        </div>
    </div>

    <div class="userlist" id="userlist">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12"></div>
                <?php 
                    if(isset($_SESSION["name"])) {
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fullname</th>
                            <th scope="col">Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $myfile = fopen("account.txt", "r") or die ("Unable to open file.");
                            $num_row =0;
                            while(!feof($myfile)) {
                                $str = fgets($myfile);
                                $num_row++;
                                $arr="";
                                if($str != "") {
                                    $arr = explode(',', $str);
                                    echo "<tr><th scope = 'row'> $num_row </th> <td> $arr[0] </td><td>$arr[1]</td></tr>";
                                }
                            }
                            fclose($myfile);
                        ?>
                    </tbody>
                </table>
                <?php 
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- Book list -->
    <div class="Booklist" id="booklist">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 mt-2 d-flex align-items-center ">
                    <h5>List of Books</h5>
                </div>
                <div class="col-sm-6 d-flex justify-content-end d-flex align-items-center ">
                    <button class="btn btn-success mt-5 d-flex align-items-center" data-toggle="modal"
                        data-target="#modalbook">Add New Books</button>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-12">


                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ISBN</th>
                                <th scope="col">Name</th>
                                <th scope="col">Author</th>
                                <th scope="col">In Stock</th>
                                <th scope="col">Price</th>
                                <th scope="col" colspan="3">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- <div class="row"><div class="col-1" data-toggle="modal" data-target="#modalLogin" ><i class="fa fa-eye nav-link " aria-hidden="true"></i> </div><div class="col-1"><i class="fa fa-pencil nav-link "  aria-hidden="true"></i> </div><div class="col-1"><i class="fa fa-trash nav-link " data-toggle="modal" data-target="#modalLogin" aria-hidden="true"></i> </div> </div> -->
                            <?php 
                            $myfile = fopen("books.txt", "r") or die ("Unable to open file.");
                            $num_row =0;
                            while(!feof($myfile)) {
                                $str = fgets($myfile);
                                $num_row++;
                                $arr="";
                                if($str != "") {
                                    $arr = explode(',', $str);
                                    echo "<tr><td scope = 'row' class='isbn' >  $arr[0]</td> <td class='name'> $arr[1] </td> <td class='image' style='display:none'> $arr[2] </td> <td class='author'>$arr[3]</td> <td class='stock'> $arr[4] </td><td class='price'> $arr[5] </td><td> <button class='btn btn-info detail'  value='$arr[6]' name='$arr[6]'  data-toggle='modal' data-target='#modalbookdetail'> Detail </button></td> <td> <button class='btn btn-info edit'  value='$arr[6]' name='$arr[6]' id='$arr[6]' data-toggle='modal' data-target='#modalbookedit'> EDIT </button></td> <td> <button class='btn btn-info delete'  value='$arr[6]' name='$arr[6]'  data-toggle='modal' data-target='#'> DL </button></td> </tr>";
                                }
                            }
                            fclose($myfile);
                        ?>
                        </tbody>
                    </table>
                    <?php 
                    
                ?>
                </div>
            </div>
        </div>
    </div>



    <!-- modal SignUp -->

    <div class="modal fade" id="modalSignup">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="frmSignup">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="signupmodalbody">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="txtname" placeholder="Fullname" require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="txtus" placeholder="Username" require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="password" class="form-control" name="txtps" placeholder="Password" require>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="signmodalFooter">
                        <button type="submit" class="btn btn-success" value="Submit">Submit</button>
                        <button type="reset" class="btn btn-primary" value="Reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal Login -->

    <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLogin" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="frmLogin">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="loginmodalBody">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="txtus" placeholder="Username" require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="password" class="form-control" name="txtps" placeholder="Password" require>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="loginmodalFooter">
                        <button type="submit" class="btn btn-success">Login</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Books -->
    <div class="modal fade" id="modalbook" tabindex="-1" role="dialog" aria-labelledby="modalLogin" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="post" id="frmbook"  enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Books</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="bookmodalbody">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="txtisbn" placeholder="ISBN" require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="txtnamebook" placeholder="Book Name"
                                    require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="file" id="uploadimage" name="image">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="txtatname" placeholder="Author Name"
                                    require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="txtnis" placeholder="Number in Stock"
                                    require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="txtprice" placeholder="Price" require>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="bookmodalfooter">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" value="Upload">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Books Detail -->
    <div class="modal fade" id="modalbookdetail" tabindex="-1" role="dialog" aria-labelledby="modalLogin"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Book Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="bookdetailmodalbody">

                    <div class="container">
                        <div class="row">
                            <table class="table table-bordered col">
                                <tbody>
                                    <tr>
                                        <th scope="col-4">
                                            <p class="font-weight-normal">ISBN</p>
                                        </th>
                                        <th scope="col-4">
                                            <p class="font-weight-normal isbn-id"> </p>
                                            </h6>
                                        </th>
                                        <th scope="col" rowspan="5" >
                                            <p class="font-weight-normal  d-flex justify-content-center " id="img">  </p>  
                                            </h6>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col">
                                            <p class="font-weight-normal">NAME</p>
                                        </th>
                                        <th scope="col">
                                            <p class="font-weight-normal name-id"> </p>
                                            </h6>
                                        </th>

                                    </tr>
                                    <tr>
                                        <th scope="col">
                                            <p class="font-weight-normal">Author</p>
                                        </th>
                                        <th scope="col">
                                            <p class="font-weight-normal author-id"> </p>
                                            </h6>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col">
                                            <p class="font-weight-normal">In Stock</p>
                                        </th>
                                        <th scope="col">
                                            <p class="font-weight-normal stock-id"> </p>
                                            </h6>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col">
                                            <p class="font-weight-normal">Price</p>
                                        </th>
                                        <th scope="col">
                                            <p class="font-weight-normal price-id"> </p>
                                            </h6>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="modal-footer" id="bookdetailfooter">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    
     <!-- Modal edit -->
     <div class="modal fade" id="modalbookedit" tabindex="-1" role="dialog" aria-labelledby="modalLogin" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="frmbookedit" action='' enctype='multipart/form-data'>
                    <div class="modal-header">
                        <h5 class="modal-title edittext" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="bookeditmodalbody">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control " id="ISBN" name="ISBN" readonly require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control name-id" id="NAME" name="txtnamebook"
                                    value="" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <input type="file" id="uploadimage" name="image" value="pic">
                            <p class="font-weight-normal  d-flex justify-content-center " id="imge">  </p>  
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control " id="author-id" name="txtatname" 
                                    require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control " id="stock-id"name="txtnis"
                                    require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control "id="price-id" name="txtprice" require>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="bookeditmodalfooter">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="Submit" class="btn btn-success" value="submit" name="submit">Edit</button>
                        <input type="hidden" name="edit-id" id="edit-id" value="">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script>
    $(document).ready(function() {
        $('.detail').click(function(e) {
            e.preventDefault();
            console.log("tes");

            $ISBN = $(this).closest("tr").find('.isbn').text();
            $NAME = $(this).closest("tr").find('.name').text();
            $IMG = $(this).closest("tr").find('.image').text();
            $AUTHOR = $(this).closest("tr").find('.author').text();
            $IN_STOCK = $(this).closest("tr").find('.stock').text();
            $PRICE = $(this).closest("tr").find('.price').text();

              console.log($ISBN);
            console.log($NAME);
            console.log($IMG);
            console.log($AUTHOR);
            console.log($IN_STOCK);
            console.log($PRICE);

            $('.isbn-id').text($ISBN);
            $('.name-id').text($NAME);
            $('.img-id').text($IMG);
            $('.author-id').text($AUTHOR);
            $('.stock-id').text($IN_STOCK);
            $('.price-id').text($PRICE);

            var number = $IMG;
            var $imgpush =  "<img id ='img' src='uploads/' + width='50%'>  "  
            // $("#img").html("<img id ='img' src='uploads/" +$IMG"'  width='50%'>  );
            $("#img").html("<img class='img' src='uploads/"+$.trim(number)+"' width=50%' </img>");
            // $('.html').html("<div class='new' id='" + id + "'>jitender</div>");
        });
    });

    $(document).ready(function() {
        console.log("ready!");
        $('#booklist').hide();
    });

    $(document).ready(function() {

        //  $(this).closest('tr').remove();
        $('.delete').click(function(e){
            e.preventDefault();
            console.log("delete");

        });

        $('.edit').click(function(e) {
            e.preventDefault();
            console.log("edit");
            
            $ISBN = $(this).closest("tr").find('.isbn').text();
            $NAME = $(this).closest("tr").find('.name').text();
            $IMG = $(this).closest("tr").find('.image').text();
            $AUTHOR = $(this).closest("tr").find('.author').text();
            $IN_STOCK = $(this).closest("tr").find('.stock').text();
            $PRICE = $(this).closest("tr").find('.price').text();

            // $('.isbn-id').text($ISBN);
            $('.name-id').text($NAME);
            $('.img-id').text($IMG);
            $('.author-id').text($AUTHOR);
            $('.stock-id').text($IN_STOCK);
            $('.price-id').text($PRICE);

            $key = $(this).attr('id');
            console.log($key);
            $('#edit-id').val($key);
            $('#ISBN').val($ISBN);
            $('#NAME').val($NAME);
            $('#NAME').val($NAME);
            $('#author-id').val($AUTHOR);
            $('#stock-id').val($IN_STOCK);
            $('#price-id').val($PRICE);

            var number = $IMG;
            var $imgpush =  "<img id ='img' src='uploads/' + width='50%'>  "  
            $("#imge").html("<img class='img' src='uploads/"+$.trim(number)+"' width=30%' </img>");
            $(".edittext").html("<h5 modal-title edittext > Edit Book: " + $ISBN +" </h5>");

        });
        $('#frmbookedit').on('submit',function(e) {
            console.log("onClick");
            e.preventDefault();
            $.ajax({
                url: "edit.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                   console.log(data);
                   $("#bookeditmodalbody").html(data);
                   var btnClose =
                   ' <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>'
                   $("#bookeditmodalfooter").html(btnClose);
                },
                error: function(e) {
                    console.log(error);
                }
            });
        });


        
    });



    $(function() {
        $("#frmSignup").submit(function() {
            console.log("Submit Pass")
            event.preventDefault();
            $.ajax({
                url: "signup.php",
                type: "POST",
                data: $('form#frmSignup').serialize(),
                success: function(data) {
                    console.log("data:" + data);
                    $("#bookmodalbody").html(data);
                    var btnClose =
                        ' <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>'
                    $("#bookeditmodalfooter").html(btnClose);
                },
                error: function(data) {
                    console.log('An error occurred.');
                    console.log(data);
                }
            });
        });
    });

    $(document).ready(function(e) {
        $('#frmbook').on('submit',function(e) {
            console.log("onClick");
            e.preventDefault();
            $.ajax({
                url: "books.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                   console.log(data);
                   $("#bookmodalbody").html(data);
                   var btnClose =
                   ' <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>'
                   $("#bookmodalfooter").html(btnClose);
                },
                error: function(e) {
                    console.log(error);
                }
            });
        });
    });


    $(function() {
        $("#modalbookdetail").submit(function() {
            console.log("Book");
            event.preventDefault();
            $.ajax({
                url: "books.php",
                type: "POST",
                data: $('form#modalbookdetail').serialize(),
                success: function(data) {
                    console.log("data:" + data);
                    $("#bookdetailmodalbody").html(data);
                    var btnClose =
                        ' <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>'
                    $("#bookdetailfooter").html(btnClose);
                },
                error: function(data) {
                    console.log('An error occurred.');
                    console.log(data);
                }
            });
        });
    });


    $(function() {
        $("#frmLogin").submit(function() {
            console.log("Submit Pass")
            event.preventDefault();
            $.ajax({
                url: "login.php",
                type: "POST",
                data: $('form#frmLogin').serialize(),
                success: function(data) {
                    console.log("data:" + data);
                    $("#loginmodalBody").html(data);
                    var btnClose =
                        ' <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>'
                    $("#loginmodalFooter").html(btnClose);
                },
                error: function(data) {
                    console.log('An error occurred.');
                    console.log(data);
                }
            });
        });
    });



    $(function() {
        $("#modalLogin, #modalSignup, #modalbook").on("hidden.bs.modal", function() {
            location.reload();
        });
    });

    $(function() {
        $('#book').click(function() {
            console.log("book");
            $('#userlist').toggle();
            $('#booklist').toggle();
        });
    });
    </script>
</body>

</html>