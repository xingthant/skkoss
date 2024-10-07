    <?php include("widget/header.php") ?>

    <!-- Contact Section -->
    <div class="container p-3">
        <br><br>
        <div class="row">
            <div class="col-md-6 p-3">
                <div class="rounded-3 p-3 shadow">
                    <form class="row g-3">
                        <div class="col-md-12 ">
                            <label for="inputName" class="form-label text-white">Name</label>
                            <input type="text" class="form-control" id="inputName" placeholder="James">
                        </div>
                        <div class="col-md-12 ">
                            <label for="inputEmail" class="form-label text-white">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="someone@gmail.com">
                        </div>
                        <div class="col-md-12 ">
                            <label for="textarea" class="form-label text-white">Your Query</label>
                            <textarea class="form-control mt-3" placeholder="Leave your query here" id="textarea"
                                style="height: 150px;"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-40" type="submit">Send Mail</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 p-3">
                <div class="card rounded-3 shadow">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12480.482744411418!2d98.54077404707473!3d16.816691747576968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30dda160de306ced%3A0x87d184ed4a2c0ab6!2sShwe%20Koke%20Ko!5e0!3m2!1smy!2smm!4v1728261611523!5m2!1smy!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section -->

    <!-- Mobile View Search Bar -->
    <div class="container-fluid product-search d-md-none d-sm-block p-4">
        <h2 class="text-white text-center p-3">Contact Us</h2>
    </div>
    <!-- Mobile View Search Bar -->

<?php include("widget/footer.php") ?>