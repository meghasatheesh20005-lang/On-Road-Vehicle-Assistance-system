<?php
include("userheader.php");

// Default SQL
$sql = "SELECT * FROM serviceregistration
        order by id DESC
        ";

// If search is submitted
if (isset($_GET['search'])) {
    $keyword = $_GET['keyword'];
    $sql = "SELECT * FROM serviceregistration 
            WHERE district LIKE '%$keyword%'";
}

$result = $conn->query($sql);
?>

<!-- Services Section -->
<section id="testimonials" class="testimonials section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Services</h2>
  </div><!-- End Section Title -->

  <!-- Search Form -->
  <div class="container mb-4" data-aos="fade-up" data-aos-delay="50">
    <form method="get" class="d-flex justify-content-center">
      <input type="text" name="keyword" class="form-control w-50" placeholder="Search locations..." 
             value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
      <button type="submit" name="search" class="btn btn-primary ms-2">Search</button>
    </form>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="swiper init-swiper">
      <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          },
          "breakpoints": {
            "320": {
              "slidesPerView": 1,
              "spaceBetween": 20
            },
            "1200": {
              "slidesPerView": 3,
              "spaceBetween": 20
            }
          }
        }
      </script>

      <div class="swiper-wrapper">
        <?php while($data = mysqli_fetch_array($result)) { ?>
          <div class="swiper-slide">
            <div class="testimonial-item">
              <h3><?php echo $data['name']; ?></h3>
              <h4><strong>Email:</strong> <?php echo $data['email']; ?></h4>
              <h4><strong>Phone:</strong> <?php echo $data['phone_no']; ?></h4>
              <h5><strong>Address:</strong> <?php echo $data['address']; ?></h5>
              <h5><strong>District:</strong> <?php echo $data['district']; ?></h5>
              <?php if($data['status'] == 'available'){ ?>
                <h5 class="text-success"><?php echo $data['status']; ?></h5>
                <a href="userRequest.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm">Book Now</a>
              <?php } else { ?>
                <h5 class="text-danger"><?php echo $data['status']; ?></h5>
              <?php } ?>
            </div>
          </div><!-- End swiper-slide -->
        <?php } ?>
      </div><!-- End swiper-wrapper -->

      <div class="swiper-pagination"></div>
    </div><!-- End Swiper -->

  </div>
</section>



<?php include("commonfooter.php"); ?>
