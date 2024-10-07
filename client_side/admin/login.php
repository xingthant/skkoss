<?php include("../config.php"); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LLP - Online Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
  </head>
  <body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 pt-3 pb-3 mx-auto">
                <div class="h-25">
                    <?php 
                        if(isset($_SESSION['noti'])){
                            echo $_SESSION['noti'];
                            unset($_SESSION['noti']);
                        }
                    ?>
                </div>
                <br><br>
                <div class="border p-3 rounded-3">
                    <img src="../images/logo.png" width="30%" class="mx-auto d-block mb-3">
                    
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">User Name</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>

<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $username = htmlspecialchars($_POST['username']);
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM  admins WHERE username='$username' AND password = '$password'";

        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);

        if($count == 1){
            $_SESSION['user'] = $username;
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Login Successfully
                                </div>';
            header('location:'.SITEURL.'admin/index.php');
        }else{

            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Invalid Username or Password
                                </div>';
            header('location:'.SITEURL.'admin/login.php');

        }

    }
?>