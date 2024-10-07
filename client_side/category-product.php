    <?php include("widget/header.php") ?>

    <?php
        $cid = $_GET['id'];
        $title = $_GET['title'];
    ?>

    <!-- Product Section -->
    <div class="container p-3">
        <br>
        <h2 class="text-center text-white d-none d-lg-block">Products on "<?= $title ?>"</h2>
        <br>

        <div class="row">
            <!-- get product data from database where it matches the cid -->

            <?php
                
                $sql = "SELECT * FROM products WHERE active='Yes' AND category_id=$cid;";
                $res = mysqli_query($conn,$sql);

                if($res){
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
                        <img src="images/products/<?= $image_name?>" class="rounded-4 mt-3" width="20%" height="50%">
                        <div class="p-3">
                            <h4><?= $title ?></h4>
                            <p> $<?= $price ?> </p>
                            <p class="text-muted">
                                <?= $description ?>
                            </p>
                            <a href="order.php?id=<?= $id ?>" class="btn btn-primary w-40 text-decoration-none">Order
                                Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                }
            
             ?>
        </div>
    </div>
    <!-- Product Section -->

    <?php include("widget/footer.php") ?>