<?php 
    include("../config.php");

    $id = $_GET['id'];

    $sql = "DELETE FROM admins WHERE id = $id";

    $res = mysqli_query($conn,$sql);

    if($res){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Admin Deleted Successfully
                                </div>';
            header('location:'.SITEURL.'admin/manage-admin.php');
    }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed To Delete Admin
                                </div>';
            header('location:'.SITEURL.'admin/manage-admin.php');
    }


?>