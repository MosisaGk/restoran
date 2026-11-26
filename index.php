<?php 
require_once "config/config.php"; 
require_once "libs/App.php"; 
require_once "includes/header.php"; 

// Start session at the very top (before any output)

// Fetch data
$app = new App();

$meals_1 = $app->selectAll("SELECT * FROM foods WHERE meal_id=1"); // Breakfast
$meals_2 = $app->selectAll("SELECT * FROM foods WHERE meal_id=2"); // Lunch
$meals_3 = $app->selectAll("SELECT * FROM foods WHERE meal_id=3"); // Dinner

$reviews = $app->selectAll("SELECT * FROM reviews");
?>

<!-- Hero Section -->
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Meal</h1>
                <p class="text-white animated slideInLeft mb-4 pb-2">
                    Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos.
                </p>
                <a href="<?php echo APPURL; ?>/booking.php" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">
                    Book A Table
                </a>
            </div>
            <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="img/hero.png" alt="">
            </div>
        </div>
    </div>
</div>

<!-- Services -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-user-tie text-primary mb-4"></i>
                        <h5>Master Chefs</h5>
                        <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                    </div>
                </div>
            </div>
            <!-- ... other service items ... -->
        </div>
    </div>
</div>

<!-- About -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s" src="img/about-1.jpg">
                    </div>
                    <!-- ... other images ... -->
                </div>
            </div>
            <div class="col-lg-6">
                <h5 class="section-title ff-secondary text-start text-primary fw-normal">About Us</h5>
                <h1 class="mb-4">Welcome to <i class="fa fa-utensils text-primary me-2"></i>Restoran</h1>
                <p class="mb-4">Tempor erat elitr rebum at clita...</p>
                <!-- ... rest of about section ... -->
            </div>
        </div>
    </div>
</div>

<!-- Menu -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
            <h1 class="mb-5">Most Popular Items</h1>
        </div>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                        <i class="fa fa-coffee fa-2x text-primary"></i>
                        <div class="ps-3">
                            <small class="text-body">Popular</small>
                            <h6 class="mt-n1 mb-0">Breakfast</h6>
                        </div>
                    </a>
                </li>
                <!-- Lunch and Dinner tabs -->
            </ul>

            <div class="tab-content">
                <!-- Breakfast -->
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <?php foreach ($meals_1 as $meal): ?>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded" src="<?php echo APPIMAGES; ?>/<?php echo $meal->image; ?>" alt="" style="width: 80px;">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                                            <span><?php echo $meal->name; ?></span>
                                            <span class="text-primary">$<?php echo $meal->price; ?></span>
                                        </h5>
                                        <small class="fst-italic"><?php echo $meal->description; ?></small>
                                        <a href="<?php echo APPURL; ?>/food/add-cart.php?id=<?php echo $meal->id; ?>" 
                                           class="btn btn-primary py-2 mt-2 me-2">View</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Lunch and Dinner tabs similar to above -->
            </div>
        </div>
    </div>
</div>

<!-- Reservation -->
<div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row g-0">
        <div class="col-md-6">
            <div class="video">
                <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                    <span></span>
                </button>
            </div>
        </div>
        <div class="col-md-6 bg-dark d-flex align-items-center">
            <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                <h1 class="text-white mb-4">Book A Table Online</h1>
                <form method="POST" action="<?php echo APPURL; ?>/booking-table.php">
                    <!-- ... form fields ... -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <button name="submit" class="btn btn-primary w-100 py-3" type="submit">Book Now</button>
                    <?php else: ?>
                        <p class="text-white">Please <a href="<?php echo APPURL; ?>/auth/login.php" class="text-primary">login</a> to book a table</p>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Team, Testimonials, Footer -->
<?php require_once "includes/footer.php"; ?>