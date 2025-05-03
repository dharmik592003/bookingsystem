<?php
//new site

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistraionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AssociateController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\StayController;
use App\Http\Controllers\YachtController;
use App\Http\Controllers\CharterController;
use Illuminate\Support\Facades\Route;


//login logout
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login_user', [LoginController::class, 'login_user'])->name('login_user');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::put('updateuser/{id}', [UserController::class, 'editprofile'])->name('update_profile');

//dashboard

Route::get(
    '/',
    [UserController::class, 'index']
)->name('dashboard');



// add services
Route::post(
    '/addservice',
    [ServiceController::class, 'store']
)->name('servicessave');

// Registration
Route::get(
    '/registration',
    [RegistraionController::class, 'index']
)->name('registration');
Route::post(
    '/saveuser',
    [RegistraionController::class, 'user']
)->name('register_user');
Route::post(
    '/addagency',
    [RegistraionController::class, 'addagency']
)->name('register_agency');

//add user by admin

Route::post(
    '/adduser',
    [UserController::class, 'store']
)->name('registration');


//route for agency
Route::get('/agency', [AgencyController::class, 'index'])->name('agency');
Route::get('/agency/{id}/edit', [AgencyController::class, 'edit'])->name('agency.edit');
Route::post('/agency', [AgencyController::class, 'store'])->name('agency.store');
Route::post('/agency/{id}/update', [AgencyController::class, 'update'])->name('agency.update');
Route::get('/agency/{id}/delete', [AgencyController::class, 'destroy'])->name('agency.delete');


//route for customer
Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
Route::post('/customer/{id}/update', [CustomerController::class, 'update'])->name('customer.update');
Route::get('/customer/{id}/delete', [CustomerController::class, 'destroy'])->name('customer.delete');

//service as admin
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
Route::post('/services/{id}/update', [ServiceController::class, 'update'])->name('services.update');
Route::get('/services/{id}/delete', [ServiceController::class, 'destroy'])->name('services.delete');






Route::get(
    'service/{name}',
    [ServiceController::class, 'getservice']
);
Route::get(
    'services/{category_name}/{service_name}',
    [ServiceController::class, 'getservice_user']
)->name('detailsservices');


// services of agency 
Route::get('/addserviceagency', [ServiceController::class, 'create']);
Route::get('{id}/editservices', [ServiceController::class, 'edit_agency_service'])->name('edit_agency_service');
Route::post('{id}/updateservices', [ServiceController::class, 'update_agency_service'])->name('update_agency_service');
Route::post('delete_agency_service/{ser_id}', [ServiceController::class, 'delete_agency_service'])->name('delete_agency_service');

Route::get(
    '/sendstates',
    [UserController::class, 'getstates']
)->name('sendstates');
Route::get(
    '/sendcategory',
    [ServiceController::class, 'getcategory']
)->name('sendcategory');
Route::get(
    '/sendcity',
    [UserController::class, 'getcity']
)->name('sendcity');



//route for roles
Route::prefix('Booking')->group(function () {
    Route::get('/', [BookingController::class, 'bookingspage'])->name('bookings.bookingspage');
    Route::get('/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

//routes for permissions
Route::get('/permission', [PermissionController::class, 'index'])->name('permission');
Route::get('/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
Route::post('/permission', [PermissionController::class, 'store'])->name('permission.store');
Route::post('/permission/{id}/update', [PermissionController::class, 'update'])->name('permission.update');
Route::get('/permission/{id}/delete', [PermissionController::class, 'destroy'])->name('permission.delete');


//route for roles
Route::get('/Role', [RoleController::class, 'index'])->name('Role');
Route::get('/Role/{id}/edit', [RoleController::class, 'edit'])->name('Role.edit');
Route::post('/Role', [RoleController::class, 'store'])->name('Role.store');
Route::post('/Role/{id}/update', [RoleController::class, 'update'])->name('Role.update');
Route::get('/Role/{id}/delete', [RoleController::class, 'destroy'])->name('Role.delete');

// Routes for Associate
Route::get('/Associate', [AssociateController::class, 'index'])->name('Associate.index');
Route::get('/Associate/{id}/edit', [AssociateController::class, 'edit'])->name('Associate.edit');
Route::post('/Associate', [AssociateController::class, 'store'])->name('Associate.store');
Route::post('/Associate/{id}/update', [AssociateController::class, 'update'])->name('Associate.update');
Route::get('/Associate/{id}/delete', [AssociateController::class, 'destroy'])->name('Associate.destroy');

//Routes for Sales
Route::get('/Sales', [SalesController::class, 'salesDashboard'])->name('Sales.index');
Route::get('/Sales/dashboard', [SalesController::class, 'salesDashboard'])->name('sales.dashboard');
Route::get('/Sales/{id}/edit', [SalesController::class, 'edit'])->name('Sales.edit');
Route::post('/Sales', [SalesController::class, 'store'])->name('Sales.store');
Route::post('/Sales/{id}/update', [SalesController::class, 'update'])->name('Sales.update');
Route::get('/Sales/{id}/delete', [SalesController::class, 'destroy'])->name('Sales.destroy');

// Sales Booking Routes
Route::prefix('Sales')->group(function () {
    Route::get('/bookings/create', [SalesController::class, 'createBooking'])->name('bookings.create');
    Route::post('/bookings', [SalesController::class, 'storeBooking'])->name('bookings.store');
    Route::get('/bookings/{id}', [SalesController::class, 'showBooking'])->name('bookings.show');
    Route::get('/bookings/{id}/edit', [SalesController::class, 'editBooking'])->name('bookings.edit');
    Route::put('/bookings/{id}', [SalesController::class, 'updateBooking'])->name('bookings.update');
    Route::delete('/bookings/{id}', [SalesController::class, 'destroyBooking'])->name('bookings.destroy');

    // Sales Service Routes
    Route::get('/services/create', [SalesController::class, 'createService'])->name('services.create');
    Route::post('/services', [SalesController::class, 'storeService'])->name('services.store');
    Route::get('/services/{id}', [SalesController::class, 'showService'])->name('services.show');
    Route::get('/services/{id}/edit', [SalesController::class, 'editService'])->name('services.edit');
    Route::put('/services/{id}', [SalesController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{id}', [SalesController::class, 'destroyService'])->name('services.destroy');
});



//Routes for Support
Route::get('/Support', [SupportController::class, 'index'])->name('Support.index');
Route::get('/Support/{id}/edit', [SupportController::class, 'edit'])->name('Support.edit');
Route::post('/Support', [SupportController::class, 'store'])->name('Support.store');
Route::post('/Support/{id}/update', [SupportController::class, 'update'])->name('Support.update');
Route::get('/Support/{id}/delete', [SupportController::class, 'destroy'])->name('Support.destroy');

//Routes for Privacy policy
Route::get('/Privacypolicy', [PrivacyPolicyController::class, 'index'])->name('PrivacyPolicy.index');
Route::get('/Privacypolicy/{id}/edit', [PrivacyPolicyController::class, 'edit'])->name('PrivacyPolicy.edit');
Route::post('/Privacypolicy', [PrivacyPolicyController::class, 'store'])->name('PrivacyPolicy.store');
Route::post('/Privacypolicy/{id}/update', [PrivacyPolicyController::class, 'update'])->name('PrivacyPolicy.update');
Route::get('/Privacypolicy/{id}/delete', [PrivacyPolicyController::class, 'destroy'])->name('PrivacyPolicy.destroy');

Route::get('{cat_id}/{ser_id}/{type_id}/{subser_id}/conformbooking', [PaymentController::class, 'conformbooking'])->name('conformbooking.index');
Route::get('{cat_id}/{ser_id}/{type_id}/{subser_id}/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::get('/payment/{id}/edit', [PaymentController::class, 'edit'])->name('payment.edit');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::post('/payment/{id}/update', [PaymentController::class, 'update'])->name('payment.update');
Route::get('/payment/{id}/delete', [PaymentController::class, 'destroy'])->name('payment.destroy');

// booking related 

//check avaiblity
Route::get(
    '/{serviceid}/{typeid}/availability',
    [BookingController::class, 'availability']
)->name('availability');



Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::get('{category_id}/{service_id}/book', [BookingController::class, 'store'])->name('book');
Route::post('/{id}/status', [BookingController::class, 'status'])->name('status');
Route::get('/cart', [BookingController::class, 'cart'])->name('cart');
Route::post('addtocart/{service_id}', [BookingController::class, 'addtocart'])->name('addtocart');
Route::post('{service_id}/removefromcart', [BookingController::class, 'removefromcart'])->name('removefromcart');

Route::post('/booking/update-availability', [BookingController::class, 'updateAvailability'])->name('booking.updateAvailability');

Route::get('/Requests', [RequestController::class, 'index'])->name('Request.index');
Route::get('/Requests/{id}/edit', [RequestController::class, 'edit'])->name('Request.edit');
Route::post('/Requests', [RequestController::class, 'store'])->name('Request.store');
Route::post('/Requests/{id}/update', [RequestController::class, 'update'])->name('Request.update');
Route::get('/Requests/{id}/delete', [RequestController::class, 'destroy'])->name('Request.destroy');
Route::get('/generatepdf', [PdfController::class, 'generatepdf'])->name('generatepdf');
Route::get('/viewinvoice', [PdfController::class, 'viewinvoice'])->name('viewinvoice');


//filteration on customer-services page to show filtered services
Route::get('/filterServices', [ServiceController::class, 'Servicefilter']);

Route::post('/send-otp', [PaymentController::class, 'sendotp'])->name('sendotp');
Route::post('/verify-otp', [PaymentController::class, 'verifyotp'])->name('verifyotp');

Route::get('/Cars', [CarsController::class, 'index'])->name('cars.index');
// Route::get('/Stays', [StayController::class, 'index'])->name('Stay.index');
// Route::get('/Yachts', [YachtController::class, 'index'])->name('Yacht.index');
// Route::get('/Charters', [ChartersController::class, 'index'])->name('charters.index');
Route::get('/stays', [StayController::class, 'index'])->name('stays.index');
Route::post('/stays', [StayController::class, 'store'])->name('stays.store');
Route::get('/stays/filter', [StayController::class, 'filter'])->name('stays.filter');
Route::get('/stays/{id}/edit', [StayController::class, 'edit'])->name('stays.edit');
Route::put('/stays/{id}/update', [StayController::class, 'update'])->name('stays.update');
Route::delete('/stays/{id}', [StayController::class, 'destroy'])->name('stays.destroy');

Route::get('/Cars', [CarsController::class, 'index'])->name('cars.index');
Route::post('/Cars', [CarsController::class, 'store'])->name('cars.store');
Route::get('/Cars/filter', [CarsController::class, 'filter'])->name('cars.filter');

Route::get('/Cars/{id}/edit', [CarsController::class, 'edit'])->name('cars.edit');
Route::put('/Cars/{id}/update', [CarsController::class, 'update'])->name('cars.update');
Route::delete('/Cars/{id}', [CarsController::class, 'destroy'])->name('cars.destroy');

Route::get('/Yacht', [YachtController::class, 'index'])->name('yachts.index');
Route::post('/Yacht', [YachtController::class, 'store'])->name('yachts.store');
Route::get('/Yacht/{id}/edit', [YachtController::class, 'edit'])->name('yachts.edit');
Route::put('/Yacht/{id}/update', [YachtController::class, 'update'])->name('yachts.update');
Route::delete('/Yacht/{id}', [YachtController::class, 'destroy'])->name('yachts.destroy');
Route::get('/yacht/filter', [YachtController::class, 'filter'])->name('yacht.filter');


Route::get('/Charter', [CharterController::class, 'index'])->name('charters.index');
Route::post('/Charter', [CharterController::class, 'store'])->name('charters.store');
Route::get('/Charter/{id}/edit', [CharterController::class, 'edit'])->name('charters.edit');
Route::put('/Charter/{id}/update', [CharterController::class, 'update'])->name('charters.update');
Route::delete('/Charter/{id}', [CharterController::class, 'destroy'])->name('charters.destroy');
Route::get('/charter/filter', [CharterController::class, 'filter'])->name('charter.filter');
