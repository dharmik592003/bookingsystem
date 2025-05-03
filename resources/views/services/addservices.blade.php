@extends('layout.layout')
<style>
    .form-container {
        background: white;
        padding: 40px;

        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        width: 100%;

        position: relative;
        overflow: hidden;
    }

    .progress-bar {
        position: absolute;
        top: 0;
        left: 0;
        height: 4px;
        background: #6366f1;
        transition: width 0.3s ease;
    }

    .step {
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .step.active {
        display: block;
    }

    h2 {
        color: #1f2937;
        margin-bottom: 30px;
        font-size: 24px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #4b5563;
        font-weight: 500;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 12px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    input:focus,
    textarea:focus,
    select:focus {
        outline: none;
        border-color: #6366f1;
    }

    .color-options {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .color-option {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .color-option:hover {
        transform: scale(1.1);
    }

    .color-option.selected {
        border: 3px solid #6366f1;
    }

    .buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    button {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    button.next {
        background: #6366f1;
        color: white;
    }

    button.prev {
        background: #e5e7eb;
        color: #4b5563;
    }

    button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .error {
        color: #ef4444;
        font-size: 14px;
        margin-top: 5px;
        display: none;
    }

    .submit-message {
        text-align: center;
        padding: 40px;
    }

    .submit-message img {
        width: 80px;
        margin-bottom: 20px;
    }
</style>

@section('main')
    @php
        use App\service_booking_type;
    @endphp
    <div class="app-main form-container">
        <h1>become host and earn money</h1>
        <form class="" action="/addservice" method="post" enctype="multipart/form-data">
            @csrf
            <div class="progress-bar"></div>

            <!-- Step 1: Basic Information -->
            <div class="step active" data-step="1">
                <h2>Basic Information</h2>
                <div class="d-flex flex-row align-items-center mb-4">
                   
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="text" name="agencyname" value="{{ $user->name }}" id="category_name"
                            class="form-control" />
                        <label class="form-label" for="form3Example1c">agency
                            name</label>
                    </div>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="text" name="name" value="" id="category_name" class="form-control" />
                        <label class="form-label" for="form3Example1c">your service
                            name</label>
                    </div>
                </div>
                <div class="agencyname flex-column align-items-center mb-4">

                    <label for="">State</label>
                    <select name="state_id" id="inputState2" onchange="upd()" class="form-select">
                        <option value="">Select states</option>
                    </select>
                    <label for="">City</label>
                    <select name="city_id" class="form-select" id="inputcities">
                        <option value="">Select City</option>
                    </select>
                </div>
                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <textarea type="password" name="desc_company" id="form3Example4c" class="form-control"></textarea>
                        <label class="form-label" for="form3Example4c">describe your self</label>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center mb-4">
                    
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="text" name="address" id="form3Example4cd" class="form-control" />
                        <label class="form-label" for="form3Example4cd">address</label>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center mb-4">
                    
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="text" name="number" id="form3Example4cd" class="form-control" />
                        <label class="form-label" for="form3Example4cd">number</label>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center mb-4">
                    
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="text" name="email" value="{{ $user->email }}" id="form3Example4cd"
                            class="form-control" />
                        <label class="form-label" for="form3Example4cd">email</label>
                    </div>
                </div>


                <div class="buttons">
                    <div></div>
                    <a class="next btn btn-primary">Next Step</a>
                </div>
            </div>

            <div class="step" data-step="2">
                <h2>service Details</h2>
                <label for="">select your category of service</label>
                <div class="d-flex flex-row align-items-center mb-4">
                    <select name="category_id" data-name='' class="form-select" id="inputcategory">
                        <option value="">Select category</option>
                        @foreach ($category as $cn)
                            <option value="{{$cn->id}}" data-name='{{$cn->name}}'>
                                {{$cn->name}}
                            </option>
                        @endforeach
                    </select>
                    <div class="d-flex  col-xl-3 flex-row align-items-center mb-4">
                        
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example4cd">add an banner image of your
                                service</label>
                            <input type="file" name="bannerimage" id="form3Example4cd" class="form-control"  />
                        </div>
                    </div>
                </div>
                <div class="typeform">
                    <div class=" row d-flex align-items-center justify-content-between flex-row" id="base">
                        <div class="form-group col-xl-4">
                            <div class="d-flex lables">
                                <!-- <label for="">refer to old types ?</label> -->
                                <label for="industry">add types of subservice you provide</label>

                            </div>
                            <div class="inputs d-flex">
                                <!-- <div class="oldtypes">
                                    <select name="types" id="refer-types" class="form-select"
                                        onchange="document.getElementById('type').value=this.options[this.selectedIndex].text">
                                        <option value="">select old type add on</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}"> {{ $type->name }} </option>
                                        @endforeach
                                    </select>
                                </div> -->


                                <input type="text" name="typename" id="type"
                                    placeholder="ex:premium delux etc">
                                <div class="error">Please select your industry</div>
                            </div>
                        </div>
                        <div class="d-flex  col-xl-4 flex-row align-items-center mb-4">
                            
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example4cd">add images of your services</label>
                                <input type="file" name="serviceimage[]" id="form3Example4cd" class="form-control"
                                    multiple />
                            </div>
                        </div>
                        <div class=" col-xl-4 form-group">
                            <label for="description">type Description</label>
                            <textarea id="description" name="sub_service_desc" rows="4" required
                                placeholder="Tell us about your service's type  description"></textarea>
                            <div class="error">Please provide service'stype description</div>
                        </div>


                        <div class="form-group">
                            <label>Booking Type</label>
                            <select name="booking_type" class="form-control" id="booking-type">
                                <option value="" selected>select your service availablity : hourly/ daily / day /night type</option>
                                @foreach (service_booking_type::cases() as $bookingType)
                                    <option value="{{ $bookingType->value }}" {{ old('booking_type', $type->booking_type) == $bookingType->value ? 'selected' : '' }}>
                                        {{ $bookingType->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="time-slot" style="display: none;">
                                <label>Time Slot</label>
                                <input type="text" name="time_slot"
                                    placeholder="Enter time slot (min 3 hrs, e.g., 3 hours, 4 hours, etc.)">
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example4cd">service booking acceepting start time</label>
                                <input type="time" name="start_time" id="form3Example4cd" class="form-control" />
                            </div>
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example4cd">service booking acceepting start end</label>
                                <input type="time" name="end_time" id="form3Example4cd" class="form-control" />
                            </div>
                        </div>


                        <div data-mdb-input-init class="col-xl-3 form-group form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example1c">set the price of your type service
                                name</label>
                            <input type="text" name="price" value="" placeholder="price  per/hour/(day/night) ₹"
                                id="category_name" class="form-control" />
                        </div>

                        <div class="terms">
                            <div class="stay" id="stay" style="display: none;">
                                <label for="">stay pricing</label>
                                <div>
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input" name="roomservice" id="">
                                        <label for="">including room service</label>
                                    </div>
                                    <input type="text" name="roomservice_price"
                                        placeholder="if room service is demanded if not place the price" id="">
                                </div>
                                <div>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="laundry" id="">
                                        <label for="">including laundry fees</label>
                                    </div>
                                    <input type="text" name="laundry_price"
                                        placeholder="if laundry fees is demanded if not place the price" id="">
                                </div>
                            </div>
                            <div class="cars" id="cars" style="display: none;">
                                <label for="">cars pricing</label>
                                <div>
                                    <input type="checkbox" name="fuel" class="form-check-input" name="" id="">
                                    <label for="fule">including fuel cost</label>
                                </div>
                                <div>
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input" name="driver" id="">
                                        <label for="">including driver</label>
                                    </div>
                                    
                                </div>
                                <div>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="toll" value="1" id="">
                                        <label for="">including toll</label>
                                    </div>
                                    <!-- <input type="text" name="toll_price"
                                        placeholder="if toll is demanded if not place the price" id=""> -->
                                </div>
                            </div>
                            <div class="yacht" id="yacht" style="display: none;">
                                <label for="">yacht pricing</label>
                                <div>
                                    <input type="checkbox" name="fuel" class="form-check-input" name="" id="">
                                    <label for="fule">including fuel cost</label>
                                </div>

                                <div>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="dockage" id="">
                                        <label for="">including dockage fees</label>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="planes" id="planes" style="display: none;">
                                <label for="">planes pricing</label>
                                <div>
                                    <input type="checkbox" name="fuel" class="form-check-input" name="" id="">
                                    <label for="fule">fuel cost</label>
                                </div>
                                <div>
                                    <div class="d-flex">
                                        <input type="checkbox" class="form-check-input" name="pilot" id="">
                                        <label for="">including pilot</label>
                                    </div>
                                    
                                </div>
                               
                        </div>


                        <!-- <div class="btn-pack  col-xl-3 d-flex align-items-center justify-content-center">
                                                                                <div class="button d-flex">
                                                                                    <button class="btn btn-primary" id="add">add more</button>

                                                                                </div>
                                                                            </div> -->

                    </div>
                </div>
                <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label" for="form2Example3">
                        I agree all statements in
                    </label>
                </div>
                <div class="buttons">
                    <a href='#'class="prev btn btn-success">Previous</a>
                    <button class="next" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
<!-- <form >
                <button type="submit" class="btn btn-primary">Submit</button>
            </form> -->
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('.form-container');
            const steps = document.querySelectorAll('.step');
            const progressBar = document.querySelector('.progress-bar');
            const colorOptions = document.querySelectorAll('.color-option');
            let currentStep = 1;

            // Update progress bar
            const updateProgress = () => {
                const progress = ((currentStep - 1) / (steps.length - 1)) * 100;
                progressBar.style.width = `${progress}%`;
            };

            // Validate current step
            const validateStep = (step) => {
                const currentStepElement = document.querySelector(`.step[data-step="${step}"]`);
                const inputs = currentStepElement.querySelectorAll('input, select, textarea');
                let isValid = true;

                inputs.forEach(input => {
                    const error = input.nextElementSibling;
                    if (input.hasAttribute('required') && !input.value.trim()) {
                        isValid = false;
                        if (error && error.classList.contains('error')) {
                            error.style.display = 'block';
                        }
                    } else if (input.type === 'email' && input.value) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(input.value)) {
                            isValid = false;
                            if (error && error.classList.contains('error')) {
                                error.style.display = 'block';
                            }
                        }
                    }
                });

                // Special validation for color selection in step 3
                if (step === 3) {
                    const selectedColors = document.querySelectorAll('.color-option.selected');
                    if (selectedColors.length === 0) {
                        isValid = false;
                        const colorError = document.querySelector('.color-options').nextElementSibling;
                        colorError.style.display = 'block';
                    }
                }

                return isValid;
            };

            // Handle next button click
            const handleNext = () => {
                if (validateStep(currentStep)) {
                    if (currentStep < steps.length) {
                        document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('active');
                        currentStep++;
                        document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('active');
                        updateProgress();

                        // Animate new step
                        gsap.from(`.step[data-step="${currentStep}"]`, {
                            y: 20,
                            duration: 0.5,
                            ease: "power2.out"
                        });
                    }
                }
            };

            // Handle previous button click
            const handlePrev = () => {
                if (currentStep > 1) {
                    document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('active');
                    currentStep--;
                    document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('active');
                    updateProgress();

                    // Animate new step
                    gsap.from(`.step[data-step="${currentStep}"]`, {

                        y: 20,
                        duration: 0.5,
                        ease: "power2.out"
                    });
                }
            };

            // Add event listeners
            form.addEventListener('click', (e) => {
                if (e.target.classList.contains('next')) {
                    handleNext();
                } else if (e.target.classList.contains('prev')) {
                    handlePrev();
                }
            });

            // Handle color selection
            colorOptions.forEach(option => {
                option.addEventListener('click', () => {
                    option.classList.toggle('selected');
                    const colorError = document.querySelector('.color-options').nextElementSibling;
                    colorError.style.display = 'none';
                });
            });

            // Handle input changes to hide error messages
            form.addEventListener('input', (e) => {
                const error = e.target.nextElementSibling;
                if (error && error.classList.contains('error')) {
                    error.style.display = 'none';
                }
            });

            // Initialize progress bar
            updateProgress();
        });
    </script>
    <script>
        function updateTextInput() {
            const xhr = new XMLHttpRequest();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: '/sendstates',
                data: { 'id': 102 },
                type: "get",
                cache: false,
                success: function (response) {
                    console.log(response)
                    $('#inputState2').html('<option value="">-- Select State --</option>');
                    $.each(response.id, function (key, value) {
                        $("#inputState2").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function (response) {
                    console.log('not done')
                }
            });
        }
        $(document).ready(function () {
            updateTextInput();
        });

        function upd() {
            const xhr = new XMLHttpRequest();
            var dropdown = document.getElementById('inputState2');
            var dropdown2 = document.getElementById('inputcities');
            var value = dropdown.value;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

                },

                url: '/sendcity',
                data: { 'id': value },
                type: "get",
                cache: false,

                success: function (response) {
                    // console.log("done")
                    console.log(response)
                    $('#inputcities').html('<option value="">-- Select city --</option>');
                    $.each(response.id, function (key, value) {
                        $("#inputcities").append('<option value="' + value
                            .id + '">' + value.name + '</option>');

                    });
                },
                error: function (response) {
                    console.log('not done')
                }
            });
        }
    </script>
    <script>
        let i = 0;
        $(document).ready(function () {
            $("#add").click(function (e) {
                e.preventDefault();
                ++i;
                var html = `<div class=" row d-flex align-items-center justify-content-center flex-row" id="base">
                                                                            <div class="form-group col-xl-3">
                                                                                <label for="industry">add types of subservice you provide</label>
                                                                                <input type="text" name="typename[]" placeholder="types of service for ex:premium delux etc">
                                                                                <div class="error">Please select your industry</div>
                                                                            </div>
                                                                            <div class="d-flex  col-xl-3 flex-row align-items-center mb-4">
                                                                                
                                                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                                                    <label class="form-label" for="form3Example4cd">add images of your services</label>
                                                                                    <input type="file" name="serviceimage[]" id="serviceimage${i}" class="form-control" multiple />
                                                                                </div>
                                                                            </div>
                                                                            <div class=" col-xl-3 form-group">
                                                                                <label for="description">type Description</label>
                                                                                <textarea id="description" name="sub_service_desc[]" rows="4" required
                                                                                    placeholder="Tell us about your service's type  description"></textarea>
                                                                                <div class="error">Please provide service'stype description</div>
                                                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                                                    <label class="form-label" for="form3Example1c">set the price of your type service
                                                                                        name</label>
                                                                                    <input type="text" name="price[]" value="" placeholder="price  per/hour/(day/night) ₹"
                                                                                        id="category_name${i}" class="form-control" />
                                                                                </div>
                                                                            </div>

                                                                            <div class="btn-pack  col-xl-3 d-flex align-items-center justify-content-center">
                                                                                <div class="button d-flex">
                                                                                    <button class="btn btn-danger" id="remove">remove</button>
                                                                                </div>
                                                                            </div>`
                $('#base').append(html)
                $(document).on('click', '#remove', function (e) {
                    e.preventDefault();
                    let row_items = $(this).parent().parent().parent();
                    console.log(row_items)
                    row_items.remove()
                })
            })
        })
    </script>
    <script>
        document.getElementById('inputcategory').addEventListener('change', function () {
            var value = this.value;
            if (value == 1) {
                document.getElementById('stay').style.display = 'block';
                document.getElementById('cars').style.display = 'none';
                document.getElementById('yacht').style.display = 'none';
                document.getElementById('planes').style.display = 'none';
            } else if (value == 2) {
                document.getElementById('stay').style.display = 'none';
                document.getElementById('cars').style.display = 'block';
                document.getElementById('yacht').style.display = 'none';
                document.getElementById('planes').style.display = 'none';
            } else if (value == 3) {
                document.getElementById('stay').style.display = 'none';
                document.getElementById('cars').style.display = 'none';
                document.getElementById('yacht').style.display = 'block';
                document.getElementById('planes').style.display = 'none';
            } else if (value == 4) {
                document.getElementById('stay').style.display = 'none';
                document.getElementById('cars').style.display = 'none';
                document.getElementById('yacht').style.display = 'none';
                document.getElementById('planes').style.display = 'block';
            }
            else if (value == 0) {
                document.getElementById('stay').style.display = 'none';
                document.getElementById('cars').style.display = 'none';
                document.getElementById('yacht').style.display = 'none';
                document.getElementById('planes').style.display = 'none';
            }
        });
    </script>
    <script>
        document.getElementById('booking-type').addEventListener('change', function () {
            var value = this.value;
            if (value == 'hourly') {
                document.getElementById('time-slot').style.display = 'block';
            } else {
                document.getElementById('time-slot').style.display = 'none';
            }
        });
    </script>
@endsection