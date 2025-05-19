<div class="pc-container">
    <div class="pc-content">
        <h1>Thông tin xe</h1>
        <?php if ($car): ?>
            <table class="table table-bordered">

                <tr>
                    <th>Biển số xe</th>
                    <td><?php echo htmlspecialchars($car['LicensePlate']); ?></td>
                </tr>
                <tr>
                    <th>Hãng</th>
                    <td><?php echo htmlspecialchars($car['Brand']); ?></td>
                </tr>
                <tr>
                    <th>Dòng xe</th>
                    <td><?php echo htmlspecialchars($car['Model']); ?></td>
                </tr>
                <tr>
                    <th>Năm phát hành</th>
                    <td><?php echo htmlspecialchars($car['CarYear']); ?></td>
                </tr>
                <tr>
                    <th>VIN</th>
                    <td><?php echo htmlspecialchars($car['VIN']); ?></td>
                </tr>
                <?php if (!empty($car['LastServiceDate'])): ?>
                    <tr>
                        <th>LastServiceDate</th>
                        <td><?php echo htmlspecialchars($car['LastServiceDate']); ?></td>
                    </tr>
                <?php endif; ?>
            </table>
        <?php else: ?>
            <p>Car not found.</p>
        <?php endif; ?>
    </div>
</div>