<?php include("widget/header.php"); ?>

    <div class="container">
        <div class="row pt-4 pb-4 text-color gt-3">

            <?php
                if(isset($_SESSION['noti'])){
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }
            
            ?>
            <h2 class="mt-4 mb-3">Add New Admin</h2>

            <!-- Add Admin Form -->
            <div class="col-md-6">
                <div class="border p-3 rounded-3">
                    <form action="" method = "POST">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Register">

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include("widget/footer.php"); ?>
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "INSERT INTO admins SET
            fullname = '$fullname',
            username = '$username',
            password = '$password'
            ";
        $res = mysqli_query($conn,$sql);

        if($res){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Admin Added Successfully
                                </div>';
            header('location:'.SITEURL.'admin/manage-admin.php');
        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed To Add Admin
                                </div>';
            header('location:'.SITEURL.'admin/add-admin.php');
        }
    }

?>

