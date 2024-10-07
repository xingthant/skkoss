<?php include("widget/header.php"); ?>
<?php 
    $id = $_GET['id'];

    $sql = "SELECT * FROM admins WHERE id=$id";

    $res = mysqli_query($conn,$sql);

    if($res){
        $count = mysqli_num_rows($res);

        if($count == 1){
            $row = mysqli_fetch_assoc($res);

            $retrieved_password = $row['password'];

        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed To Update Password
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
            <h2 class="mt-4 mb-3">Update Password</h2>

            <!-- Add Admin Form -->
            <div class="col-md-6">
                <div class="border p-3 rounded-3">
                    <form action="" method = "POST">
                        <div class="mb-3">
                            <label for="current-password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current-password" name="current-password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new-password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new-password" name="new-password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                        </div>

                        <input type="hidden" value="<?= $retrieved_password ?>"
                         name="retrieved-password" >
                        <input type="hidden" value="<?= $id ?>" name="id">

                        <input type="submit" class="btn btn-primary" value="Update Password">

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include("widget/footer.php"); ?>
<?php 

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $retrieved_password = $_POST['retrieved-password'];
        $current_password = md5($_POST['current-password']);
        $new_password = md5($_POST['new-password']);
        $confirm_password = md5($_POST['confirm-password']);

        if($retrieved_password != $current_password){
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Current Password Incorrect!
                                </div>';
            header('location:'.SITEURL.'admin/update-password.php?id='.$id);
        }else if($new_password != $confirm_password){
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    New Password & Confirm Password Not Match!
                                </div>';
            header('location:'.SITEURL.'admin/update-password.php?id='.$id);
        }else{
            $sql = "UPDATE admins SET
                password = '$new_password'
                WHERE id='$id'
                ";
            $res = mysqli_query($conn,$sql);

            if($res){
                $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                        Password Updated Successfully
                                    </div>';
                header('location:'.SITEURL.'admin/manage-admin.php');
            }else{
                $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed To Update Password
                                    </div>';
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            
        }
    }
?>

