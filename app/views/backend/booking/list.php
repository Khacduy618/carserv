<div class="pc-container">
    <div class="pc-content">
        <h1>Car List</h1>

        <div style="margin-bottom: 20px;">
            <input type="text" id="searchInput" name="search" placeholder="Tìm kiếm biển số, mã đặt hàng,.."
                style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;"
                value="<?php echo htmlspecialchars($search); ?>">
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>

                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $sortOrder = ($currentSort == 'BookingCode' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?page=<?= $currentPage ?>&sort=BookingCode&order=<?= $sortOrder ?>"
                            style="color: black !important;">BookingCode
                            <?= $sortIcon ?></a>
                    </th>
                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $sortOrder = ($currentSort == 'CustomerName' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?page=<?= $currentPage ?>&sort=CustomerName&order=<?= $sortOrder ?>"
                            style="color: black !important;">CustomerName
                            <?= $sortIcon ?></a>
                    </th>
                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $sortOrder = ($currentSort == 'CustomerPhoneNumber' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?page=<?= $currentPage ?>&sort=CustomerPhoneNumber&order=<?= $sortOrder ?>"
                            style="color: black !important;">CustomerPhoneNumber
                            <?= $sortIcon ?></a>
                    </th>
                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $sortOrder = ($currentSort == 'CustomerEmail' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?page=<?= $currentPage ?>&sort=CustomerEmail&order=<?= $sortOrder ?>"
                            style="color: black !important;">CustomerEmail
                            <?= $sortIcon ?></a>
                    </th>
                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $sortOrder = ($currentSort == 'StatusID' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?page=<?= $currentPage ?>&sort=StatusID&order=<?= $sortOrder ?>"
                            style="color: black !important;">StatusID <?= $sortIcon ?></a>
                    </th>

                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $sortOrder = ($currentSort == 'LicensePlate' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?page=<?= $currentPage ?>&sort=LicensePlate&order=<?= $sortOrder ?>"
                            style="color: black !important;">License
                            Plate <?= $sortIcon ?></a>
                    </th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bookings)): ?>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>


                            <td><?php echo htmlspecialchars($booking['BookingCode']); ?></td>
                            <td><?php echo htmlspecialchars($booking['CustomerName']); ?></td>
                            <td><?php echo htmlspecialchars($booking['CustomerPhoneNumber']); ?></td>
                            <td><?php echo htmlspecialchars($booking['CustomerEmail']); ?></td>
                            <td><?php echo htmlspecialchars($booking['StatusID']); ?></td>
                            <td><?php echo htmlspecialchars($booking['LicensePlate']); ?>
                            </td>
                            <td><a href="">🍳</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No cars found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php if ($page > 1): ?>
                <a
                    href="?page=<?php echo $page - 1; ?>&search=<?php echo htmlspecialchars($search); ?>&sort=<?php echo htmlspecialchars($sort); ?>&order=<?php echo htmlspecialchars($order); ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($search); ?>&sort=<?php echo htmlspecialchars($sort); ?>&order=<?php echo htmlspecialchars($order); ?>"
                    <?php if ($i == $page)
                        echo 'class="active"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a
                    href="?page=<?php echo $page + 1; ?>&search=<?php echo htmlspecialchars($search); ?>&sort=<?php echo htmlspecialchars($sort); ?>&order=<?php echo htmlspecialchars($order); ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementsByClassName("table-bordered")[0];
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td1 = tr[i].getElementsByTagName("td")[0]; // Index 1 is the BookingCode column
            td2 = tr[i].getElementsByTagName("td")[1]; // Index 2 is the CustomerName column
            td3 = tr[i].getElementsByTagName("td")[2]; // Index 3 is the CustomerPhoneNumber column
            td4 = tr[i].getElementsByTagName("td")[3];
            td5 = tr[i].getElementsByTagName("td")[5];
            if (td1 || td2 || td3 || td4 || td5) {
                txtValue1 = td1.textContent || td1.innerText;
                txtValue2 = td2.textContent || td2.innerText;
                txtValue3 = td3.textContent || td3.innerText;
                txtValue4 = td4.textContent || td4.innerText;
                txtValue5 = td5.textContent || td5.innerText;
                if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1 || txtValue5.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
</script>