@extends('layout.layout')
<!--end::Head-->
<!--begin::Body-->
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

    <div class="error">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror
        @error('desc')
            <div class="error">{{ $message }}</div>
        @enderror
        @error('bannerimage')
            <div class="error">{{ $message }}</div>
        @enderror
        @error('comissionpay')
            <div class="error">{{ $message }}</div>
        @enderror
        @error('deductioncut')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <!-- <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-end">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                        </ol>
                                    </div> -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->

                <!--end::Col-->
                <div class="col-lg-12 col-6">
                    <!--begin::Small Box Widget 2-->
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>{{ $total }}</h3>
                            <p>Total services</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                            </path>
                        </svg>
                        <button type="button" id="addservices" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#myModal">
                            add service
                        </button>

                    </div>
                    <!--end::Small Box Widget 2-->
                </div>
                <!--end::Col-->


            </div>







            <div class="row">
                @foreach ($services as $service)
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="img" style="width: 100%;">
                                <img src="{{ asset($service->photo) }}" class="img-fluid card-img" alt="">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $service->name }}</h5>
                                <p class="card-text">{{ $service->desc }}</p>
                                <div class="button">
                                    <!-- <a href="service/{{ $service->name }}" class="btn btn-primary">Check out</a> -->
                                    <button type="button" id="editbtn" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#myModal2" value="{{ $service->id }}">
                                        edit 
                                    </button>
                                    <a class="btn btn-danger"href="{{ route('services.delete',[$service->id]) }}">delete</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="title"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3" id="mainform">
                            <div class="form-container">
                                <form action="/addservice" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="progress-bar"></div>
                                    <!-- Step 1: Basic Information -->
                                    <div class="step active" data-step="1">
                                        <h2>ServiceCategory Information</h2>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="text" name="name" id="form3Example1c" class="form-control" />
                                                <label class="form-label" for="form3Example1c">service name</label>

                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <textarea type="" name="desc" id="form3Example4c"
                                                    class="form-control"></textarea>
                                                <label class="form-label" for="form3Example4c">des</label>

                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="file" name="bannerimage" id="form3Example4cd" class="form-control" />
                                                <label class="form-label" for="form3Example4cd">images</label>

                                            </div>
                                        </div>
                                        <div class="d-flex ">
                                            <div class="d-flex m-2 flex-row align-items-center mb-4">
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input type="text" name="comissionpay" id="form3Example1c"
                                                        class="form-control" />
                                                    <label class="form-label" for="form3Example1c">company commission
                                                        %</label>

                                                </div>
                                            </div>
                                            <div class="d-flex m-2 flex-row align-items-center mb-4">
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input type="text" name="deductioncut" id="form3Example1c"
                                                        class="form-control" />
                                                    <label class="form-label" for="form3Example1c">company cancelation
                                                        %</label>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttons">
                                            <button class="next" type="submit">Submit</button>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>

                    </div>



                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="mb-3" id="mainform">
                        <div class="form-container">
                            <form action="/updateservice" id="updateform" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="progress-bar"></div>

                                <!-- Step 1: Basic Information -->
                                <div class="step active" data-step="1">
                                    <h2>Basic Information</h2>


                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <input type="text" name="name" id="servicename" class="form-control" />
                                            <label class="form-label" for="form3Example1c">service
                                                name</label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <textarea type="" name="desc" id="servicedesc" class="form-control"></textarea>
                                            <label class="form-label" for="form3Example4c">des</label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <img src="" id="servicephoto" class="img-fluid" alt="">
                                            <input type="file" name="bannerimage" id="serviceimg" class="form-control" />
                                            <label class="form-label" for="form3Example4cd">images</label>
                                        </div>
                                    </div>
                                    <div class="d-flex ">
                                        <div class="d-flex m-2 flex-row align-items-center mb-4">
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="text" name="comissionpay" id="servicecommission"
                                                    class="form-control" />
                                                <label class="form-label" for="form3Example1c">company commission
                                                    %</label>
                                            </div>
                                        </div>
                                        <div class="d-flex m-2 flex-row align-items-center mb-4">
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="text" name="deductioncut" id="servicerefund"
                                                    class="form-control" />
                                                <label class="form-label" for="form3Example1c">company cancelation
                                                    %</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons">
                                        <button class="next" type="submit">Submit</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

@endsection


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
                        opacity: 0,
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
                    opacity: 0,
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
    $("body").on("click", "#editbtn", function () {
        var value = $(this).attr('value')
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url:'/services/'+value+'/edit'                ,
            data: { 'id': value },
            type: "get",
            cache: false,
            success: function (res) {
                console.log(res);
                $(".modal-title").html("edit");
                $("#servicename").val(res.details.name);
                $("#servicedesc").val(res.details.desc);
                $("#servicecommission").val(res.details.comissionpay);
                $("#servicerefund").val(res.details.deductioncut);

                $("#serviceimg").attr('value', res.details.photo);
                $("#servicephoto").attr('src', res.details.photo);
                $("#updateform").attr('action', res.details.id + '/updateservice');

            },
            error: function (res) {
                console.log('not done')
            }
        });
    })
</script>
@endsection
