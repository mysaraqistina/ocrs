@if($errors->any()) 
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($errors->has('start_date'))
    <div class="alert alert-danger">
        {{ $errors->first('start_date') }}
    </div>
@endif

<form action="{{ route('bookings.store') }}" method="POST">
    @csrf

    {{-- Car Selection --}}
    <div class="mb-3">
        <label for="car_id" class="form-label">Select Car</label>
        <select class="form-control" name="car_id" id="car_id" required>
            @foreach($cars as $car)
                <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                    {{ $car->brand }} {{ $car->model }} ({{ $car->type }})
                </option>
            @endforeach
        </select>
    </div>

    {{-- Start Date --}}
    <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
        <div id="date-warning" class="text-danger mt-1" style="display:none;">
            Bookings must be made at least 2 days in advance.
        </div>
    </div>

    {{-- End Date --}}
    <div class="mb-3">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
    </div>

    {{-- Submit Button --}}
    <button type="submit" class="btn btn-primary">Book Now</button>
</form>

{{-- JavaScript validation --}}
<script>
document.getElementById('start_date').addEventListener('change', function() {
    const selected = new Date(this.value);
    const today = new Date();
    today.setHours(0,0,0,0);
    const minDate = new Date(today);
    minDate.setDate(today.getDate() + 2);

    if (selected < minDate) {
        document.getElementById('date-warning').style.display = 'block';
    } else {
        document.getElementById('date-warning').style.display = 'none';
    }
});
</script>
