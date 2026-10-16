<?php
include("adminheader.php");

$user_id = $_SESSION['user_id'];
?>

<!-- Contact Section -->
<section id="contact" class="contact section">
  <div class="container" data-aos="fade-up">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>BOOKING STATUS</h2>
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
              <th scope="col">Service</th>
              <th scope="col">Location</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // fetch all requests made by the user from the booking table
            $sql = "SELECT booking.*, userregistration.name, userregistration.email, userregistration.phoneno, serviceregistration.name AS service_name, serviceregistration.email AS service_email
            FROM booking INNER JOIN userregistration ON booking.user_id = userregistration.id 
            Inner JOIN serviceregistration ON booking.service_id = serviceregistration.id 
            ORDER BY booking.id DESC";
// echo $sql; // Debugging line to check the SQL query
            $result = $conn->query($sql);
            if ($result) {
                $i=1;
                while($row = mysqli_fetch_assoc($result)) {
                    
                        ?>
                <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td><?php echo $row['issue']; ?></td>
                <td><?php echo $row['name']; ?>,<br><?php echo $row['email']; ?></td>
                <td><?php echo $row['service_name']; ?>,<br><?php echo $row['service_email']; ?></td>
                 <!-- ✅ Map column -->
                <td>
                  <?php if (!empty($row['lat']) && !empty($row['lon'])) { ?>
                    <button class="btn btn-sm btn-success" onclick="showMap(<?php echo $row['lat']; ?>, <?php echo $row['lon']; ?>)">
                      View Map
                    </button>
                  <?php } else { ?>
                    <span style="color: gray;">No Location</span>
                  <?php } ?>
                </td>
                <td>
                    <?php echo $row['status']; ?> <br>
                     <?php if($row['amount'] != NULL) { ?>
                        Amount: ₹<?php echo $row['amount']; ?><br>
                    <?php } ?>


                    
                </td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6'>No requests found.</td></tr>";    
            }
            ?>
          </tbody>
        </table> <!-- ✅ closed table properly -->
      </div>
    </div>
  </div>
</section><!-- /Contact Section -->

<!-- ✅ Modal to show map -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="mapModalLabel">Customer Location</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="map" style="height: 400px; width: 100%; border-radius: 10px;"></div>
      </div>
    </div>
  </div>
</div>

<!-- ✅ Leaflet JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
  var map, marker;

  function showMap(lat, lon) {
    var modal = new bootstrap.Modal(document.getElementById('mapModal'));
    modal.show();

    setTimeout(function() {
      if (map) {
        map.remove();
      }

      map = L.map('map').setView([lat, lon], 14);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);

      marker = L.marker([lat, lon]).addTo(map)
        .bindPopup("Customer Location").openPopup();
    }, 300);
  }
</script>

<?php
include("commonfooter.php");
?>

<?php
if (isset($_GET['id'])){
    $id=$_GET['id'];
    // echo $id;
    $status=$_GET['status'];
    $u="update booking set status = '$status' where id= $id ";
    echo $u;
    $exx=mysqli_query($conn,$u);
    echo '<script>location.href="serviceBooking.php"</script>';
}
?>
