<div class="form-group">
    <label for="customer-name">Customer Name:</label>
    <input type="text" class="form-control" value="{{ $user->name }}" id="customer-name" placeholder="Enter customer name">
</div>
<div class="form-group">
    <label for="customer-email">Customer Email:</label>
    <input type="email" class="form-control" value="{{ $user->email }}" id="customer-email" placeholder="Enter customer email">
</div>
<div class="form-group">
    <label for="customer-phone">Customer Phone:</label>
    <input type="text" class="form-control" value="{{ $user->number }}" id="customer-phone" placeholder="Enter customer phone">
</div>