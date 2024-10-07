<?php include("widget/header.php"); ?>
    <div class="container">
        <div class="row pt-4 pb-4 text-color">
            <?php 
                if(isset($_SESSION['noti'])){
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }
            
            ?>
            <h2 class="mt-4 mb-3">Add New Product</h2>

            <div class="col-12">
                <div class="border p-3 rounded-3">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="col-2 mb-3">
                                <label for="price" class="form-label">Price $</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="select-category" class="form-label">Category</label>
                                <select name="category" class="form-select" id="select-category">
                                    <!-- Get Category Data From Database -->
                                    <?php 
                                        $sql = "SELECT * FROM categories WHERE active='Yes'";
                                        $res = mysqli_query($conn,$sql);
                                        $count = mysqli_num_rows($res);

                                        if($count > 0){
                                            while($row = mysqli_fetch_assoc($res)){
                                                $id = $row['id'];
                                                $title = $row['title'];

                                                ?>
                                                    <option value="<?= $id ?>"><?= $title ?></option>

                                                <?php
                                            }
                                        }else{
                                            echo '<option value="0">No Category</option>';
                                        }
                                    
                                    ?>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" rows="2" class="form-control"></textarea>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="image" class="form-label">Choose Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <div class="col-3 mb-3">
                                <label class="form-label">Featured</label>
                                <div class="bg-body p-1 rounded ps-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="featured1" value="Yes" name="featured">
                                        <label class="form-check-label" for="featured1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="featured2" value="No" name="featured">
                                        <label class="form-check-label" for="featured2">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mb-3">
                                <label class="form-label">Active</label>
                                <div class="bg-body p-1 rounded ps-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="active1" value="Yes" name="active">
                                        <label class="form-check-label" for="active1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="active2" value="No" name="active">
                                        <label class="form-check-label" for="active2">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
<?php include("widget/footer.php"); ?>

<?php 

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $title = $_POST['title'];
        $price = $_POST['price'];
        $category_id = $_POST['category'];
        $description = $_POST['description'];

        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }else{
            $featured = 'No';
        }

        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }else{
            $active = 'No';
        }

        if(isset($_FILES['image']['name'])){
            $image_name = $_FILES['image']['name'];

            //renaming the image

            $ext = end(explode('.',$image_name));
            //example.jpg / png

            $image_name = "product_".rand(000,999).'.'.$ext;

            //category_123.jpg

            $source_path = $_FILES['image']['tmp_name'];

            
            
            $destination_path = "../images/products/".$image_name;
            $upload = move_uploaded_file($source_path,$destination_path);

            if(!$upload){
                $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed To Upload Image
                                </div>';
                header('location:'.SITEURL.'admin/add-product.php');
                die();
            }
        }

        $sql = "INSERT INTO products SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category_id,
            featured = '$featured',
            active = '$active'
        ";

        $res = mysqli_query($conn,$sql);
        if($res){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Product Added Successfully
                                </div>';
            header('location:'.SITEURL.'admin/manage-product.php');
        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed To Add Product
                                </div>';
            header('location:'.SITEURL.'admin/add-product.php');
        }
    }
?>

