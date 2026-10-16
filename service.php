<?php 
include("commonheader.php");
// include("connection.php");
?>

<main class="main">
  <!-- Contact Section -->
  <section id="contact" class="contact section">

    <!-- Section Title -->
    <div class="container section-title text-center" data-aos="fade-up">
      <h2>SERVICE REGISTRATION</h2>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4 justify-content-center"><!-- Centered row -->

        <!-- Form Section -->
        <div class="col-lg-6">
          <form action="" method="post" data-aos="fade-up" data-aos-delay="500" enctype="multipart/form-data">
            <div class="row gy-4">

              <div class="col-md-12">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required pattern="[A-Za-z\s]+" />
              </div>

              <div class="col-md-12">
                <input type="email" class="form-control" name="email" placeholder="Your Email" required />
              </div>

              <div class="col-md-12">
                <input type="tel" class="form-control" name="phoneno" placeholder="Phone Number" required pattern="[6789][0-9]{9}" maxlength="10" />
              </div>

              <div class="col-md-12">
                <textarea class="form-control" name="address" rows="4" placeholder="Address" required></textarea>
              </div>

              <div class="col-md-12">
                <input type="password" class="form-control" name="password" placeholder="Password" 
                required 
                pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$" 
                title="Must contain at least one number, one letter, one special character, and be at least 8 characters long" />
              </div>

              <div class="col-md-12">
                <label for="file">Upload proof</label>
                <input type="file" class="form-control" name="file" required />
              </div>

              <div class="col-md-12">
                <input type="text" class="form-control" name="district" placeholder="Your district" required />
              </div>

              <!-- Hidden Location Inputs (optional) -->
              <!-- <input type="text" id="l1" name="l1" hidden />
              <input type="text" id="l2" name="l2" hidden /> -->

              <div class="col-md-12 text-center">
                <button type="submit" name="register" class="btn btn-primary px-4">Register</button>
              </div>

            </div>
          </form>
        </div>
      </div>

    </div>

  </section>
</main>

<?php include("commonfooter.php") ?>

</body>
</html>




<?php
if (isset($_REQUEST['register'])){
  $name=$_REQUEST['name'];
  $email=$_REQUEST['email'];
  $phoneno=$_REQUEST['phoneno'];
  $address=$_REQUEST['address'];
  $password=$_REQUEST['password'];
  $district=$_REQUEST['district'];
  $l1=$_REQUEST['l1'] ?? '';
  $l2=$_REQUEST['l2'] ?? '';
  $filename=$_FILES['file']['name'];
  $tempname=$_FILES['file']['tmp_name'];

  $folder="./uploads/".$filename;
  $q="select count(*) as cnt from serviceregistration where email='$email'";
  $e=mysqli_query($conn,$q);
  $f=mysqli_fetch_array($e);

  if ($f['cnt']>0){
    echo "<script>alert('Username already exists!')</script>";
  }
  else{
    if(move_uploaded_file($tempname,$folder)){
      $qry="insert into serviceregistration(`name`,`email`,`phone_no`,`address`,`image`,`latitude`, `longitude`,`district`) 
            values('$name','$email',$phoneno,'$address','$filename','$l1','$l2','$district')";
      $res=mysqli_query($conn,$qry);

      $qryLog = "INSERT INTO login(user_id,user_name,password,usertype,status) 
                 VALUES ((SELECT MAX(id) FROM serviceregistration), '$email','$password','service','inactive')";
      $res2=mysqli_query($conn,$qryLog);

      if ($res && $res2){
          echo "<script>alert('Registration Successful')</script>";
      } else {
          echo "<script>alert('Error during registration')</script>";
      }
    } else {
      echo "<script>alert('File Upload Failed')</script>";
    }
  }
}
?> 
