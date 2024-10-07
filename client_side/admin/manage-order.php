<?php include("widget/header.php"); ?>
    <div class="container">
        <div class="row pt-4 pb-4 text-color">
            <?php 
                if(isset($_SESSION['noti'])){
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }
            ?>

            <h2 class="mt-4 mb-3">Manage Order</h2>

            <!-- Filter Buttons -->
            <div class="btn-group mb-3">
                <a href="<?= SITEURL ?>admin/manage-order.php?status=all" class="btn <?= (!isset($_GET['status']) || $_GET['status'] == 'all') ? 'btn-primary' : 'btn-outline-light' ?>">All Orders</a>
                <a href="<?= SITEURL ?>admin/manage-order.php?status=Ordered" class="btn <?= (isset($_GET['status']) && $_GET['status'] == 'Ordered') ? 'btn-secondary' : 'btn-info' ?>">Ordered</a>
                <a href="<?= SITEURL ?>admin/manage-order.php?status=On Delivery" class="btn <?= (isset($_GET['status']) && $_GET['status'] == 'On Delivery') ? 'btn-warning' : 'btn-warning' ?>">On Delivery</a>
                <a href="<?= SITEURL ?>admin/manage-order.php?status=Delivered" class="btn <?= (isset($_GET['status']) && $_GET['status'] == 'Delivered') ? 'btn-success' : 'btn-success' ?>">Delivered</a>
                <a href="<?= SITEURL ?>admin/manage-order.php?status=Canceled" class="btn <?= (isset($_GET['status']) && $_GET['status'] == 'Canceled') ? 'btn-danger' : 'btn-danger' ?>">Canceled</a>
            </div>
            <!-- End of Filter Buttons -->

            <div class="col-12">
                <table class="table table-light table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total ($)</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Name</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                            // Retrieve the selected filter status
                            $status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

                            // Build SQL query based on the selected status
                            if ($status_filter == 'all') {
                                $sql = "SELECT * FROM orders"; // Show all orders if 'all' is selected
                            } else {
                                $sql = "SELECT * FROM orders WHERE status = '$status_filter'"; // Filter by selected status
                            }

                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if($count == 0){
                                echo "No Data";
                            } else {
                                $sn = 1;
                                while($row = mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $product = $row['product'];
                                    $price = $row['price'];
                                    $qty = $row['qty'];
                                    $total = $row['total'];
                                    $order_date = $row['order_date'];
                                    $status = $row['status'];
                                    $name = $row['customer_name'];
                                    $contact = $row['customer_contact'];
                                    $email = $row['customer_email'];
                                    $address = $row['customer_address'];

                                    switch($status){
                                        case "Ordered":
                                            $text_color = "text-primary";
                                            break;
                                        case "On Delivery":
                                            $text_color = "text-warning";
                                            break;
                                        case "Delivered":
                                            $text_color = "text-success";
                                            break;
                                        case "Canceled":
                                            $text_color = "text-danger";
                                            break;
                                        default:
                                            $text_color = "text-error";
                                    }
                                    ?>
                                    
                                    <tr>
                                        <th scope="row"><?= $sn ?></th>
                                        <td><?= $product ?></td>
                                        <td><?= $qty ?></td>
                                        <td>$ <?= $total ?></td>
                                        <td><?= $order_date ?></td>
                                        <td class="<?= $text_color?>"> <?= $status ?> </td>
                                        <td><?= $name ?></td>
                                        <td><?= $contact?></td>
                                        <td><?= $email ?></td>
                                        <td><?= $address ?></td>

                                        <td>
                                            <a href="<?= SITEURL ?>admin/update-order.php?id=<?= $id ?>&status=<?= $status ?>" class="bg-white p-2 rounded mx-1" title="update product">
                                                <img src = "../images/icons8-edit-64.png" width = "25px"/>
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
