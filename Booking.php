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

    <div class="Booklist" id="booklist">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5>List of Books</h5>
                </div>
                <div class="col-sm-6 d-flex justify-content-end ">
                    <button class="btn btn-success" data-toggle="modal" data-target="#modalbook">Add New Books</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ISBN</th>
                                <th scope="col">Name</th>
                                <th scope="col">Author</th>
                                <th scope="col">In Stock</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                                
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
                                // $btneye ='<i class="fa fa-eye nav-link " data-toggle="modal" data-target="#modalLogin" aria-hidden="true"></i>';
                                // $btnpen ='<i class="fa fa-pencil nav-link " data-toggle="modal" data-target="#modalLogin" aria-hidden="true"></i>';
                                // $btnbin ='<i class="fa fa-trash nav-link " data-toggle="modal" data-target="#modalLogin" aria-hidden="true"></i>';
                                $test = '<div class="row"><i class="fa fa-eye nav-link col-1 " data-toggle="modal" data-target="#modalbooklook" aria-hidden="true"></i> <i class="fa fa-pencil nav-link col-1 " data-toggle="modal" data-target="#modalbookedit"  aria-hidden="true"></i><i class="fa fa-trash nav-link col-1 " data-toggle="modal" data-target="#modalLogin"></div>';
                                if($str != "") {
                                    $arr = explode(',', $str);
                                    echo "<tr><th scope = 'row'>  $arr[0]</th> <td> $arr[1] </td><td>$arr[3]</td> <td> $arr[4] </td><td> $arr[5] </td><td> $test</td></tr>";
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

    <!-- Modal Books  Look-->
    <div class="modal fade" id="modalbooklook" tabindex="-1" role="dialog" aria-labelledby="modalLogin" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="frmbooklook">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Book Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="booklookmodalbody">
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
                                <input type="file" class="custom-file-input" id="inputfile">
                                <label class="custom-file-label" for="inputfile">Choose file </label>
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
                    <div class="modal-footer" id="booklookmodalfooter">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="Submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Books -->
    <div class="modal fade" id="modalbook" tabindex="-1" role="dialog" aria-labelledby="modalLogin" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="frmbook">
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
                                <input type="file" class="custom-file-input" id="inputfile">
                                <label class="custom-file-label" for="inputfile">Choose file </label>
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
                        <button type="Submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!-- Modal Books Edit -->
     <div class="modal fade" id="modalbookedit" tabindex="-1" role="dialog" aria-labelledby="modalLogin" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="frmbookedit">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Book ISBN: </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="bookeditmodalbody">
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
                                <input type="file" class="custom-file-input" id="inputfile">
                                <label class="custom-file-label" for="inputfile">Choose file </label>
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
                    <div class="modal-footer" id="bookeditmodalfooter">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="Submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script>
    $(document).ready(function() {
        console.log("ready!");
        $('#booklist').hide();
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
                    $("#signmodalFooter").html(btnClose);
                },
                error: function(data) {
                    console.log('An error occurred.');
                    console.log(data);
                }
            });
        });
    });

    $(function() {
        $("#frmbook").submit(function() {
            console.log("Book");
            event.preventDefault();
            $.ajax({
                url: "books.php",
                type: "POST",
                data: $('form#frmbook').serialize(),
                success: function(data) {
                    console.log("data:" + data);
                    $("#signupmodalbody").html(data);
                    var btnClose =
                        ' <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>'
                    $("#bookmodalfooter").html(btnClose);
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
        $("#modalLogin, #modalSignup,").on("hidden.bs.modal", function() {
            location.reload();
        });
    })

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