 <?php
include("adminheader.php")
?>
 
 <?php
$sql = "SELECT *
        FROM serviceregistration 
        order by id DESC
        ";
$result = $conn->query($sql);

?>
 
 <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Service View</h2>
        <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> -->
      </div><!-- End Section Title -->





<?php
while($data = mysqli_fetch_array($result)) {
?>

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
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 10
                }
              }
            }
          </script>
          <!-- <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <a href="uploads/<?php echo $data['image'];?>" target="_blank"><img src="uploads/<?php echo $data['image'];?>" class="testimonial-img" alt=""></a>
                <h3><?php echo $data['name'];?></h3>
                <h4><?php echo $data['email'];?></h4>
                <h4><?php echo $data['phone_no'];?></h4>
                <h5><?php echo $data['address'];?></h5>

                <?php 
               $l="select * from login where user_id={$data['id']}";
              //  echo $l;
               $ex=mysqli_query($conn,$l);
               $rows=mysqli_fetch_array($ex);
               $id=$rows['id'];
                if ($rows['status'] == 'active'){
                      
                    echo "<a href='adminserviceview.php?id={$data['email']}&sts=inactive' class='btn btn-outline-danger btn-sm'>Make Inactive</a>";
                    }
                else{ 
                  echo "<a href='adminserviceview.php?id={$data['email']}&sts=active' class='btn btn-success btn-sm'>Make Active</a>";
                  
                    }
                ?>
                <!-- <div class="stars"> -->
                  <!-- <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i> -->
                </div>
                <p>
                  <!-- <i class="bi bi-quote quote-icon-left"></i> -->
                  <!-- <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span> -->
                  <!-- <i class="bi bi-quote quote-icon-right"></i> -->
                </p>
              </div>
            </div><!-- End testimonial item -->

           <!-- <div class="swiper-slide"> -->
              <!-- <div class="testimonial-item"> -->
                <!-- <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt=""> -->
                
          </div> 
          <div class="swiper-pagination"></div>
        </div>

      </div>
<?php }?>

    </section>

<?php

if (isset($_GET['id'])){
    $id=$_GET['id'];
    $sts=$_GET['sts'];
    $u="update login set status = '$sts' where user_name= '$id' and `usertype`='service'";
    echo $u;
    $exx=mysqli_query($conn,$u);
    echo '<script>location.href="adminserviceview.php"</script>';
}
?>

  <?php
  include("commonfooter.php")
  ?>