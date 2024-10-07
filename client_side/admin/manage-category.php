<?php include("widget/header.php"); ?>
    <div class="container">
        <div class="row pt-4 pb-4 text-color">
            <?php 
                if(isset($_SESSION['noti'])){
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }
            
            ?>

            <h2 class="mt-4 mb-3">Manage Category</h2>

            <div class="col-12">
                <a href="add-category.php" class="btn btn-primary w-10 mb-3"> Add Category</a>

                <table class="table table-light table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Featured</th>
                            <th scope="col">Active</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        
                            $sql = "SELECT * FROM categories";
                            $res = mysqli_query($conn,$sql);

                            $count = mysqli_num_rows($res);

                            if($count == 0){
                                echo "No Data";
                            }else{
                                $sn = 1;
                                while($row = mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $featured = $row['featured'];
                                    $active = $row['active'];
                                    $image_name = $row['image_name'];
                                    ?>
                                    
                                         <tr>
                                            <th scope="row"><?= $sn ?></th>
                                            <td><?= $title ?></td>
                                            <td>
                                                <img src="../images/categories/<?= $image_name ?>" class="rounded" width="100">
                                            </td>
                                            <td><?= $featured ?></td>
                                            <td><?= $active ?></td>
                                            <td>
                                                <a href="<?= SITEURL ?>admin/update-category.php?id=<?= $id ?>" class="bg-white p-2 rounded mx-1" title="update category">
                                                    <img src = "../images/icons8-edit-64.png" width = "25px"/>
                                                </a>
                                                <a href="<?= SITEURL ?>admin/delete-category.php?id=<?= $id ?>&image_name=<?=$image_name?>" class="bg-white p-2 rounded mx-1" title="delete category">
                                                    <img src = "../images/icons8-delete-100.png" width = "25px"/>
                                                </a>
                                            </td>
                                        </tr>
                                    
                                    
                                    <?php


                                    $sn++;
                                }
                            }

                        ?>

                       

                    </tbody>

                </table>
            </div>
        </div>
    </div>
<?php include("widget/footer.php"); ?>