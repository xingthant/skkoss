<?php 
    include("widget/header.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($res);

        $image_name = $row['image_name'];
        $title = $row['title'];
        $price = $row['price'];
    }
?>

<!-- Order Form Section -->
<div class="container">
    <div class="row p-3">
        <div class="col-md-8 mx-auto p-3">
            <br>
            <h2 class="text-center text-white">Fill this form to confirm your order</h2>
            <br>
            <form action="" class="row g-3" method="POST">
                <fieldset class="border p-3 rounded-3 border-2">
                    <legend class="float-none w-auto p-2 text-white">Select Product</legend>

                    <div class="d-flex">
                        <img src="images/products/<?= htmlspecialchars($image_name) ?>" alt="Product Image" class="w-25 h-25 rounded-3">
                        <div class="px-3">
                            <h3><?= htmlspecialchars($title) ?></h3>
                            <p>$ <?= htmlspecialchars($price) ?></p>

                            <label for="inputNumber" class="form-label">Items</label>
                            <input type="number" class="form-control w-25" min="1" value="1" id="inputNumber" name="qty">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="border p-3 rounded-3 border-2">
                    <legend class="float-none w-auto p-2 text-white">Delivery Details</legend>

                    <div class="col-md-12">
                        <label for="inputName" class="form-label text-white">Name</label>
                        <input type="text" class="form-control" id="inputName" placeholder="James" name="name">
                    </div>

                    <div class="col-md-12">
                        <label for="inputPhone" class="form-label text-white">Phone</label>
                        <input type="tel" class="form-control" id="inputPhone" placeholder="097979xxxxxx" name="contact">
                    </div>

                    <div class="col-md-12">
                        <label for="inputEmail" class="form-label text-white">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="someone@gmail.com" name="mail">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="textarea" class="form-label text-white">Your Address eg.Town,Deparetment,street-name...</label>
                        <textarea class="form-control mt-3" placeholder="Your Address Details" id="textarea" name="address" style="height: 150px;"></textarea>
                    </div>

                    <input type="hidden" value="<?= htmlspecialchars($title) ?>" name="product">
                    <input type="hidden" value="<?= htmlspecialchars($price) ?>" name="price">
                    <button type="submit" class="btn btn-primary w-40">Confirm Order</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<!-- Order Form Section -->

<?php 
    include("widget/footer.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_title = $_POST['product'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $order_date = date("Y-m-d H:i:s");
        $status = "Ordered";
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $email = $_POST['mail'];
        $address = $_POST['address'];

        if (empty($name) || empty($contact) || empty($email) || empty($address)) {
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">Please fill in all the required fields.</div>';
            header('location:'.SITEURL.'order.php');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">Invalid email format.</div>';
            header('location:'.SITEURL.'order.php');
            exit;
        }

        $sql = "INSERT INTO orders SET
            product = '$product_title',
            price = $price,
            qty = $qty,
            total = $total,
            order_date = '$order_date',
            status = '$status',
            customer_name = '$name',
            customer_contact = '$contact',
            customer_email = '$email',
            customer_address = '$address'";

        $res = mysqli_query($conn, $sql);

        if ($res) {
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">Order Placed Successfully</div>';
            header('location:'.SITEURL.'index.php');
        } else {
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">Failed to Place Order!</div>';
            header('location:'.SITEURL.'index.php');
        }
    }
?>
