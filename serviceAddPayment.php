
<?php
include("connection.php");
if (isset($_REQUEST['register'])){
  $id=$_REQUEST['id'];
  $amount=$_REQUEST['amount'];
  $status=$_REQUEST['status'];

    $qry="update booking set amount=$amount, status='$status' where id=$id";
    // echo $qry;
    $res=mysqli_query($conn,$qry);
    if($res){
        echo "<script>alert('Amount Added successfully')</script>";
        echo '<script>location.href="serviceBooking.php"</script>';
    }
    else
    {
        echo "<script>alert('Error Occured')</script>"; 
    }

  
  }

?>