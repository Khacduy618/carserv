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
$routes['cancel-booking'] = 'booking/cancelBooking';
$routes['view-booking-form'] = 'home/viewBookingForm';
$routes['view-detail'] = 'booking/detail';
//backend
$routes['staff'] = 'staff/list_staff';
$routes['customer'] = 'customer';
$routes['car-detail'] = 'car/detail';

$routes['servicecategory'] = 'servicecategory';
$routes['servicecategory/add'] = 'servicecategory/add';
$routes['servicecategory/edit'] = 'servicecategory/edit';
$routes['servicecategory/delete'] = 'servicecategory/delete';
?>