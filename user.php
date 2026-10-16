<?php
include("commonheader.php")
?>


  <main class="main">
    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>CUSTOMER REGISTRATION</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          

          <center>
            <div class="col-lg-6">
            <form action="" method="post" class="" data-aos="fade-up" data-aos-delay="500">
              <div class="row gy-4">

                <div class="col-md-12">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required=""pattern="[A-Za-z]{,}"  >
                </div>

                <div class="col-md-12 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required=""  >
                </div>

                <div class="col-md-12">
                  <input class="form-control" name="phoneno" placeholder="Phone no" required="" pattern="[6789][0-9]{9}" maxlength="10" type="tel">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="address" rows="4" placeholder="Address" required=""></textarea>
                </div>

               <div class="col-md-12">
                  <input  type="password" class="form-control" name="password" placeholder="Password" required="" >
                </div>
                <div class="col-md-12 text-center">

                  <button type="submit" class="btn btn-primary" name="register">Register</button>
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




<?php
if (isset($_REQUEST['register'])){
  $name=$_REQUEST['name'];
  $email=$_REQUEST['email'];
  $phoneno=$_REQUEST['phoneno'];
  $address=$_REQUEST['address'];
  $password=$_REQUEST['password'];

  $q="select count(*) as cnt from userregistration where email='$email'";
  // echo $q;
  $e=mysqli_query($conn,$q);
  $f=mysqli_fetch_array($e);
  $count=mysqli_num_rows($e);
  if ($f['cnt']>0){
    echo "<script>alert('Username alerady Exist!')</script>";
    // echo "location.href='studentReg.php'";
  }
  else
  {
    $qry="INSERT INTO userregistration(name, email, phoneno, address ) VALUES ('$name','$email','$phoneno','$address')";
    echo $qry;
    $res=mysqli_query($conn,$qry);
    $qryLog = "INSERT INTO login(user_id,user_name,password,usertype,status) VALUES ((SELECT MAX(id) FROM userregistration), '$email','$password','user','inactive')";

    $res2 = mysqli_query($conn,$qryLog);
    if($res && $res2){
        echo "<script>alert('Registration successfull')</script>";
    }
    else
    {
        echo "<script>alert('Error Occured')</script>"; 
    }
  }
}
?>







