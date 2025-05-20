<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="row frmtitle">
                <h1>Cập nhật thông tin nhân viên</h1>
            </div>

            ?>
            <div class="row frmcontent">
                <form action="<?= _WEB_ROOT ?>/update-staff" method="post">
                    <input type="hidden" name="id" value="<?= $user['StaffID'] ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="<?= $user['Username'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname"
                            value="<?= $user['FullName'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['Email'] ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="<?= $user['PhoneNumber'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Quyền</label>
                        <select class="form-select" id="role" name="role">
                            <option value="Staff" <?= ($user['Role'] == 'Staff') ? 'selected' : '' ?>>Nhân viên</option>
                            <option value="Admin" <?= ($user['Role'] == 'Admin') ? 'selected' : '' ?>>Quản trị viên
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="<?= _WEB_ROOT ?>/staff" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</div>