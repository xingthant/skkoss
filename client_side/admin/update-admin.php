
<?php include("widget/header.php"); ?>
<?php 
    $id = $_GET['id'];

    $sql = "SELECT * FROM admins WHERE id=$id";

    $res = mysqli_query($conn,$sql);

    if($res){
        $count = mysqli_num_rows($res);

        if($count == 1){
            $row = mysqli_fetch_assoc($res);

            $fullname = $row['fullname'];
            $username = $row['username'];

        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed To Update Admin
                                </div>';
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>

    <div class="container">
        <div class="row pt-4 pb-4 text-color gt-3">

            <?php
                if(isset($_SESSION['noti'])){
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }
            
            ?>
            <h2 class="mt-4 mb-3">Update Admin</h2>

            <!-- Add Admin Form -->
            <div class="col-md-6">
                <div class="border p-3 rounded-3">
                    <form action="" method = "POST">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $fullname ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $username ?>" required>
                        </div>
                        
                        <input type="hidden" value="<?= $id ?>" name="id">
                        <input type="submit" class="btn btn-primary" value="Update">

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include("widget/footer.php"); ?>


<?php 

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];

        $sql = "UPDATE admins SET
            fullname = '$fullname',
            username = '$username'

            WHERE id = '$id'

            ";
        $res = mysqli_query($conn,$sql);

        if($res){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Admin Updated Successfully
                                </div>';
            header('location:'.SITEURL.'admin/manage-admin.php');
        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed To Update Admin
                                </div>';
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>