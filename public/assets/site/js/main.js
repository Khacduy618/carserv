(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').css('top', '0px');
        } else {
            $('.sticky-top').css('top', '-100px');
        }
    });


    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";

    $(window).on("load resize", function () {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
                function () {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function () {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Date and time picker
    $('.date').datetimepicker({
        format: 'L'
    });
    $('.time').datetimepicker({
        format: 'LT'
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 25,
        dots: true,
        loop: true,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });
    // document.addEventListener('DOMContentLoaded', function () {
    //     const checkboxes = document.querySelectorAll('.service-checkbox');
    //     const selectedServicesInput = document.getElementById('selectedServices');
    //     const saveServicesButton = document.getElementById('saveServices');
    //     const serviceModal = new bootstrap.Modal(document.getElementById('serviceModal'));

    //     saveServicesButton.addEventListener('click', function () {
    //         const selectedServiceIDs = Array.from(checkboxes)
    //             .filter(checkbox => checkbox.checked)
    //             .map(checkbox => checkbox.value);

    //         selectedServicesInput.value = JSON.stringify(selectedServiceIDs);
    //         serviceModal.hide();
    //     });
    // });

})(jQuery);

$(document).ready(function () {
    const bookingDateInput = $('#bookingDate');
    const availableTimeslotsDiv = $('#availableTimeslots');
    const selectedDateTimeInput = $('#selectedDateTime');
    const selectedTimeSlotInput = $('#selectedTimeslot');

    const dateModal = new bootstrap.Modal($('#dateModal')[0]);
    const saveDateTimeButton = $('#saveDateTime');

    bookingDateInput.on('change', function () {
        const selectedDate = this.value;
        console.log('Selected date:', selectedDate);
        console.log('Sending AJAX request:', {
            url: _WEB_ROOT + '/timeslots',
            SlotDate: selectedDate
        });
        // Fetch timeslots for the selected date (replace with your actual API endpoint)
        $.ajax({
            url: _WEB_ROOT + '/timeslots',
            method: 'POST',
            data: { SlotDate: selectedDate },
            dataType: 'json',
            success: function (timeslots) {
                let timeslotsHTML = '';
                if (timeslots.length > 0) {
                    timeslotsHTML += `<h3 class="main-title mt-2">Khung giờ</h3>
                    <div class="list-group list-group-flush">`;
                    timeslots.forEach(timeslot => {
                        timeslotsHTML += `
                        <label class="workspace-item list-group-item-action" for="ws-newyork">
                            <input class="form-check-input" type="radio" name="timeslot" value="${timeslot.SlotID}" id="timeslot${timeslot.SlotID}" ${timeslot.IsAvailable == 0 && timeslot.MaxCapacity == timeslot.BookedCount ? 'disabled' : ''}>
                            <label class="form-check-label d-flex w-100" for="timeslot${timeslot.SlotID}">
                            <div class="workspace-details ms-0">
                            <span class="workspace-name">${timeslot.StartTime} - ${timeslot.EndTime}</span>
                            </div>
                            <span class="workspace-plan plan-enterprise ms-auto"><span class="plan-dot"></span>(Đã đặt: ${timeslot.BookedCount}/${timeslot.MaxCapacity})</span>
                            </label>
                        </label>
                    `;
                    });
                    timeslotsHTML += `</div>`;
                } else {
                    timeslotsHTML = '<p>Không có khung giờ trống cho ngày này.</p>';
                }
                availableTimeslotsDiv.html(timeslotsHTML);
            },
            error: function (error) {
                console.error('Error fetching timeslots:', error);
                availableTimeslotsDiv.html('<p>Lỗi khi tải khung giờ.</p>');
            }
        });
    });

    saveDateTimeButton.on('click', function () {
        const selectedTimeslot = $('input[name="timeslot"]:checked');
        const selectedDate = document.getElementById('bookingDate').value;
        if (selectedTimeslot.length > 0) {
            selectedDateTimeInput.val(selectedDate);
            selectedTimeSlotInput.val(selectedTimeslot.val());
            console.log(
                'Sending AJAX request:', {
                date: selectedDateTimeInput,
                timeslot: selectedTimeSlotInput,
            }
            );
            dateModal.hide();
        } else {
            alert('Vui lòng chọn một khung giờ.');
        }
    });
});
