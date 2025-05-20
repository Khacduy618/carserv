<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="row frmtitle">
                <h1>Thêm mới nhân viên</h1>
            </div>
            <div class="row frmcontent">
                <form action="<?= _WEB_ROOT ?>/store-staff" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Quyền</label>
                        <select class="form-select" id="role" name="role">
                            <option value="Staff">Nhân viên</option>
                            <option value="Admin">Quản trị viên</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                    <a href="<?= _WEB_ROOT ?>/staff" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</div>