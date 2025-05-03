<form class="form-control"
    action="{{ route('payment.index', [$services->category->id, $services->id, $services->type->id, $stay->id]) }}"
    method="get">
    <div class="text-center mb-4">
        <img src="{{ asset('img/Group 1.svg') }}" alt="Loux Ibiza Logo">
    </div>
    <div class="form">
        <h1>Book Your Service at</h1>
        <div class="row">
            <div class="col-xl-6">
                <div class="agency-name">
                    <h2>{{ $services->agency->name }}</h2>
                </div>
            </div>
            <div class="col-xl-6 p-0 align-content-center">
                <div class="agency-name d-flex align-items-center justify-content-between">
                    <p class="m-0">{{ $services->agency->city->name }}</p>
                    <p class="m-0">{{ $services->agency->state->name }}</p>
                    <strong>{{ $services->agency->country->name }}</strong>
                </div>
            </div>
        </div>

        @include('partials.customer-details', ['user' => $user])
        @include('partials.service-details-form', ['services' => $services])
        @include('partials.date-time-picker')

        <button type="submit" class="explore-btn">Make Booking</button>
    </div>
</form>