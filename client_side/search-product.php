<?php include("widget/header.php"); ?>
<?php 
    $query = htmlspecialchars($_GET['query']);
?>

    <!-- Product Section -->
    <div class="container p-3">
        <br>
        <h2 class="text-center text-white d-none d-lg-block">Products Like "<?= $query ?>"</h2>
        <br>

        <div class="row">
            <!-- Get product related with search query -->
            <?php 
            
                $sql = "SELECT * FROM  products WHERE  active='Yes' AND (title LIKE '%$query%' OR description LIKE '%$query%' OR price LIKE '%$query%')";
                $res = mysqli_query($conn,$sql);

                if($res){

                    $count = mysqli_num_rows($res);

                    if($count == 0){
                        echo '<div class="alert alert-danger" role="alert">
                                    No Product Found!
                                </div>';
                    }else{
                        while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name']; 

                        ?>
                                <div class="col-md-6 p-2">
                                    <div class="p-3 border-0 rounded-4 bg-body shadow w-100">
                                        <div class="d-flex">
                                            <img src="images/products/<?= $image_name ?>" class="rounded-4 mt-3" width="20%" height="50%">
                                            <div class="p-3">
                                                <h4><?= $title ?></h4>
                                                <p> $ <?= $price ?> </p>
                                                <p class="text-muted">
                                                    <?= $description ?>
                                                </p>
                                                <a href="order.php?id=<?= $id ?>" class="btn btn-primary w-40 text-decoration-none">Order Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                        <?php
                        }
                    }
                    
                }
            
            ?>
        </div>
    </div>
    <!-- Product Section -->

 <?php include("widget/footer.php"); ?>