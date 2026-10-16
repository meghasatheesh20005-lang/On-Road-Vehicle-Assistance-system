<?php
include("userheader.php");

$user_id = $_SESSION['user_id'];
// echo $user_id;

if (isset($_GET['id'])){
    $servicer_id=$_GET['id'];
}


?>
            
            
            
            
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 90%;
            margin: 20px;
        }
    </style>



<!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>CONFIRM YOUR REQUEST</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          

          <center>
            <div class="col-lg-6">
            <form action="" method="post" class="" data-aos="fade-up" data-aos-delay="500" onsubmit="return validateLocation();">

              <div class="row gy-4">

                

                <div class="col-md-12">
                  <textarea class="form-control" name="issue" rows="4" placeholder="Describe Your Issue" required=""></textarea>



                         <!-- Hidden fields for lat/lon -->
                  <input type="hidden" value="" id="lat" name="lat" required>
                  <input type="hidden" value="" id="lon" name="lon" required>

                  <center>
                      <div id="map" class="col-lg-12 rounded" style="height:400px;"></div>
                  </center>
                </div>

           
                  <button type="submit" class="btn btn-primary" name="register">Send Request</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->
          </center>

        </div>

      </div>

    </section><!-- /Contact Section -->

<!-- Leaflet JS & CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

<script>
    var map = L.map('map').setView([10.8505, 76.2711], 7);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.Control.geocoder({ defaultMarkGeocode: true }).addTo(map);

    var marker; // store marker reference

    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        document.getElementById('lat').value = lat;
        document.getElementById('lon').value = lng;

        // If marker already exists, remove it
        if (marker) {
            map.removeLayer(marker);
        }

        // Add marker on selected location
        marker = L.marker([lat, lng]).addTo(map)
            .bindPopup("Location Selected").openPopup();

        alert("Location Saved");
    });

    function validateLocation() {
        var lat = document.getElementById('lat').value;
        var lon = document.getElementById('lon').value;

        if (!lat || !lon) {
            alert("Please select a location on the map.");
            return false; // stop form submission
        }
        return true;
    }
    function validateLocation() {
    var lat = document.getElementById('lat').value;
    var lon = document.getElementById('lon').value;

    if (!lat || !lon) {
        alert("Please select a location on the map before sending the request.");
        return false; // stop form submission
    }
    return true; // allow submission
}

</script>


<?php include("commonfooter.php"); ?>



<?php
if (isset($_REQUEST['register'])){
  $issue=$_REQUEST['issue'];
  $lat = $_REQUEST['lat'];
  $lon = $_REQUEST['lon'];



    $qry="INSERT INTO booking(issue, user_id, service_id, `status`,`lon`,`lat`) VALUES ('$issue', '$user_id', '$servicer_id', 'requested','$lon','$lat')";
    echo $qry;
    $res=mysqli_query($conn,$qry);
    if($res){
        echo "<script>alert('Request Sent successfully')</script>";
        echo '<script>location.href="user_viewservice.php"</script>';
    }
    else
    {
        echo "<script>alert('Error Occured')</script>"; 
    }

}
?>

