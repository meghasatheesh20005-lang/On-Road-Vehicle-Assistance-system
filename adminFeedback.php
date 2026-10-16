<?php
include("adminheader.php");

$user_id = $_SESSION['user_id'];
?>

<!-- Contact Section -->
<section id="contact" class="contact section">
  <div class="container" data-aos="fade-up">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>USER FEEDBACKS</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Issue</th>
              <th scope="col">Customer</th>
              <th scope="col">SERVICE</th>
              <th scope="col">Review & Rating</th>
            </tr>
          </thead>
          <tbody>
            <?php
        // fetch reviews for logged-in service
        $sql = "
        SELECT r.id as review_id, r.review, r.rating, r.date as review_date,
               b.issue, b.status,
               u.name as name, u.email, u.phone_no,
               u2.name as customer_name, u2.email as customer_email, u2.phoneno as customer_phone
        FROM review r
        JOIN booking b ON r.booking_id = b.id
        JOIN serviceregistration u ON b.service_id = u.id
        JOIN userregistration u2 ON b.user_id = u2.id
        order by r.id DESC
        ";

        $result = $conn->query($sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $i=1;
            while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <th scope="row"><?php echo $i++; ?></th>
            <td><?php echo $row['issue']; ?></td>
            <td><?php echo $row['customer_name']; ?>,<br><?php echo $row['customer_email']; ?></td>
            <td><?php echo $row['name']; ?>,<br><?php echo $row['email']; ?></td>
            <td>
                ⭐ <?php echo $row['rating']; ?>/5 <br>
                <?php echo $row['review']; ?><br>
                <small><?php echo $row['review_date']; ?></small>
            </td>
        </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='6'>No reviews found.</td></tr>";    
        }
        ?>

          </tbody>
        </table> <!-- ✅ closed table properly -->
      </div>
    </div>
  </div>
</section><!-- /Contact Section -->

<?php
include("commonfooter.php");
?>


