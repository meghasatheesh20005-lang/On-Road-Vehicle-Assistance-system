<?php
           $qq="select * from donor";
            $ee=mysqli_query($conn,$qq);

            while($row=mysqli_fetch_array($ee)){
                $id=$row['id'];
                // $qrysts="select * from login where user_id='$id' and usertype='student' ";
                // $exe=my sqli_query($conn,$qrysts);
                // $fetch=mysqli_fetch_array($exe);
            ?>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="doctor-card">
              <div class="doctor-image">
                <!-- <img src="assets/img/health/staff-3.webp" alt="Dr. Sarah Mitchell" class="img-fluid"> -->
                <div class="availability-badge online"><?php echo $fetch['status']?></div>
              </div>
              <div class="doctor-info">
                <h5><b?>Name : </b><?php echo $row['name']?></h5>
                <p class="specialty"><b?>Email : </b><?php echo $row['email']?></p>
                <p class="specialty"><b?>Phone : </b><?php echo $row['phone']?></p>
                <p class="specialty"><b?>Blood Group: </b><?php echo $row['blood_group']?></p>
                <p class="specialty"><b?>Age : </b><?php echo $row['age']?></p>
                <p class="specialty"><b?>Gender : </b><?php echo $row['gender']?></p>
                <p class="specialty"><b?>Location : </b><?php echo $row['location']?></p>
               <?php 
               $l="select * from login where user_id={$row['id']}";
            //    echo $l;
               $ex=mysqli_query($conn,$l);
               $rows=mysqli_fetch_array($ex);
               $id=$rows['id'];
                if ($rows['status'] == 'active'){
                      
                    echo "<a href='adminDonor.php?id={$rows['id']}&sts=inactive' class='btn btn-outline-danger btn-sm'>Make Inactive</a>";
                    }
                else{ 
                  echo "<a href='adminDonor.php?id={$rows['id']}&sts=active' class='btn btn-success btn-sm'>Make Active</a>";
                  
                    }
                ?>









            $qq="select * from donor";
            $ee=mysqli_query($conn,$qq);

            while($row=mysqli_fetch_array($ee)){
                $id=$row['id'];
                // $qrysts="select * from login where user_id='$id' and usertype='student' ";
                // $exe=mysqli_query($conn,$qrysts);
                // $fetch=mysqli_fetch_array($exe);
            ?>

        