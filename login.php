<?php
include("commonheader.php")
?>
  <main class="main">
    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>LOGIN</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
         

          <center>
            <div class="col-lg-6">
            <form action="" method="post" class="" data-aos="fade-up" data-aos-delay="500">
              <div class="row gy-4">

                <div class="col-md-12">
                  <input type="text" name="name" class="form-control" placeholder="username" required="">
                </div>

                <div class="col-md-12 ">
                  <input type="password" class="form-control" name="password" placeholder="Password" required="">
                </div>

                

                <div class="col-md-12 text-center">

                  <button type="submit" class="btn btn-primary" name="sub">Login</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->
          </center>

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>
  <?php
  include("commonfooter.php")
  ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>










<?php
    if(isset($_REQUEST['sub'])){
        $name=$_REQUEST['name'];
        $password=$_REQUEST['password'];
        $qry="select * from login where user_name = '$name' and password = '$password'";
        echo $qry;
        $result=mysqli_query($conn,$qry);
        $row=mysqli_fetch_array($result);
        $count=mysqli_num_rows($result);
        if($count==0){
            echo "<script>alert('Invalid Username! ')</script>";
        }
        else{
            if($row['password']==$password){
                if($row['status']=='active'){
                    $_SESSION['user_id']=$row['user_id'];
                    if($row['usertype']=='admin'){
                        // echo "<script>alert('Success')</script>";
                        echo "<script>location.href='admin.php'</script>";
                    }
                    elseif($row['usertype']=='user'){
                        // echo "<script>alert('Success')</script>";
                        echo "<script>location.href='userhome.php'</script>";
                    }
                    elseif($row['usertype']=='service'){
                        // echo "<script>alert('Success')</script>";
                        echo "<script>location.href='servicehome.php'</script>";
                    }

                }
                else{
                    echo "<script>alert('Not Aproved by admin')</script>";
                }
            }
            else{
                echo "<script>alert('Incorrect password!')</script>";
            }
        }

      }
  ?>
  