<?php
include("userheader.php");

$user_id = $_SESSION['user_id'];

// Get booking_id from query string
if (!isset($_GET['id'])) {
    die("Invalid booking request.");
}
$booking_id = intval($_GET['id']);



// Handle payment form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Here you can save payment details (dummy for now)
    $rating = $_POST['rating'];
    $message = $_POST['message'];

    // Update booking as "Booked"
    $feed = "insert into review (booking_id, rating, review) values ('$booking_id', '$rating', '$message')";
    $update = "UPDATE booking SET status='Feedback Completed' WHERE id='$booking_id'";
    if ($conn->query($update) && $conn->query($feed)) {
        echo "<script>alert('Feedback Posted successfully!'); window.location.href='userviewBookings.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error processing feedback.');</script>";
    }
}
?>

<!-- Contact Section -->
<section id="contact" class="contact section">
  <div class="container" data-aos="fade-up">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>POST FEEDBACK</h2>
      <p>We value your feedback. Please rate our service and share your comments.</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <form action="" method="POST" class="p-4 shadow rounded bg-light">
        
        <!-- Rating Stars -->
        <div class="mb-3">
          <label class="form-label"><strong>Rate Us:</strong></label><br>
          <div class="rating">
            <input type="radio" name="rating" value="5" id="star5"><label for="star5">⭐</label>
            <input type="radio" name="rating" value="4" id="star4"><label for="star4">⭐</label>
            <input type="radio" name="rating" value="3" id="star3"><label for="star3">⭐</label>
            <input type="radio" name="rating" value="2" id="star2"><label for="star2">⭐</label>
            <input type="radio" name="rating" value="1" id="star1"><label for="star1">⭐</label>
          </div>
        </div>

        <!-- Feedback Message -->
        <div class="mb-3">
          <label for="message" class="form-label"><strong>Your Feedback:</strong></label>
          <textarea class="form-control" id="message" name="message" rows="4" placeholder="Write your feedback here..." required></textarea>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Submit Feedback</button>
      </form>
    </div>

  </div>
</section><!-- /Contact Section -->

<?php
include("commonfooter.php");
?>
