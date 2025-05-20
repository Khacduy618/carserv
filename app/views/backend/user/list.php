<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="row frmtitle">
                <h1><?= $title ?></h1>
            </div>
            <div class="d-flex mb-3">
                <input type="text" id="searchInput" name="search"
                    placeholder="Tìm kiếm tên, email, số điện thoại, quyền"
                    style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;"
                    value="<?php echo htmlspecialchars($search); ?>">
                <a href="<?= _WEB_ROOT ?>/add-staff" class="btn btn-success ms-auto">Thêm nhân viên mới</a>
            </div>

            <!-- Users Count -->
            <div class="mb-3">
                <span class="text-muted">Showing <?= count($users) ?> of <?= $total_users ?? count($users) ?>
                    Users</span>
            </div>

            <div class="row frmcontent">
                <form action="?act=deleteSelected" method="post" id="userForm">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th><?php
                                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $sortOrder = ($currentSort == 'FullName' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                                    ?>
                                        <a href="?page=<?= $currentPage ?>&sort=FullName&order=<?= $sortOrder ?>&search=<?= htmlspecialchars($search) ?>"
                                            style="color: black !important;">Họ Và Tên
                                            <?= $sortIcon ?></a>
                                    </th>
                                    <th><?php
                                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $sortOrder = ($currentSort == 'Email' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                                    ?>
                                        <a href="?page=<?= $currentPage ?>&sort=Email&order=<?= $sortOrder ?>"
                                            style="color: black !important;">Email
                                            <?= $sortIcon ?></a>
                                    </th>
                                    <th><?php
                                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $sortOrder = ($currentSort == 'PhoneNumber' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                                    ?>
                                        <a href="?page=<?= $currentPage ?>&sort=PhoneNumber&order=<?= $sortOrder ?>&search=<?= htmlspecialchars($search) ?>"
                                            style="color: black !important;">Số điện thoại
                                            <?= $sortIcon ?></a>
                                    </th>
                                    <th>Trạng thái</th>
                                    <th><?php
                                    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
                                    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $sortOrder = ($currentSort == 'Role' && strtoupper($currentOrder) == 'ASC') ? 'DESC' : 'ASC';
                                    $sortIcon = ($sortOrder == 'DESC') ? '&#8593;' : '&#8595;';
                                    ?>
                                        <a href="?page=<?= $currentPage ?>&sort=Role&order=<?= $sortOrder ?>&search=<?= htmlspecialchars($search) ?>"
                                            style="color: black !important;">Quyền
                                            <?= $sortIcon ?></a>
                                    </th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($users)) {
                                    foreach ($users as $user) {
                                        extract($user);
                                        // $user_images = !empty($user_images) 
                                        // ? _WEB_ROOT . '/public/uploads/avatar/' . $user_images
                                        // : _WEB_ROOT . '/public/uploads/avatar/user.png';
                                        // $images = "<img src='$user_images' alt='User Image' width='50'>";
                                        if ($IsActive == 1) {

                                            $user_status_display = ($IsActive == 1) ? 'Hoạt động' : 'Đã hủy';

                                            ?>
                                            <tr>
                                                <td><?= $FullName ?></td>
                                                <td><?= $Email ?></td>
                                                <td><?= $PhoneNumber ?></td>
                                                <td><?= $user_status_display ?></td>
                                                <td><?= $Role ?></td>
                                                <td>
                                                    <a href="<?php echo _WEB_ROOT ?>/edit-staff/<?= $StaffID ?>"
                                                        class="btn btn-warning"><i class="ti ti-edit"></i></a>
                                                    <?php if ($_SESSION['user']['StaffID'] == $StaffID): ?>
                                                        <button class="btn btn-danger" disabled><i class="ti ti-trash-off"></i></button>
                                                    <?php else: ?>
                                                        <a href="<?= _WEB_ROOT ?>/delete-staff/<?= $StaffID ?>"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')"
                                                            class="btn btn-danger"><i class=" ti ti-trash"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                } else {
                                    echo "<tr><td colspan='10'>Không có người dùng nào.</td></tr>";
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-5"></div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                        <ul class="pagination">
                            <?php if ($page > 1) { ?>
                                <li class="paginate_button previous"><a
                                        href="?page=<?= $page - 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>&search=<?= htmlspecialchars($search) ?>">Previous</a>
                                </li>
                            <?php } ?>
                            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                <li class="paginate_button <?= ($i == $page) ? 'active' : '' ?>"><a
                                        href="?page=<?= $i ?>&sort=<?= $sort ?>&order=<?= $order ?>&search=<?= htmlspecialchars($search) ?>"><?= $i ?></a>
                                </li>
                            <?php } ?>
                            <?php if ($page < $total_pages) { ?>
                                <li class="paginate_button next"><a
                                        href="?page=<?= $page + 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>&search=<?= htmlspecialchars($search) ?>">Next</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function (event) {
        var input, filter, table, tr, td0, td1, td2, td4, i, txtValue0, txtValue1, txtValue2, txtValue4;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementsByClassName("table align-middle")[0];
        tr = table.getElementsByTagName("tr");
        var urlParams = new URLSearchParams(window.location.search);
        var page = urlParams.get('page');
        var sort = urlParams.get('sort');
        var order = urlParams.get('order');

        for (i = 0; i < tr.length; i++) {
            td0 = tr[i].getElementsByTagName("td")[0]; // FullName
            td1 = tr[i].getElementsByTagName("td")[1]; // Email
            td2 = tr[i].getElementsByTagName("td")[2]; // PhoneNumber
            td4 = tr[i].getElementsByTagName("td")[4]; // Role
            if (td0 || td1 || td2 || td4) {
                txtValue0 = td0.textContent || td0.innerText;
                txtValue1 = td1.textContent || td1.innerText;
                txtValue2 = td2.textContent || td2.innerText;
                txtValue4 = td4.textContent || td4.innerText;
                if (txtValue0.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        // Update the URL with the search query
        var search = input.value;
        var newUrl = '?';
        if (page) {
            newUrl += 'page=' + page + '&';
        }
        if (sort) {
            newUrl += 'sort=' + sort + '&';
        }
        if (order) {
            newUrl += 'order=' + order + '&';
        }
        newUrl += 'search=' + search;
        window.history.pushState({ path: newUrl }, '', newUrl);
    });
</script>