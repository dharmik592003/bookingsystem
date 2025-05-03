<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <img src="{{ asset($services->banner_photo) }}" alt="{{ $services->name }}" class="img-thumbnail"
                style="width: 100px; height: 100px; object-fit: cover; margin-right: 15px;">
            <div>
                <div class="card-text d-flex flex-column">
                    <h5 class="card-title">{{ $services->name }}</h5>
                    <p class="card-text">{{ $services->type->name }}</p>
                    <p class="card-text">
                        <span class="text-muted">{{ $services->agency->city->name }},
                            {{ $services->agency->state->name }},
                            {{ $services->agency->country->name }}</span>
                    </p>
                    <p class="card-text">
                        <span class="text-warning">★ reviews</span>
                    </p>
                </div>
            </div>
        </div>
        <hr>
        @php
            $info = [];
            foreach ($stay->attributesToArray() as $key => $value) {
                if (!in_array($key, ['service_id', 'agency_id', 'category_id', 'type_id', 'name', 'created_at', 'updated_at', 'id', 'service_images'])) {
                    $info[$key] = $value;
                }
            }
        @endphp
        <div class="d-flex flex-column justify-content-between">
            @foreach($info as $key => $value)
                <p class="mb-0">{{ ucfirst($key) }}:<strong> {{ $value }}</strong></p>
            @endforeach
        </div>
    </div>
</div>