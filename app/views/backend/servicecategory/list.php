<div class="pc-container">
    <div class="pc-content">
        <h1>Service Category List</h1>


        <div class="d-flex mb-3">
            <form action="" method="GET">

                <input type="text" id="searchInput" name="search" placeholder="Tìm kiếm tên hoặc mô tả"
                    style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;"
                    value="<?php echo htmlspecialchars($search); ?>">
            </form>

            <a href="<?php echo _WEB_ROOT; ?>/servicecategory/add" class="btn btn-primary ms-auto">Add New</a>

        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $sortOrder = ($currentSort == 'CategoryID' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?sort=CategoryID&order=<?= $sortOrder ?>" style="color: black !important;">CategoryID
                            <?= $sortIcon ?></a>
                    </th>
                    <th><?php
                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                    $sortOrder = ($currentSort == 'CategoryName' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                    ?>
                        <a href="?sort=CategoryName&order=<?= $sortOrder ?>"
                            style="color: black !important;">CategoryName <?= $sortIcon ?></a>
                    </th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($servicecategories)): ?>
                    <?php foreach ($servicecategories as $servicecategory): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($servicecategory['CategoryID']); ?></td>
                            <td><?php echo htmlspecialchars($servicecategory['CategoryName']); ?></td>
                            <td><?php echo htmlspecialchars($servicecategory['Description']); ?></td>
                            <td>
                                <a href="<?php echo _WEB_ROOT; ?>/servicecategory/edit/<?php echo htmlspecialchars($servicecategory['CategoryID']); ?>"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?php echo _WEB_ROOT; ?>/servicecategory/delete/<?php echo htmlspecialchars($servicecategory['CategoryID']); ?>"
                                    class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No service categories found.</td>
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
            td = tr[i].getElementsByTagName("td")[1]; // Index 1 is the CategoryName column
            td2 = tr[i].getElementsByTagName("td")[2]; // Index 2 is the Description column
            if (td || td2) {
                txtValue = td.textContent || td.innerText;
                txtValue2 = td2.textContent || td2.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
</script>