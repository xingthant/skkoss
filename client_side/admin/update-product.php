<?php include("widget/header.php"); ?>

<?php 
    $id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id=$id";

    $res = mysqli_query($conn,$sql);

    if($res){
        $count = mysqli_num_rows($res);

        if($count == 1){
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $featured = $row['featured'];
            $active = $row['active'];
            $current_image = $row['image_name'];
            $category_id = $row['category_id'];

        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed To Update Product ! Product Not Found!
                                    </div>';
            header('location:'.SITEURL.'admin/manage-product.php');
        }

    }
?>
    <div class="container">
        <div class="row pt-4 pb-4 text-color">
            <?php 
                if(isset($_SESSION['noti'])){
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }
            
            ?>
            <h2 class="mt-4 mb-3">Update Product</h2>

            <div class="col-12">
                <div class="border p-3 rounded-3">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required value="<?= $title ?>">
                            </div>
                            <div class="col-2 mb-3">
                                <label for="price" class="form-label">Price $</label>
                                <input type="number" class="form-control" id="price" name="price" required value="<?= $price ?>">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="select-category" class="form-label">Category</label>
                                <select name="category" class="form-select" id="select-category">
                                    <!-- Get Category Data From Database -->
                                    <?php 
                                        $sql = "SELECT * FROM categories WHERE active='Yes'";
                                        $res = mysqli_query($conn,$sql);
                                        while($row = mysqli_fetch_assoc($res)){
                                                $cid = $row['id'];
                                                $title = $row['title'];

                                                ?>
                                                    <option value="<?= $cid ?>"  
                                                        <?php if($category_id == $cid) echo "selected"; ?>>
                                                        <?= $title ?>
                                                    </option>

                                                <?php
                                        }
                                    
                                    ?>
                                </select>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" rows="2" class="form-control">
                                    <?= $description ?>
                                </textarea>
                            </div>

                            <div class="col-2 mb-3">
                                <label for="current_image" class="form-label">Current Image</label><br>
                                <img src="../images/products/<?= $current_image ?>" class="rounded" width="80">
                            </div>

                            <div class="col-4 mb-3">
                                <label for="image" class="form-label">Choose New Image</label>
                                <input type="file" class="form-control" id="image" name="new_image">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Featured</label>
                                <div class="bg-body p-1 rounded ps-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="featured1" value="Yes" name="featured" <?php if($featured == 'Yes') echo "checked" ?>>
                                        <label class="form-check-label" for="featured1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="featured2" value="No" name="featured" <?php if($featured == 'No') echo "checked" ?> >
                                        <label class="form-check-label" for="featured2">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Active</label>
                                <div class="bg-body p-1 rounded ps-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="active1" value="Yes" name="active" <?php if($active == 'Yes') echo "checked" ?>>
                                        <label class="form-check-label" for="active1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="active2" value="No" name="active" <?php if($active == 'No') echo "checked" ?>>
                                        <label class="form-check-label" for="active2">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <input type="hidden" name="current_image" value="<?= $current_image?>">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
<?php include("widget/footer.php"); ?>

<?php 
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $id = $_POST['id'];
        $current_image = $_POST['current_image'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        $category_id = $_POST['category'];

        if($_FILES['new_image']['name'] != null){
            $image_name = $_FILES['new_image']['name'];

            $ext = end(explode('.',$image_name));

            $image_name = "product_".rand(000,999).'.'.$ext;

            //product_123.jpg

            $source_path = $_FILES['new_image']['tmp_name'];

            $destination_path = "../images/products/".$image_name;

            $upload = move_uploaded_file($source_path,$destination_path);

            if(!$upload){
                $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed To Upload New Image
                                </div>';
                header('location:'.SITEURL.'admin/update-product.php');
                die();
            }else{
                if($current_image != null){
                    $path = "../images/products/".$current_image;
                    $remove = unlink($path);
                    if(!$remove){
                        $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed To Remove Current Image
                                </div>';
                        header('location:'.SITEURL.'admin/manage-product.php');
                        die();
                    }
                }
            }
        }else{
            $image_name = $current_image;
        }

        $sql = "UPDATE products SET
            title = '$title',
            description = '$description',
            price = $price,
            category_id = $category_id,
            featured = '$featured',
            active = '$active',
            image_name = '$image_name'

            WHERE id = $id
        ";

        $res = mysqli_query($conn,$sql);

        if($res){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                        Product Updated Successfully
                                    </div>';
            header('location:'.SITEURL.'admin/manage-product.php');
        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed To Update Product
                                    </div>';
            header('location:'.SITEURL.'admin/manage-product.php');
        }
    }


?>