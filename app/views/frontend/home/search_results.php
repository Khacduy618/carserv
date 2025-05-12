<div class="pc-container">
    <div class="pc-content container mt-4">
        <div class="row">
            <div class="row frmtitle">
                <h2><?= $title ?> cho biển số xe: <?= $licensePlate ?? '' ?></h2>
            </div>

            <div class="row frmcontent">
                <?php
                if (!empty($bookings)) {
                    ?>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Mã Booking</th>
                                    <th>Số lượng dịch vụ</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td>
                                            <?= $booking['BookingCode'] ?>
                                        </td>
                                        <td>
                                            <?= $booking['TotalServices'] ?>
                                        </td>
                                        <td>
                                            <?= number_format($booking['TotalPrice'], 0, ',', '.') ?> VNĐ
                                        </td>
                                        <td>
                                            <?= $booking['StatusName'] ?>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary">Xem chi tiết</a>
                                            <?php if ($booking['StatusID'] != 3 && $booking['StatusID'] != 4 && $booking['StatusID'] != 5): ?>
                                                <a href="<?= _WEB_ROOT ?>/cancel-booking/<?= $booking['BookingCode'] ?>?license_plate=<?= $licensePlate ?>"
                                                    class="btn btn-warning">Hủy</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                } else {
                    echo "<p>Không tìm thấy booking nào với biển số xe này.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>