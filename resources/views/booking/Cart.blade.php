@extends('layout.layout')
@section('main')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Available services</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-6">
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>Service cart</h3>
                            <svg class="small-box-icon" style="top:0; importanat" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <section class="container" id="invoice">
                <div class="wrapper">
                    <section class="container">
                        <div class="row">
                            @if(empty(session('cart')))
                                <h1>YOUR CART IS EMPTY</h1>
                            @elseif (!empty(session('cart')))
                                @foreach ($services as $service)
                                    <div class="col-lg-4 justify-content-center d-flex">
                                        <div class="card" style="width: 18rem;">
                                            <img class="card-img-top img-fluid" src="{{asset($service->banner_photo)}}"
                                                alt="Card image cap">
                                            <div class="card-body">
                                                <div class="card-text d-flex flex-column">
                                                    <div class="card-title">
                                                        <p hidden>{{ $service->id }}</p>
                                                        <h5 class="card-title">{{ $service->name }}</h5>
                                                    </div>
                                                    <div class="card-details">
                                                        <p class="card-text">{{$service->desc}}</p>
                                                        <p class="card-text price">{{$service->price}}</p>
                                                        <p class="card-text">agency: {{$service->name}}</p>
                                                    </div>
                                                </div>
                                                
                                                <button href="#" id="" class="remove btn btn-danger">remove from
                                                    cart</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Payment Summary</h5>
                                            <div class="card-text">
                                                <p>Total Items: {{ count(session('cart')) }}</p>

                                                <p> Total Price: <span class="total">₹0</span></p>

                                            </div>
                                            <button href="#" id="" class="btn btn-primary">Proceed to Payment</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
            </section>
        </div>

        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3" id="mainform">
                            <div id="contant">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
@endsection
    @section('script')


        <script>
            const divs = document.querySelectorAll('.price');
            let total = 0;

            divs.forEach(div => {
                const value = parseFloat(div.textContent) || 0;
                total += value;
            });
            $('.total').html('₹' + total)
            console.log(total);
        </script>
        <script>
            $('.remove').on('click', function () {
                let card = $(this).parent().children(2).children(2).children()[0].innerText
                console.log(card)
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "post",
                    url: "/" + card + "/removefromcart",
                    success: function () {
                        console.log('done')
                        location.reload();
                    }
                })
            })
            function countTotal() {
                const divs = document.querySelectorAll('.price');
                let total = 0;

                divs.forEach(div => {
                    const value = parseFloat(div.textContent) || 0;
                    total += value;
                });
                document.querySelector('.total').innerHTML = '₹' + total;
                console.log(total);

            }


        </script>
    @endsection