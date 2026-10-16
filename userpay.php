<?php
include 'connection.php';

// Get booking_id from query string
if (!isset($_GET['id'])) {
    die("Invalid booking request.");
}
$booking_id = intval($_GET['id']);

// Fetch booking details (amount)
$qry = "SELECT amount FROM booking WHERE id = '$booking_id'";
$res = $conn->query($qry);
if ($res->num_rows == 0) {
    die("Booking not found.");
}
$row = $res->fetch_assoc();
$amount = $row['amount'];

// Handle Cash Payment
if (isset($_GET['method']) && $_GET['method'] === 'cash') {
    $update = "UPDATE booking SET status='By Cash' WHERE id='$booking_id'";
    $updateslot = "UPDATE serviceregistration SET status='available' WHERE id=(SELECT service_id FROM booking WHERE id='$booking_id')";
    if ($conn->query($update) && $conn->query($updateslot)) {
        echo "<script>alert('Payment set as By Cash!'); window.location.href='userviewBookings.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error updating cash payment.');</script>";
    }
}

// Handle online payment form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Dummy online payment process
    $card_number = $_POST['card_number'];
    $expiry = $_POST['expiry'];
    $cvv = $_POST['cvv'];

    $update = "UPDATE booking SET status='Payment Completed' WHERE id='$booking_id'";
    $updateslot = "UPDATE serviceregistration SET status='available' WHERE id=(SELECT service_id FROM booking WHERE id='$booking_id')";
    if ($conn->query($update) && $conn->query($updateslot)) {
        echo "<script>alert('Payment successful!'); window.location.href='userviewBookings.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error processing payment.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Assistance - Secure Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-300 flex items-center justify-center h-screen">
    <div class="bg-gray-800 text-white p-8 rounded-2xl shadow-xl w-96 space-y-6">
        <h2 class="text-2xl font-semibold text-center">Secure Payment</h2>
        
        <!-- ✅ Cash Payment Button -->
        <div class="flex justify-between">
            <a href="userpay.php?id=<?php echo $booking_id; ?>&method=cash" 
               class="w-1/2 mr-2 bg-yellow-500 hover:bg-yellow-400 text-white py-3 rounded-lg text-center font-semibold">Pay by Cash</a>
        </div>

        <form method="POST">
            <div>
                <label class="block text-sm">Amount</label>
                <input type="text" name="amount" value="₹<?php echo htmlspecialchars($amount); ?>" 
                    class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400" readonly>
            </div>
            
            <div>
                <label class="block text-sm">Card Number</label>
                <input type="text" name="card_number" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400" placeholder="1234 5678 9012 3456" required maxlength="16">
            </div>
            
            <div class="flex space-x-4">
                <div class="w-1/2">
                    <label class="block text-sm">Expiry</label>
                    <input type="text" name="expiry" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400" placeholder="MM/YY" maxlength="4" required>
                </div>
                <div class="w-1/2">
                    <label class="block text-sm">CVV</label>
                    <input type="password" name="cvv" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400" placeholder="•••" maxlength="3" required>
                </div>
            </div>
        
            <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-400 text-white py-3 rounded-lg font-semibold text-lg shadow-lg transition mt-2">Pay Now</button>
        </form>
    </div>
</body>
</html>
