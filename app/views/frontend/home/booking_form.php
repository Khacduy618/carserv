<div class="pc-container">
    <div class="pc-content container mt-4">
        <div class="row">
            <div class="row frmtitle">
                <h1><?= $title ?></h1>
            </div>

            <div class="row frmcontent">
                <form action="<?= _WEB_ROOT ?>/search-booking" method="post">
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Tên khách hàng</label>
                        <input type="text" class="form-control" id="customerName" name="customerName" required>
                    </div>
                    <div class="mb-3">
                        <label for="licensePlate" class="form-label">Biển số xe</label>
                        <input type="text" class="form-control" id="licensePlate" name="license_plate" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </div>
</div>