<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>booking registration</title>
    <link rel="stylesheet" href="{{  asset('/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href=" {{asset('/css/boxicons.min.css')}}">
    <link rel="stylesheet" href=" {{asset('/css/style.css')}}">
</head>

<body>
@if(Session::has('fail')
)        <div class="alert alert-danger">
           {{Session::get('fail')}}
        </div>
@endif
    <section class="login_form container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
            <div class="row justify-content-center main-form">
                <div class="col-xl-6 col-md-6 col-lg-5">
                    <div class="card shadow">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <img src="{{asset('img/Group 1.svg')}}" alt="Loux Ibiza Logo">
                            </div>
                            <h2 class="card-title text-center mb-4">Create Your Account</h2>
                            <form action="/saveuser" method="post">
                                @csrf
                                <!-- User Type Selection -->
                                <div class="mb-3">
                                    <label class="form-label">Sign Up As:</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="role form-check-input" type="radio" name="role" id="customer"
                                                value="2" checked>
                                            <label class="form-check-label" for="customer">Customer</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="role form-check-input" type="radio" name="role" id="agency"
                                                value="3">
                                            <label class="form-check-label" for="agency">Agency</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Common Fields -->
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullname" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required maxlength=11>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <!-- Agency-Specific Fields (Hidden by Default) -->
                                <div id="agencyFields" class="d-none">
                                    <div class="mb-3">
                                        <label for="agencyName" class="form-label">Agency Name</label>
                                        <input type="text" class="form-control" id="agencyName" name="agencyname">
                                    </div>
                                    <div class="agencyname flex-column align-items-center mb-4">
                                        
                                      
                                        <label for="">State</label>
                                        <select name="state_id" onchange="upd()" class="form-select" id="inputState2">
                                            <option value="">Select State</option>
                                        </select>
                                        <label for="">City</label>
                                        <select name="city_id" class="form-select" id="inputcities">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-warning w-100 mb-3">Sign Up</button>
                            </form>
                            <p class="text-center">Already have an account? <a href="/login"
                                    class="text-warning text-decoration-none">Log in</a></p>
                        </div>
                    </div>
                </div>
            </div>
       
    </section>
    <!-- JavaScript to Toggle Agency Fields -->
    <script>
        const userTypeRadios = document.querySelectorAll('.role');
        const agencyFields = document.getElementById('agencyFields');

        userTypeRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === "3") {
                    agencyFields.classList.remove('d-none'); // Show Agency fields
                } else {
                    agencyFields.classList.add('d-none'); // Hide Agency fields
                }
            });
        });
    </script>

    <!-- jQuery and AJAX Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    console.log(response);
                    $('#inputState2').html('<option value="">-- Select State --</option>');
                    $.each(response.id, function (key, value) {
                        $("#inputState2").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function (response) {
                    console.log('not done');
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
            console.log(dropdown.value);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: '/sendcity',
                data: { 'id': value },
                type: "get",
                cache: false,
                success: function (response) {
                    console.log(response);
                    $('#inputcities').html('<option value="">-- Select City --</option>');
                    $.each(response.id, function (key, value) {
                        $("#inputcities").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function (response) {
                    console.log('not done');
                }
            });
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script scr="{{ asset('/js/bootstrap.bundle.min.js') }}">
    </script>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    $("#agency").click(function () {
        if ($(this).is(":checked")) {
            $('.agencyname').removeClass("d-none").addClass("d-flex");
        }
        else {
            $('.agencyname').removeClass("d-flex").addClass("d-none");
        }
    })
    $("#customer").click(function () {
        if ($(this).is(":checked")) {
            $('.agencyname').removeClass("d-flex").addClass("d-none");
        }
        else {
            $('.agencyname').removeClass("d-none").addClass("d-flex");
        }
    })

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
                    $("#inputState2").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
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
        console.log(dropdown.value3);

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



</html>