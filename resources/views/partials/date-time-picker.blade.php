<div class="form-group">
    <div class="d-flex flex-column">
        <div class="labels d-flex justify-content-evenly">
            <div class="text-center w-100">
                <label for="checkin-date">Check-in Date:</label>
            </div>
            <div class="text-center w-100">
                <label for="checkout-date">Check-out Date:</label>
            </div>
        </div>
        <div class="d-flex fields">
            <input autocomplete="off" type="text" placeholder="dd/mm/yyyy" name="from" class="text-center form-control" id="from">
            <input autocomplete="off" type="text" placeholder="dd/mm/yyyy" name="to" class="text-center form-control" id="to">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="d-flex flex-column">
        <div class="labels d-flex justify-content-evenly">
            <div class="text-center w-100">
                <label for="checkin-time">Check-in Time:</label>
            </div>
            <div class="text-center w-100">
                <label for="checkout-time">Check-out Time:</label>
            </div>
        </div>
        <div class="d-flex fields">
            <select class="form-control text-center" id="checkin-time" name="checkin_time">
                <option value="{{ $services->booking_start }}">{{ $services->booking_start }}</option>
            </select>
            <select class="form-control text-center" id="checkout-time" name="checkout_time">
                <option value="{{ $services->booking_end }}">{{ $services->booking_end }}</option>
            </select>
        </div>
    </div>
</div>