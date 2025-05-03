@extends('layout.layout')

@section('main')

<div class="app-content">
    @if (Session::get('loginid') == 1)
        @include('components.agency-admin')
    @elseif (Session::get('customer_id') == 2)
        @include('components.agency-customer')
    @endif

</div>

@endsection
@section('script')


<script>


    $('#addservices').click(function () {

        let serviceform = ` <div id='contant'>
            <form action="/addservice" method="post" enctype="multipart/form-data">
                                   @csrf
                                 
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="text" name="name" id="form3Example1c" class="form-control" />
                            <label class="form-label" for="form3Example1c">service name</label>
                        </div>
                    </div>

              

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <textarea type="password" name="desc" id="form3Example4c"
                                class="form-control"></textarea>
                            <label class="form-label" for="form3Example4c">des</label>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="text" name="price" id="form3Example4cd" class="form-control" />
                            <label class="form-label" for="form3Example4cd">price</label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="file" name="image" id="form3Example4cd" class="form-control" />
                            <label class="form-label" for="form3Example4cd">images</label>
                        </div>
                    </div>

                    <div class="form-check d-flex justify-content-center mb-5">
                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                        <label class="form-check-label" for="form2Example3">
                            I agree all statements in
                        </label>
                    </div>


            
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                        </div>`
        $('#contant').replaceWith(serviceform)
        $('#title').html('Sevices')
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
@endsection