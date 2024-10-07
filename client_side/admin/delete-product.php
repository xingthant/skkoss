<?php 
    include("../config.php");

    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != null){
            $path = "../images/products/".$image_name;

            $remove = unlink($path); // remove the image

            if(!$remove){
                $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed To Delete Product
                                    </div>';
                header('location:'.SITEURL.'admin/manage-product.php');
                die();
            }

        }

        $sql = "DELETE FROM products WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                        Product Deleted Successfully
                                    </div>';
            header('location:'.SITEURL.'admin/manage-product.php');
        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed To Delete Product
                                    </div>';
            header('location:'.SITEURL.'admin/manage-product.php');
        }
    }else{
        $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed To Delete Product
                                    </div>';
        header('location:'.SITEURL.'admin/manage-product.php');
    }

?>