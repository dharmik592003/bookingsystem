<div class="form-group">
    <div class="d-flex flex-column">
        <div class="d-flex labels justify-content-evenly text-center">
            <div class="text-center w-100">
                <label for="service-name">Service Name:</label>
            </div>
            <div class="text-center w-100">
                <label for="service-type">Service Type:</label>
            </div>
        </div>
        <div class="d-flex fields">
            <input type="text" class="text-center form-control" value="{{ $services->name }}" id="service-name" readonly>
            <select name="service_type" class="text-center form-control" id="service-type">
                <option value="{{ $services->type->id }}">{{ $services->type->name }}</option>
            </select>
        </div>
    </div>
</div>