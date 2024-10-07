<?php include("widget/header.php"); ?>

    <div class="container">
        <div class="row pt-4 pb-4 gt-3">

            <?php
                if(isset($_SESSION['noti'])){
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }
            
            ?>

            <h2 class="mt-4 mb-3">Manage Admin</h2>
            
            <!-- Admin Table -->
            <div class="col-12">
                <a href="add-admin.php" class="btn btn-primary w-10 mb-3">Add Admin</a>

                <table class="table table-light table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Retrieve Data From Database -->
                        <?php 
                            $sql = "SELECT * FROM  admins";
                            $res = mysqli_query($conn,$sql);

                            if($res){
                                //count the number of rows from tables
                                $count = mysqli_num_rows($res);

                                if($count == 0){
                                    echo "no data";
                                }else{
                                    $sn = 1;
                                    while($row = mysqli_fetch_assoc($res)){

                                        $id = $row['id'];
                                        $fullname = $row['fullname'];
                                        $username = $row['username'];
                                        $password = $row['password'];

                                        ?>
                                        <!-- Can Now code html -->
                                            <tr>
                                                <th scope="row"><?= $sn ?></th>
                                                <td><?= $fullname ?></td>
                                                <td><?= $username ?></td>
                                                <td>
                                                    <a href="<?= SITEURL ?>admin/update-password.php?id=<?= $id ?>" class="bg-white p-2 rounded mx-1" title="update password">
                                                        <img src = "../images/icons8-forgot-password-64.png" width = "25px"/>
                                                    </a>
                                                    <a href="<?= SITEURL ?>admin/update-admin.php?id=<?= $id ?>" class="bg-white p-2 rounded mx-1" title="update admin">
                                                        <img src = "../images/icons8-edit-64.png" width = "25px"/>
                                                    </a>
                                                    <a href="<?= SITEURL ?>admin/delete-admin.php?id=<?= $id ?>" class="bg-white p-2 rounded mx-1" title="delete admin">
                                                        <img src = "../images/icons8-delete-100.png" width = "25px"/>
                                                    </a>
                                                    
                                                </td>
                                            </tr>
                                        
                                        <?php
                                        $sn++;

                                    }
                                }
                            }
                        
                        ?>
                       
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include("widget/footer.php"); ?>