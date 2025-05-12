<?php
$routes['default_controller'] = 'home';
$routes['trang-chu'] = 'home';
$routes['admin'] = 'dashboard';
$routes['dang-nhap'] = 'account/login';
$routes['dang-xuat'] = 'account/logout';
$routes['dang-nhap-admin'] = 'account/login_action';
/*
 *   duong dan ao => duong dan that
 */
//frontend
$routes['timeslots'] = 'booking/getTimeslots';
$routes['dat-lich-hen'] = 'booking/store';
$routes['search-booking'] = 'home/searchBooking';
$routes['cancel-booking'] = 'home/cancelBooking';
$routes['view-booking-form'] = 'home/viewBookingForm';
//backend
$routes['staff'] = 'staff/list_staff';
?>