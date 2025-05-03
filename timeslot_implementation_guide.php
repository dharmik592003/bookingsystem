# Optimized Timeslot Implementation for Your Project

## 1. Agency Service Time Basis Configuration

// Add to Agency model
public function getBookingTypeAttribute() {
    return $this->attributes['booking_type'] ?? 'daily'; // default to daily
}

// Add to agency creation/edit form
<div class="form-group">
    <label>Booking Type</label>
    <select name="booking_type" class="form-control">
        <option value="hourly" {{ $agency->booking_type == 'hourly' ? 'selected' : '' }}>Hourly Basis</option>
        <option value="daily" {{ $agency->booking_type == 'daily' ? 'selected' : '' }}>Daily Basis</option>
        <option value="nightly" {{ $agency->booking_type == 'nightly' ? 'selected' : '' }}>Nightly Basis</option>
    </select>
</div>

// Add validation in AgencyRequest
public function rules() {
    return [
        'booking_type' => 'required|in:hourly,daily,nightly',
        'min_hours' => 'required_if:booking_type,hourly|integer|min:1',
        'min_days' => 'required_if:booking_type,daily,nightly|integer|min:1',
        'night_start' => 'required_if:booking_type,nightly|date_format:H:i',
        'night_end' => 'required_if:booking_type,nightly|date_format:H:i|after:night_start'
    ];
}

## 2. Calendar Integration (Using Existing PaymentController)

// Add to PaymentController.php
public function checkAvailability(Request $request) {
    $slots = [];
    $date = Carbon::parse($request->date);
    $end = $date->copy()->endOfDay();
    
    // Use existing TimeSlotService
    $timeSlotService = new TimeSlotService();
    
    while ($date <= $end) {
        $slots[] = [
            'start' => $date->format('H:i'),
            'end' => $date->addHours(1)->format('H:i'),
            'available' => $timeSlotService->isSlotAvailable($request->agency_id, $date)
        ];
    }
    
    return response()->json($slots);
}

## 2. Enhanced TimeSlotService Validation

// Update TimeSlotService.php
public function validateTimeslot($checkIn, $checkOut, $agencyId) {
    // Use existing agency relationship
    $agency = Agency::find($agencyId);
    
    // Check minimum stay based on booking type
    if ($agency->booking_type == 'hourly') {
        $valid = $checkIn->diffInHours($checkOut) >= $agency->min_hours;
    } else {
        $valid = $checkIn->diffInDays($checkOut) >= $agency->min_days;
    }
    
    // Add to existing validation in PaymentController
    return $valid && !$this->isBlackoutDate($checkIn);
}

## 3. PaymentController Early Checkout Update

// Add to PaymentController.php
public function handleEarlyCheckout(Request $request) {
    $booking = Booking::find($request->booking_id);
    
    // Use existing TimeSlotService for calculations
    $timeSlotService = new TimeSlotService();
    $refund = $timeSlotService->calculateRefund(
        $booking->check_in,
        $booking->check_out,
        $request->actual_check_out,
        $booking->agency->booking_type
    );
    
    // Update using existing payment methods
    $booking->update([
        'actual_check_out' => $request->actual_check_out,
        'refund_amount' => $refund,
        'status' => 'completed_early'
    ]);
    
    return redirect()->back()->with('success', 'Early checkout processed');
}

## 4. Simplified Implementation Steps

1. Calendar Integration:
- Add checkAvailability() to existing PaymentController
- Update TimeSlotService with slot checking logic
- No new migrations needed - use existing booking table

2. Validation:
- Enhance existing TimeSlotService methods
- Add validation to PaymentController@store
- Use existing agency preferences

3. Early Checkout:
- Add handleEarlyCheckout() to PaymentController
- Leverage existing booking relationships
- Use current payment processing flow
```
// Add to agencies table migration
Schema::table('agencies', function (Blueprint $table) {
    $table->enum('booking_type', ['hourly', 'daily', 'both'])->default('daily');
    $table->integer('min_hours')->default(4);
    $table->integer('min_days')->default(1);
    $table->time('day_cutoff')->default('20:00:00'); // 8pm cutoff
});

// Create blackout_dates table
Schema::create('blackout_dates', function (Blueprint $table) {
    $table->id();
    $table->foreignId('agency_id')->constrained();
    $table->date('date');
    $table->timestamps();
});
```

## 2. TimeSlotService Implementation
```
class TimeSlotService {
    public function calculateHours(Carbon $checkIn, Carbon $checkOut, int $minHours) {
        $hours = $checkIn->diffInHours($checkOut);
        return max($hours, $minHours);
    }

    public function calculateDays(Carbon $checkIn, Carbon $checkOut, Time $cutoff, int $minDays) {
        // Apply cutoff time logic
        if ($checkIn->gt($checkIn->copy()->setTimeFromTimeString($cutoff))) {
            $checkIn->addDay()->startOfDay();
        }
        
        $days = $checkIn->diffInDays($checkOut);
        return max($days, $minDays);
    }
}
```

## 3. Booking Validation
```
// In booking request validation
public function rules() {
    return [
        'check_in' => ['required', 'date', 
            new ValidTimeslot($this->agency->booking_type)],
        'check_out' => ['required', 'date', 'after:check_in'],
        'booking_type' => ['required_if:agency.booking_type,both']
    ];
}
```

## 4. Agency Preference Management
```
// AgencyController methods
public function editPreferences(Agency $agency) {
    return view('agency.preferences', compact('agency'));
}

public function updatePreferences(Request $request, Agency $agency) {
    $agency->update($request->only([
        'booking_type', 
        'min_hours',
        'min_days',
        'day_cutoff'
    ]));
}
```

## 5. Frontend Implementation
```
// Booking form JavaScript
function updateTimeSlots() {
    const bookingType = $('#booking_type').val();
    if (bookingType === 'hourly') {
        // Show hourly time picker
        // Enforce minimum hours
    } else {
        // Show daily calendar
        // Enforce minimum days
    }
}
```

## Key Implementation Notes:

1. Hourly Bookings:
- Exact hour calculation with minimums
- Round up to nearest hour
- Example: 3pm-6:30pm = 4 hours (with 1-hour increments)

2. Daily Bookings:
- 24-hour periods from check-in
- Cutoff times affect day counting
- Example: 3pm Day1 to 11am Day2 = 1 day

3. Special Cases:
- Overnight rules (after cutoff time)
- Minimum stay requirements
- Blackout date validation

4. UI Considerations:
- Different time pickers for hourly/daily
- Clear pricing breakdown
- Visual calendar for availability
