<div class="pc-container">
    <div class="pc-content">
        <h1>Car List</h1>

        <div style="margin-bottom: 20px;">
            <input type="text" id="searchInput" name="search" placeholder="Tìm kiếm biển số, hãng xe, dòng xe"
                style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;"
                value="<?php echo htmlspecialchars($search); ?>">
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $sortOrder = ($currentSort == 'CarID' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?sort=CarID&order=<?= $sortOrder ?>" style="color: black !important;">CarID
                            <?= $sortIcon ?></a>
                    </th>
                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $sortOrder = ($currentSort == 'LicensePlate' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?sort=LicensePlate&order=<?= $sortOrder ?>" style="color: black !important;">License
                            Plate <?= $sortIcon ?></a>
                    </th>
                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $sortOrder = ($currentSort == 'Brand' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?sort=Brand&order=<?= $sortOrder ?>" style="color: black !important;">Brand
                            <?= $sortIcon ?></a>
                    </th>
                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $sortOrder = ($currentSort == 'Model' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?sort=Model&order=<?= $sortOrder ?>" style="color: black !important;">Model
                            <?= $sortIcon ?></a>
                    </th>
                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $sortOrder = ($currentSort == 'CarYear' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?sort=CarYear&order=<?= $sortOrder ?>" style="color: black !important;">CarYear
                            <?= $sortIcon ?></a>
                    </th>
                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $sortOrder = ($currentSort == 'VIN' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?sort=VIN&order=<?= $sortOrder ?>" style="color: black !important;">VIN
                            <?= $sortIcon ?></a>
                    </th>
                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $sortOrder = ($currentSort == 'LastServiceDate' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?sort=LastServiceDate&order=<?= $sortOrder ?>"
                            style="color: black !important;">LastServiceDate <?= $sortIcon ?></a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cars)): ?>
                    <?php foreach ($cars as $car): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($car['CarID']); ?></td>
                            <td><?php echo htmlspecialchars($car['LicensePlate']); ?>
                            </td>
                            <td><?php echo htmlspecialchars($car['Brand']); ?></td>
                            <td><?php echo htmlspecialchars($car['Model']); ?></td>
                            <td><?php echo htmlspecialchars($car['CarYear']); ?></td>
                            <td><?php echo htmlspecialchars($car['VIN']); ?></td>
                            <td><?php echo htmlspecialchars($car['LastServiceDate']); ?></td>
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
            td = tr[i].getElementsByTagName("td")[0]; // Index 0 is the CarID column
            td1 = tr[i].getElementsByTagName("td")[1]; // Index 1 is the LicensePlate column
            td2 = tr[i].getElementsByTagName("td")[2]; // Index 2 is the Brand column
            td3 = tr[i].getElementsByTagName("td")[3]; // Index 3 is the Model column
            td4 = tr[i].getElementsByTagName("td")[4]; // Index 4 is the CarYear column
            td5 = tr[i].getElementsByTagName("td")[5]; // Index 5 is the VIN column
            if (td || td1 || td2 || td3 || td4 || td5) {
                txtValue = td.textContent || td.innerText;
                txtValue1 = td1.textContent || td1.innerText;
                txtValue2 = td2.textContent || td2.innerText;
                txtValue3 = td3.textContent || td3.innerText;
                txtValue4 = td4.textContent || td4.innerText;
                txtValue5 = td5.textContent || td5.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1 || txtValue5.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
</script>