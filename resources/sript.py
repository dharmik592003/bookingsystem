import os
import shutil

# Define current and new base paths
current_base = "D:\PROJECTS\laravel\\bookingsystem\\resources\\views"
new_base = "D:\PROJECTS\laravel\\bookingsystem\\resources\\views/professional_views_structure"

# Mapping old files to new locations
file_mappings = {
    "admin/dashboard.blade.php": "admin/dashboard.blade.php",
    "admin/Services-admin.blade.php": "admin/services.blade.php",
    "admin/sub_service_rental_admin.blade.php": "admin/sub-service-rental.blade.php",
    "admin/request-admin.blade.php": "admin/request-list.blade.php",
    "admin/layout.blade.php": "layouts/admin-layout.blade.php",

    "agency/dashboard.blade.php": "agency/dashboard.blade.php",
    "agency/addservices.blade.php": "agency/add-services.blade.php",
    "agency/Services-agency.blade.php": "agency/services.blade.php",
    "agency/sub_service_rental_agency.blade.php": "agency/sub-service-rental.blade.php",
    "agency/request-customer.blade.php": "agency/request-list.blade.php",
    "agency/layout.blade.php": "layouts/agency-layout.blade.php",

    "user/dashboard.blade.php": "user/dashboard.blade.php",
    "user/CustomerList.blade.php": "user/customer-list.blade.php",
    "user/Services-customer.blade.php": "user/services.blade.php",
    "user/sub_service_rental_customer.blade.php": "user/sub-service-rental.blade.php",
    "user/request-customer.blade.php": "user/request-list.blade.php",
    "user/layout.blade.php": "layouts/user-layout.blade.php",

    "auth/LoginPage.blade.php": "auth/login.blade.php",
    "auth/RegistrationForm.blade.php": "auth/register.blade.php",

    "booking/Bookingpage.blade.php": "booking/booking-page.blade.php",
    "booking/Cart.blade.php": "booking/cart.blade.php",

    "services/Services.blade.php": "services/services-list.blade.php",
    "services/subservices.blade.php": "services/sub-service-list.blade.php",
    "services/subservicerental.blade.php": "services/sub-service-rental.blade.php",
    "services/ServiceRequests.blade.php": "admin/service-requests.blade.php",

    "Car-rentals.blade.php": "car-rentals/car-rentals.blade.php",
    "index.blade.php": "pages/home.blade.php",

    # Components
    "components/navbar.blade.php": "components/navbar/navbar-admin.blade.php",
    "components/navbar-customer.blade.php": "components/navbar/navbar-customer.blade.php",
    "components/agency-admin.blade.php": "components/navbar/navbar-agency.blade.php",

    "components/sidebar.blade.php": "components/sidebar/sidebar-admin.blade.php",
    "components/sidebar-agency.blade.php": "components/sidebar/sidebar-agency.blade.php",
    "components/sidebar-customer.blade.php": "components/sidebar/sidebar-customer.blade.php",

    "components/footer.blade.php": "components/footer.blade.php",
    "components/bill.blade.php": "components/bill.blade.php",
    "components/disabledates.html": "components/disable-dates.blade.php",
    "layout/layout.blade.php": "layouts/app-layout.blade.php"
}

# Create directories and move files
for old_path, new_path in file_mappings.items():
    src = os.path.join(current_base, old_path)
    dest = os.path.join(new_base, new_path)

    os.makedirs(os.path.dirname(dest), exist_ok=True)
    if os.path.exists(src):
        shutil.copy(src, dest)

print("Files have been restructured according to the professional standard.")
