<?php

defined('BASEPATH') OR exit('No direct script access allowed');



// b2c Frontend Routes
$route['default_controller'] = "B2C";
$route['b2c/attraction'] = "B2C/attraction";
$route['b2c/attraction/(:num)'] = "B2C/attraction/$1";
$route['b2c/attraction/types'] = "B2C/transport_types";
$route['b2c/attraction-package/process-booking'] = "B2C/booking_process";
$route['b2c/attraction-package/process-booking/(:num)'] = "B2C/booking_process/$1";
$route['b2c/top-tours/process-booking'] = "B2C/booking_process";
$route['b2c/top-tours/process-booking/(:num)'] = "B2C/booking_process/$1";
$route['b2c/packages/process-booking/(:num)'] = "B2C/booking_process/$1";

$route['b2c/booking/process-checkout'] = "B2C/process_checkout";

$route['b2c/transportation'] = "B2C/transportation";
$route['b2c/transportation/(:num)'] = "B2C/transportation/$1";
$route['b2c/transportations/types'] = "B2C/transport_types";
$route['b2c/transportation-package/process-booking'] = "B2C/booking_process";
$route['b2c/transportation-package/process-booking/(:num)'] = "B2C/booking_process/$1";
$route['b2c/booking-confirm'] = "B2C/booking_checkout";


$route['B2C/fliter_services'] = "B2C/fliter_services";
$route['b2c/fliter_services'] = "B2C/fliter_services";
$route['about-us'] = "B2C/about";
$route['blog-detail'] = "B2C/blog_detail";
$route['blogs'] = "B2C/blogs";
$route['gallery'] = "B2C/gallary";
$route['contact'] = "B2C/contact";
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;
$route['home'] = "B2C/home";

/*********** USER DEFINED ROUTES *******************/


$route['admin'] = "login";
$route['admin/login'] = "login";
$route['loginMe'] = "login/loginMe";


$route['dashboard'] = "User";
$route['admin/dashboard'] = "User";
$route['agent/dashboard'] = "User";
$route['users/dashboard'] = "User";

// $route['users/sign-up'] = "Login/newSignUpUser";

$route['logout'] = "User/logout";
$route['userListing'] = "User/userListing";
$route['userListing/(:num)'] = "User/userListing/$1";
$route['addNew'] = "User/addNew";
$route['addNewUser'] = "User/addNewUser";
$route['editOld'] = "User/editOld";
$route['editOld/(:num)'] = "User/editOld/$1";
$route['editUser'] = "User/editUser";
$route['deleteUser'] = "User/deleteUser";
$route['profile'] = "User/profile";
$route['profile/(:any)'] = "User/profile/$1";
$route['profileUpdate'] = "User/profileUpdate";
$route['profileUpdate/(:any)'] = "User/profileUpdate/$1";

$route['loadChangePass'] = "User/loadChangePass";
$route['changePassword'] = "User/changePassword";
$route['changePassword/(:any)'] = "User/changePassword/$1";
$route['pageNotFound'] = "User/pageNotFound";
$route['checkEmailExists'] = "User/checkEmailExists";
$route['login-history'] = "User/loginHistoy";
$route['login-history/(:num)'] = "User/loginHistoy/$1";
$route['login-history/(:num)/(:num)'] = "User/loginHistoy/$1/$2";

$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

$route['roleListing'] = "Roles/roleListing";
$route['roleListing/(:num)'] = "Roles/roleListing/$1";
$route['roleListing/(:num)/(:num)'] = "Roles/roleListing/$1/$2";
$route['deleteRole'] = "Roles/roleDelete";



// Services routes
$route['services'] = "AllService";
$route['services/listing'] = "AllService/listing";
$route['package-type/list'] = "AllService/listing";
$route['package-type/list/(:num)'] = "AllService/listing/$1";
$route['services/add'] = "AllService/add";
$route['services/add_new'] = "AllService/addNew";
$route['services/edit'] = "AllService/edit";
$route['services/edit_service'] = "AllService/editService";

$route['common_delete'] = "AllService/commonDelete";

// Category routes
$route['category'] = "Category";


// subcategory routes
$route['packages'] = "SubCategory";
$route['packages/listing/(:num)'] = "SubCategory/subcategoryListing/$1";
$route['packages/listing'] = "SubCategory/subcategoryListing";
$route['packages/add'] = "SubCategory/add";
$route['packages/add_new'] = "SubCategory/addNew";
$route['packages/edit'] = "SubCategory/edit";
$route['packages/edit_existing'] = "SubCategory/editExisting";

// Product routes
$route['products'] = "Products";


// Suppliers
$route['suppliers'] = "Supplier";
$route['supplier-add'] = "Supplier/supplierAdd";
$route['supplier-edit/(:num)'] = "Supplier/supplierEdit/$1";
$route['supplier-update'] = "Supplier/supplierUpdate";
$route['supplier-listing'] = "Supplier/supplierList";
$route['supplier-listing/(:num)'] = "Supplier/supplierList/$1";
$route['supplier-bookings'] = "Supplier/supplierBookings";

// Prices
$route['prices'] = "Prices";
$route['listing'] = "Prices/listing";
$route['listing/(:any)'] = "Prices/listing/$1";
$route['prices/add'] = "Prices/add";
$route['prices/edit/(:num)'] = "Prices/edit/$1";

// Tax
$route['sales-tax'] = "Tax";
$route['tax-listing'] = "Tax/listing";
$route['tax-listing/(:any)'] = "Tax/listing/$1";
$route['sales-tax/add'] = "Tax/add";
$route['sales-tax/edit/(:num)'] = "Tax/edit/$1";

//Bookings 
$route['booking'] = "Booking/bookingListing";
$route['booking/(:num)'] = "Booking/bookingListing/$1";
$route['booking/bookingListing'] = "Booking/bookingListing";
$route['booking/add'] = "Booking/bookingNew";
$route['booking/edit-booking'] = "Booking/edit";
$route['booking/update'] = "Booking/update";
$route['booking/addNewBooking'] = "Booking/addNewBooking";
$route['booking/view-more'] = "Booking/load_more";
$route['booking/updateTransaction'] = "Booking/updateTransaction";
$route['booking/confirm-booking'] = "Booking/confirmBooking";
$route['booking/cancel-booking'] = "Booking/booking_cancel";

$route['booking/exportToExcel'] = "DataExport/index";
$route['booking/exportToPDF'] = "DataExport/downloadAllBookingPDF";
$route['booking/sendBookingPDF'] = "DataExport/sendBookingPDFToWhatsApp";

// General 
$route['web-settings'] = "MyWebSettings";
$route['web-settings/listing'] = "MyWebSettings/listing";
$route['web-settings/listing/(:any)'] = "MyWebSettings/listing/$1";

// admin/contact-us 
$route['admin/contact-us'] = "Contact";
$route['admin/contact-us/(:num)'] = "Contact/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */
