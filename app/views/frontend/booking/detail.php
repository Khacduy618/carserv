<div class="pc-container">
    <div class="pc-content container mt-4">
        <h2 class="mb-4">Booking Details</h2>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Booking Code:</strong> <?php echo $booking['BookingCode']; ?></p>
                <p><strong>Customer Name:</strong> <?php echo $booking['CustomerName']; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $booking['CustomerPhoneNumber']; ?></p>
                <p><strong>Email:</strong> <?php echo $booking['CustomerEmail']; ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Car Brand:</strong> <?php echo $booking['Brand']; ?></p>
                <p><strong>Car Model:</strong> <?php echo $booking['Model']; ?></p>
                <p><strong>Car Year:</strong> <?php echo $booking['CarYear']; ?></p>
                <p><strong>License Plate:</strong> <?php echo $booking['LicensePlate']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Booking Date:</strong> <?php echo $booking['BookingDate']; ?></p>
                <p><strong>Booking Time:</strong> <?php echo $booking['Time']; ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Status:</strong> <?php echo $booking['StatusName']; ?></p>
                <p><strong>Notes:</strong> <?php echo $booking['Notes']; ?></p>
            </div>
        </div>

        <h3 class="mt-4">Services:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalPrice = 0;
                foreach ($bookingServices as $service):
                    $totalPrice += $service['PriceAtBooking'];
                    ?>
                    <tr>
                        <td><?php echo $service['ServiceName']; ?></td>
                        <td><?php echo number_format($service['PriceAtBooking']); ?> VNĐ</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="mt-3"><strong>Total Price:</strong> <?php echo number_format($totalPrice); ?> VNĐ</p>
    </div>
</div>