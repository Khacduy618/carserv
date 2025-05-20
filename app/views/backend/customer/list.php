<div class="pc-container">
    <div class="pc-content">
        <h1>Danh sách Khách hàng</h1>
        <form action="" method="GET">
            <div style="margin-bottom: 20px;">
                <input type="text" id="searchInput" name="search"
                    placeholder="Tìm kiếm tên, email, số điện thoại, biển số"
                    style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">

            </div>
        </form>
        <table id="customerTable" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">

                    <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">
                        <?php
                        $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                        $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                        $sortOrder = ($currentSort == 'CustomerName' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                        $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                        ?>
                        <a href="?page=<?= $currentPage ?>&sort=CustomerName&order=<?= $sortOrder ?>"
                            style="color: black !important;">Tên
                            khách hàng
                            <?= $sortIcon ?></a>
                    </th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">
                        <?php
                        $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                        $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                        $sortOrder = ($currentSort == 'CustomerPhoneNumber' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                        $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                        ?>
                        <a href="?page=<?= $currentPage ?>&sort=CustomerPhoneNumber&order=<?= $sortOrder ?>"
                            style="color: black !important;">Số
                            điện thoại <?= $sortIcon ?></a>
                    </th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">
                        <?php
                        $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                        $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                        $sortOrder = ($currentSort == 'CustomerEmail' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                        $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                        ?>
                        <a href="?page=<?= $currentPage ?>&sort=CustomerEmail&order=<?= $sortOrder ?>"
                            style="color: black !important;">Email
                            <?= $sortIcon ?></a>
                    </th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">
                        <?php
                        $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                        $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                        $sortOrder = ($currentSort == 'NumberOfBookings' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                        $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                        ?>
                        <a href="?page=<?= $currentPage ?>&sort=NumberOfBookings&order=<?= $sortOrder ?>"
                            style="color: black !important;">Tổng
                            đơn <?= $sortIcon ?></a>
                    </th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">Biển số xe</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($customers):
                    foreach ($customers as $customer):
                        extract($customer);
                        // var_dump($customer);
                        ?>
                        <tr>
                            <td style="padding: 8px; border: 1px solid #ddd;"><?= $CustomerName ?></td>
                            <td style="padding: 8px; border: 1px solid #ddd;"><?= $CustomerPhoneNumber ?></td>
                            <td style="padding: 8px; border: 1px solid #ddd;"><?= $CustomerEmail ?></td>
                            <td style="padding: 8px; border: 1px solid #ddd;" class="text-center"><?= $NumberOfBookings ?></td>
                            <td style="padding: 8px; border: 1px solid #ddd; width: 15%;" colspan="1">
                                <?php
                                $carIDs = explode(', ', $AllCarID);
                                $licensePlates = explode(', ', $AllLicensePlates);
                                if (!empty($licensePlates)) {
                                    echo '<div class="d-flex flex-column">';
                                    for ($i = 0; $i < count($licensePlates); $i++) {
                                        $carID = isset($carIDs[$i]) ? $carIDs[$i] : '';
                                        $licensePlate = $licensePlates[$i];
                                        echo '<a href="' . _WEB_ROOT . '/car-detail/' . $carID . '" class="btn btn-outline-primary mb-2">' . $licensePlate . '</a>';
                                    }
                                    echo '</div>';
                                } else {
                                    echo htmlspecialchars($AllLicensePlates);
                                }
                                ?>
                            </td>


                        </tr>
                        <?php
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
         <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>&search=<?php echo htmlspecialchars($search); ?>&sort=<?php echo htmlspecialchars($sort); ?>&order=<?php echo htmlspecialchars($order); ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($search); ?>&sort=<?php echo htmlspecialchars($sort); ?>&order=<?php echo htmlspecialchars($order); ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>&search=<?php echo htmlspecialchars($search); ?>&sort=<?php echo htmlspecialchars($sort); ?>&order=<?php echo htmlspecialchars($order); ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("customerTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Index 0 is the Name column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
</script>
