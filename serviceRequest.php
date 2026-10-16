<?php
include("serviceheader.php");
$user_id = $_SESSION['user_id'];
?>

<!-- Contact Section -->
<section id="contact" class="contact section">
  <div class="container" data-aos="fade-up">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>VIEW REQUESTS</h2>
      <p>View customer service requests and their map locations.</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">
        <table class="table table-bordered table-striped">
          <thead style="background-color: #343a40; color: white;">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Issue</th>
              <th scope="col">Customer Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">Location</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Fetch all requests made for this service provider
            $sql = "SELECT booking.*, userregistration.name, userregistration.email, userregistration.phoneno 
                    FROM booking 
                    INNER JOIN userregistration ON booking.user_id = userregistration.id 
                    WHERE booking.service_id = '$user_id' AND booking.status = 'requested' 
                    ORDER BY booking.id DESC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
              $i = 1;
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td><?php echo htmlspecialchars($row['issue']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phoneno']); ?></td>
                
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
                  <a href="serviceRequest.php?id=<?php echo $row['id']; ?>&status=approved" class="btn btn-success btn-sm">Approve</a>
                  <a href="serviceRequest.php?id=<?php echo $row['id']; ?>&status=rejected" class="btn btn-danger btn-sm">Reject</a>
                </td>
              </tr>
            <?php
              }
            } else {
              echo "<tr><td colspan='7' class='text-center'>No requests found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

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
// Update status logic
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $status = $_GET['status'];

  $updateBooking = "UPDATE booking SET status = '$status' WHERE id = $id";
  $updateService = "UPDATE serviceregistration SET status = 'unavailable' WHERE id = (SELECT service_id FROM booking WHERE id = $id)";
  
  mysqli_query($conn, $updateBooking);
  mysqli_query($conn, $updateService);

  echo '<script>location.href="serviceRequest.php"</script>';
}
?>
