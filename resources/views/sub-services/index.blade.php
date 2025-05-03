

@if (Session::get('customer_id') == 1)
@include('admin.sub_service_rental_admin')
@elseif(Session::get('customer_id') == 2)
@include('user.sub_service_rental_customer')
@elseif(Session::get('customer_id') == 3)
@include('agency.sub_service_rental_agency')
@endif

