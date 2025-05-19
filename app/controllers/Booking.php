<?php
namespace App\Controllers;

use Core\Controller;
use App\Controllers\MailServices;

class Booking extends Controller
{
    public $data = [];
    private $booking_model;
    private $service_model;

    private $mailer_service;

    private $timeslots_model;

    private $notification_model;

    public function __construct()
    {
        $this->mailer_service = new MailServices();
        $this->booking_model = $this->model('BookingModel');
        $this->service_model = $this->model('ServiceModel');
        $this->timeslots_model = $this->model('TimeSlotsModel');
        $this->notification_model = $this->model('NotificationModel');
    }

    // public function index()
    // {
    //     $this->data['content'] = 'frontend/trang-chu/trang-chu';
    //     $this->render('layouts/client_layout', $this->data);
    // }

    public function getTimeslots()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $date = $_POST['SlotDate'];
            $timeslots = $this->timeslots_model->getTimeslots($date);
            header('Content-Type: application/json');
            echo json_encode($timeslots);
        } else {
            // Handle the case where the request is not a POST request
            echo "Invalid request method";
        }
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the data from the form
            $customerName = $_POST['CustomerName'];
            $customerPhoneNumber = $_POST['CustomerPhoneNumber'];
            $customerEmail = $_POST['CustomerEmail'];
            $brand = $_POST['Brand'];
            $model = $_POST['Model'];
            $carYear = $_POST['CarYear'];
            $licensePlate = $_POST['LicensePlate'];
            $licensePlate = strtoupper(preg_replace("/[^a-zA-Z0-9]/", " ", $licensePlate));
            $serviceID = json_decode($_POST['ServiceID']);
            $bookingDate = $_POST['BookingDateTime'];
            $timeslotID = $_POST['SlotID'];
            $notes = $_POST['notes'];
            $VIN = $_POST['VIN'];
            $priceAtBooking = isset($_POST['priceAtBooking']);
            // Validate the data
            $errors = [];

            if (empty($customerName)) {
                $errors['customerName'] = 'Vui lòng nhập tên của bạn.';
            }

            if (empty($customerPhoneNumber)) {
                $errors['customerPhoneNumber'] = 'Vui lòng nhập số điện thoại của bạn.';
            } elseif (!preg_match('/^[0-9]{10}$/', $customerPhoneNumber)) {
                $errors['customerPhoneNumber'] = 'Số điện thoại không hợp lệ.';
            }

            if (empty($customerEmail)) {
                $errors['customerEmail'] = 'Vui lòng nhập email của bạn.';
            } elseif (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
                $errors['customerEmail'] = 'Email không hợp lệ.';
            }

            if (empty($brand)) {
                $errors['brand'] = 'Vui lòng nhập hãng xe.';
            }

            if (empty($model)) {
                $errors['model'] = 'Vui lòng nhập dòng xe.';
            }

            if (empty($carYear)) {
                $errors['carYear'] = 'Vui lòng nhập năm sản xuất xe.';
            } elseif (!preg_match('/^[0-9]{4}$/', $carYear)) {
                $errors['carYear'] = 'Năm sản xuất không hợp lệ.';
            }

            if (empty($licensePlate)) {
                $errors['licensePlate'] = 'Vui lòng nhập biển số xe.';
            }

            if (empty($serviceID)) {
                $errors['serviceID'] = 'Vui lòng chọn dịch vụ.';
            } elseif (!is_array($serviceID)) {
                $errors['serviceID'] = 'Dịch vụ không hợp lệ.';
            } else {
                foreach ($serviceID as $service) {
                    if (!is_numeric($service)) {
                        $errors['serviceID'] = 'Dịch vụ không hợp lệ.';
                        break;
                    }
                }
            }

            if (empty($bookingDate)) {
                $errors['bookingDateTime'] = 'Vui lòng chọn ngày.';
            } else {
                try {
                    $date = new \DateTime($bookingDate);
                } catch (\Exception $e) {
                    $errors['bookingDateTime'] = 'Ngày và giờ đặt lịch không hợp lệ.';
                }
            }

            if (empty($timeslotID)) {
                $errors['timeslotID'] = 'Vui lòng chọn khung giờ.';
            }

            if (empty($VIN)) {
                $errors['VIN'] = 'Vui lòng nhập VIN.';
            }

            if (!empty($errors)) {
                // Set an error message and redirect back to the booking form
                $_SESSION['flash_message'] = ['title' => 'Thông báo', 'type' => 'error', 'message' => implode('<br>', $errors)];
                header('Location: ' . _WEB_ROOT . '/trang-chu');
                exit();
            }
            $timeslot = $this->timeslots_model->findbyId($timeslotID);
            // Create a booking code
            $bookingCode = 'BK' . date('YmdHis') . rand(0, 9999);

            // Check if LicensePlate exists
            $existingCar = $this->booking_model->getCarByLicensePlate($licensePlate);

            if ($existingCar) {
                // Use existing CarID
                $carID = $existingCar['CarID'];
            } else {
                // Prepare car data
                $carData = [
                    'LicensePlate' => $licensePlate,
                    'Brand' => $brand,
                    'Model' => $model,
                    'CarYear' => $carYear,
                    'VIN' => $VIN
                ];

                // Create car and get CarID
                $carID = $this->booking_model->createCar($carData);
            }

            // Store total price in session
            if (isset($_POST['totalPrice'])) {
                $_SESSION['totalPrice'] = $_POST['totalPrice'];
            }

            // Prepare the data for the database
            $data = [
                'BookingCode' => $bookingCode,
                'CustomerName' => $customerName,
                'CustomerPhoneNumber' => $customerPhoneNumber,
                'CustomerEmail' => $customerEmail,
                'CarID' => $carID,
                'TotalPrice' => $_SESSION['totalPrice'],
                'BookingDate' => $bookingDate,
                'Time' => $timeslot['StartTime'],
                'Notes' => $notes,
                'StatusID' => 1, // Default status is Pending
            ];

            // Create the booking in the database
            $bookingID = $this->booking_model->store_id($data);

            // Update timeslot
            $this->timeslots_model->updateTimeslot($timeslotID);

            // Handle selected services
            if (!empty($serviceID)) {
                foreach ($serviceID as $service) {
                    // Prepare data for bookingservices table
                    $bookingServiceData = [
                        'BookingID' => $bookingID,
                        'ServiceID' => $service,
                        'PriceAtBooking' => $_POST['priceAtBooking'][$service],
                    ];
                    // Create booking service entry
                    $this->booking_model->create_bookingSer($bookingServiceData);
                }
            }

            if ($bookingID) {
                $to = $customerEmail;
                $subject = "Thông báo dịch vụ Carserv";
                $body = "<div style=\"font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;\">
                            <div style=\"max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 20px;\">
                                <h2 style=\"color: #fd4f0d; text-align: center;\">Lịch hẹn của bạn đã được ghi nhận</h2>
                                <p>Xin chào <strong>$customerName</strong>,</p>";
                $body .= "<p>Cảm ơn bạn đã gửi yêu cầu. Chúng tôi xin thông báo rằng lịch hẹn của bạn đã được ghi nhận. Vui lòng xem chi tiết bên dưới:</p>";
                $body .= "<div style=\"display: flex; flex-direction: row; \">
                                <div style=\"flex: 0 0 auto; width: 50%;\">
                                    <p><strong>Mã booking:</strong> " . $bookingCode . "</p></div>
                                <div style=\"flex: 0 0 auto; width: 50%;\">
                                    <p><strong>Ngày giờ hẹn:</strong> " . $timeslot['StartTime'] . " - " . $timeslot['EndTime'] . ", " . $bookingDate . " </p>
                                </div>
                            </div>";
                $body .= "<div style=\"display: flex; flex-direction: row; \">";
                $body .= "<div style=\"flex: 0 0 auto; width: 50%;\">";
                $body .= "<p><strong>Thông tin người đăng ký:</strong></p>";
                $body .= "<p style=\"font-size: 14px; color: #555;\"><strong>Tên:</strong> " . $customerName . "</p>";
                $body .= "<p style=\"font-size: 14px; color: #555;\"><strong>Số điện thoại:</strong> " . $customerPhoneNumber . "</p>";
                $body .= "<p style=\"font-size: 14px; color: #555;\"><strong>Email:</strong> " . $customerEmail . "</p>";
                $body .= "</div>";
                $body .= "<div style=\"flex: 0 0 auto; width: 50%; margin-left: auto !important;\">";
                $body .= "<p><strong>Thông tin xe:</strong></p>";
                $body .= "<p style=\"font-size: 14px; color: #555;\"><strong>Hãng xe:</strong> " . $brand . "</p>";
                $body .= "<p style=\"font-size: 14px; color: #555;\"><strong>Dòng xe:</strong> " . $model . "</p>";
                $body .= "<p style=\"font-size: 14px; color: #555;\"><strong>Năm sản xuất:</strong> " . $carYear . "</p>";
                $body .= "<p style=\"font-size: 14px; color: #555;\"><strong>Biển số xe:</strong> " . $licensePlate . "</p>";
                $body .= "</div>";
                $body .= "</div>";
                $body .= "<p><strong>Thông tin dịch vụ:</strong></p><p>";

                $serviceData = [];
                $serviceList = '';
                foreach ($serviceID as $service) {
                    $serviceData = $this->service_model->findbyId($service);
                    $serviceList .= "- " . $serviceData['ServiceName'] . " (" . number_format($serviceData['BasePrice'], 0, ',', '.') . " VNĐ) <br>";
                }
                $body .= $serviceList;
                $body .= "</p><p><strong>Tổng giá:</strong> " . number_format($_SESSION['totalPrice'], 0, ',', '.') . " VNĐ</p>";
                $body .= "<p>Chúng tôi luôn sẵn sàng hỗ trợ bạn!</p>";
                $body .= "<div style=\"margin-top: 20px;\">";
                $body .= "<p style=\"font-size: 14px; color: #555;\">Trân trọng,<br><strong>Đội ngũ Carserv</strong></p>";
                $body .= "<p style=\"font-size: 14px; color: #888;\">Địa chỉ: 84 Nguyễn Hữu Dật, Hải Châu, Đà Nẵng, Việt Nam<br>";
                $body .= "Email: info@carserv.com<br>";
                $body .= "Điện thoại: 0932105214</p>";
                $body .= "</div>";
                $body .= "<hr style=\"border: 0; border-top: 1px solid #eee; margin: 20px 0;\">";
                $body .= "<p style=\"text-align: center; font-size: 12px; color: #aaa;\">© 2024 Carserv. Tất cả các quyền được bảo lưu.</p>";
                $body .= "</div>";
                $body .= "</div>";

                $this->mailer_service->sendEmail($to, $subject, $body);

                // Create notification entry
                $notificationData = [
                    'RecipientEmail' => $customerEmail,
                    'RecipientPhoneNumber' => $customerPhoneNumber,
                    'BookingID' => $bookingID,
                    'Subject' => $subject,
                    'Message' => html_entity_decode($body, ENT_QUOTES, 'UTF-8'),
                    'Type' => 'Email',
                    'Status' => 'Sent',
                    'SentAt' => date('Y-m-d H:i:s'),
                    'CreatedAt' => date('Y-m-d H:i:s'),
                ];

                $this->notification_model->store($notificationData);

                // Set a success message and redirect to a success page
                $_SESSION['flash_message'] = ['title' => 'Thông báo', 'type' => 'success', 'message' => 'Đặt lịch thành công!'];
                header('Location: ' . _WEB_ROOT . '/trang-chu');
                exit();
            } else {
                // Set an error message and redirect back to the booking form
                $_SESSION['flash_message'] = ['title' => 'Thông báo', 'type' => 'error', 'message' => 'Đặt lịch thất bại!'];
                header('Location: ' . _WEB_ROOT . '/trang-chu');
                exit();
            }
        } else {
            // Redirect to the booking form
            header('Location: ' . _WEB_ROOT . '/trang-chu');
            exit();
        }
    }

    public function cancelBooking($bookingCode)
    {
        // TODO: Verify cancellation token from email

        // Update booking status to "Cancelled" (StatusID = 5)
        $data = ['StatusID' => 5];
        $this->booking_model->updateBookingStatus($bookingCode, $data);

        // Redirect to search results page
        header('Location: ' . _WEB_ROOT . '/search-booking?customerName=' . urlencode($_SESSION['customerName']) . '&license_plate=' . urlencode($_SESSION["license_plate"]));
        exit();
    }

    public function detail($bookingCode)
    {
        // echo "Booking Code: " . $bookingCode . "<br>"; // Debugging

        $booking = $this->booking_model->getBookingDetails($bookingCode);
        $bookingServices = $this->booking_model->getBookingServices($bookingCode);

        if ($booking) {
            // echo "Booking Data: <pre>";
            // print_r($booking);

            // echo "</pre>"; // Debugging
            $this->data['sub_content']['booking'] = $booking;
            $this->data['sub_content']['bookingServices'] = $bookingServices;
            $this->data['content'] = 'frontend/booking/detail';
            $this->render('layouts/client_layout', $this->data);
        } else {
            // Handle the case where the booking is not found
            echo "Booking not found.";
        }
    }

    // public function success()
    // {
    //     $this->data['content'] = 'frontend/trang-chu/success';
    //     $this->render($this->data);
    // }
}
