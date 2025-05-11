<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-6 py-5">
                <div class="py-5">
                    <h1 class="text-white mb-4">Certified and Award Winning Car Repair Service Provider</h1>
                    <p class="text-white mb-0">Eirmod sed tempor lorem ut dolores. Aliquyam sit sadipscing kasd
                        ipsum. Dolor ea et dolore et at sea ea at dolor, justo ipsum duo rebum sea invidunt
                        voluptua. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo invidunt lorem. Elitr
                        ut dolores magna sit. Sea dolore sanctus sed et. Takimata takimata sanctus sed.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn"
                    data-wow-delay="0.6s">
                    <h1 class="text-white mb-4">Book For A Service</h1>
                    <form action="dat-lich-hen" method="POST">
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0"
                                    placeholder="Họ tên khách hàng (Bắt buộc)" style="height: 55px;"
                                    name="CustomerName">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0" placeholder="Số điện thoại (Bắt buộc)"
                                    style="height: 55px;" name="CustomerPhoneNumber">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" class="form-control border-0" placeholder="Địa chỉ Email (Bắt buộc)"
                                    style="height: 55px;" name="CustomerEmail">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0" placeholder="Mã VIN (Bắt buộc)"
                                    style="height: 55px;" name="VIN">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0" placeholder="Hãng xe (Bắt buộc)"
                                    style="height: 55px;" name="Brand">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0" placeholder="Dòng xe (Bắt buộc)"
                                    style="height: 55px;" name="Model">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="number" class="form-control border-0" placeholder="Đời xe (Bắt buộc)"
                                    style="height: 55px;" name="CarYear">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0" placeholder="Biển số (Bắt buộc)"
                                    style="height: 55px;" name="LicensePlate">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" name="notes"
                                    id="notes">Ghi chú thêm (Tùy chọn)</textarea>
                            </div>
                            <div class="col-12 col-sm-6">
                                <a class="btn form-control" data-bs-toggle="modal" data-bs-target="#serviceModal">
                                    Chọn dịch vụ <br> (có thể chọn nhiều)
                                </a>
                                <input type="hidden" name="ServiceID" id="selectedServices">

                                <!-- Modal -->
                                <div class="modal fade" id="serviceModal" tabindex="-1"
                                    aria-labelledby="serviceModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header mb-0">
                                                <h5 class="modal-title" id="serviceModalLabel">Chọn dịch vụ</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body mt-0">
                                                <?php global $serviceCategories; ?>
                                                <div class="row">
                                                    <?php foreach ($serviceCategories as $category): ?>
                                                        <div class="container border-top-2 ">
                                                            <div class="row position-filter-container">
                                                                <div class="filter-label col-2">
                                                                    <?= $category['CategoryName']; ?>
                                                                </div>

                                                                <div class="col-10">
                                                                    <div class="search-select-wrapper">
                                                                        <div class="custom-input-with-tag">
                                                                            <span class="search-icon"><i
                                                                                    class="fas fa-search"></i></span>
                                                                            <div class="selected-tag-inside me-2">
                                                                                Analysis <i
                                                                                    class="fas fa-times remove-tag ms-1"></i>
                                                                            </div>
                                                                            <div class="selected-tag-inside me-2">
                                                                                Analysis <i
                                                                                    class="fas fa-times remove-tag ms-1"></i>
                                                                            </div>
                                                                            <div class="selected-tag-inside me-2">
                                                                                Analysis <i
                                                                                    class="fas fa-times remove-tag ms-1"></i>
                                                                            </div>
                                                                            <input type="text"
                                                                                class="form-control-plaintext"
                                                                                placeholder="">
                                                                            <span class="dropdown-arrow"><i
                                                                                    class="fas fa-chevron-down"></i></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="checkbox-options">
                                                                        <div class="row">
                                                                            <?php $services = getServicesByCategory($category['CategoryID']);
                                                                            foreach ($services as $service): ?>
                                                                                <div class="col-md-6 col-6">
                                                                                    <div class="form-check">
                                                                                        <input
                                                                                            class="form-check-input service-checkbox"
                                                                                            type="checkbox"
                                                                                            value="<?php echo $service['ServiceID']; ?>"
                                                                                            id="service<?php echo $service['ServiceID']; ?>">
                                                                                        <label class="form-check-label"
                                                                                            for="service<?php echo $service['ServiceID']; ?>"><?php echo $service['ServiceName']; ?>
                                                                                            <br>
                                                                                            (<?php echo number_format($service['BasePrice'], 0, ',', '.') . ' VNĐ'; ?>)
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                            <div
                                                                                class="col-md-4 col-12 text-md-start text-start mt-md-0 mt-2">
                                                                                <!-- Căn chỉnh See all -->
                                                                                <a href="#" class="see-all-link">See all <i
                                                                                        class="fas fa-chevron-down fa-xs"></i></a>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>

                                                </div>
                                            </div>
                                            <div id="totalPriceDisplay"
                                                style="color: black; font-size: 1.2em; margin-top: 10px;">
                                                Tổng tiền: 0 VNĐ
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="button" class="btn btn-primary"
                                                    id="saveServices">Lưu</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function () {
                                        let selectedServicePrices = {};

                                        const updateTotalPrice = () => {
                                            let totalPrice = 0;
                                            $('.service-checkbox:checked').each(function () {
                                                const serviceId = $(this).val();
                                                totalPrice += selectedServicePrices[serviceId] || 0;
                                            });
                                            $('#totalPriceDisplay').text('Tổng tiền: ' + totalPrice.toLocaleString('vi-VN') + ' VNĐ');
                                        };

                                        <?php
                                        global $serviceCategories;
                                        function getServicesByCategory($categoryID)
                                        {
                                            $serviceModel = new \App\Models\ServiceModel();
                                            return $serviceModel->getServicesByCategory($categoryID);
                                        }
                                        foreach ($serviceCategories as $category) {
                                            $services = getServicesByCategory($category['CategoryID']);
                                            foreach ($services as $service) {
                                                echo "selectedServicePrices['" . $service['ServiceID'] . "'] = " . $service['BasePrice'] . ";";
                                            }
                                        }
                                        ?>

                                        const checkboxes = $('.service-checkbox');
                                        const selectedServicesInput = $('#selectedServices');
                                        const saveServicesButton = $('#saveServices');
                                        const serviceModal = new bootstrap.Modal($('#serviceModal')[0]);

                                        $('.service-checkbox').on('change', function () {
                                            updateTotalPrice();
                                        });

                                        saveServicesButton.on('click', function () {
                                            const selectedServiceIDs = checkboxes.filter(':checked').map(function () {
                                                return this.value;
                                            }).get();

                                            selectedServicesInput.val(JSON.stringify(selectedServiceIDs));
                                            let totalPrice = 0;
                                            let priceAtBooking = {};
                                            $('.service-checkbox:checked').each(function () {
                                                const serviceId = $(this).val();
                                                totalPrice += selectedServicePrices[serviceId] || 0;
                                                priceAtBooking[serviceId] = selectedServicePrices[serviceId] || 0;
                                            });
                                            $('#totalPrice').val(totalPrice);
                                            // Create hidden input for each service's price
                                            for (const serviceId in priceAtBooking) {
                                                $('<input>').attr({
                                                    type: 'hidden',
                                                    name: 'priceAtBooking[' + serviceId + ']',
                                                    value: priceAtBooking[serviceId]
                                                }).appendTo('form');
                                            }

                                            console.log(
                                                'Sending AJAX request:', selectedServicesInput
                                            );
                                            serviceModal.hide();
                                        });

                                        updateTotalPrice();
                                    });
                                </script>


                            </div>
                            <div class="col-12 col-sm-6">
                                <a class="btn form-control" data-bs-toggle="modal" data-bs-target="#dateModal">
                                    Đặt lịch hẹn <br> (Chọn khung giờ)
                                </a>
                                <input type="hidden" name="BookingDateTime" id="selectedDateTime">
                            </div>
                            <!-- Date Modal -->
                            <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="dateModalLabel">Chọn ngày hẹn</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="date" class="form-control" id="bookingDate"
                                                placeholder="Chọn ngày hẹn" name="bookingDate">

                                            <div id="availableTimeslots">
                                            </div>
                                            <input type="hidden" name="SlotID" id="selectedTimeslot">
                                        </div>
                                        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                                        <script>
                                            flatpickr("#bookingDate", {
                                                dateFormat: "Y-m-d",
                                            });
                                        </script>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                            <button type="button" class="btn btn-primary" id="saveDateTime">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                                <script>

                                </script>
                            </div>
                            <div class="col-12">
                                <input type="hidden" name="totalPrice" id="totalPrice">
                                <button class="btn btn-secondary w-100 py-3" type="submit">Book
                                    Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>