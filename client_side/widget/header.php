<?php include("./config.php") ?>

<!doctype html>
<html lang="en">

<head>

    <link rel="apple-touch-icon" sizes="180x180" href="icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="icon/favicon-16x16.png">
    <link rel="manifest" href="icon/site.webmanifest">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="/CLIENT_SIDE/style.css">
</head>

<body>
    <!-- Start Coding Here -->

    <!-- Nav Bar Section -->
    <nav class="navbar navbar-expand-lg bg-transparent shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand rounded-3" href="#">
            <img src="images/goodlogo.png" width ="80px" style ="border-radius: 20px 10px 20px 10px">

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-3 fw-normal fs-5">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item mx-3 fw-normal fs-5">
                        <a class="nav-link" href="category.php">Category</a>
                    </li>
                    <li class="nav-item mx-3 fw-normal fs-5">
                        <a class="nav-link" href="product.php">Product</a>
                    </li>
                    <li class="nav-item mx-3 fw-normal fs-5">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>

                </ul>
                <div class="d-none d-lg-block mx-3">
                    <form class="d-flex" role="search" method="GET" action="search-product.php">
                        <input class="form-control me-2 text-muted search" type="search" name="query"
                            placeholder="Search Something ..." aria-label="Search">
                        <button class="btn btn-outline-primary search-btn" type="submit">Search</button>
                    </form>
                </div>

            </div>
        </div>
    </nav>
    <!-- Nav Bar Section -->

    <!-- Mobile View Search Bar -->
    <div class="container-fluid product-search d-md-none d-sm-block">
        <form class="d-flex w-60 p-3 mx-auto" role="search">
            <input class="form-control me-2 text-muted search" type="search" placeholder="Search Something ..."
                aria-label="Search">
            <button class="btn btn-outline-light search-btn" type="submit">Search</button>
        </form>
    </div>
    <!-- Mobile View Search Bar -->
