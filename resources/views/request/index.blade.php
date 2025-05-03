@extends('layout.layout')
@php
    use App\Status;

@endphp
@section('main')
    @if (Session::get('loginid') == 1)
        <table id="example" class="table table-striped" style="width:100%">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">services</th>
                    <th scope="col">agency</th>
                    <th scope="col">from</th>
                    <th scope="col">to</th>
                    <th scope="col">status</th>
                    <th scope="col">actions</th>
                </tr>
            </thead>
            </thead>
            <tbody>

                @foreach ($ids as $id)

                    <tr>

                        <th scope="row" class="form">{{ $loop->index + 1}}</th>
                        <td>{{ $id->customer->name }}</td>
                        <td>{{ $id->customer->email }}</td>
                        <td>{{ $id->service->name}}</td>
                        <td>{{ $id->service->name}}</td>
                        <td>{{ $id->from}}</td>
                        <td>{{ $id->to}}</td>
                        <td name="status" id="status" value="">{{ $id->status }}</td>
                        <td>

                            <select name="status" data-id="{{$id->id}}" class="action">
                                <option selected>Action</option>
                                @foreach (Status::cases() as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </td>

                    </tr>

                @endforeach
            </tbody>
        </table>
    @elseif (Session::get('customer_id') == 3)
        <table id="example" class="table table-striped" style="width:100%">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">services</th>
                    <th scope="col">agency</th>
                    <th scope="col">from</th>
                    <th scope="col">to</th>
                    <th scope="col">status</th>
                    <th scope="col">actions</th>
                </tr>
            </thead>
            </thead>
            <tbody>

                @foreach ($ids as $id)

                    <tr>
                        <th scope="row" class="form">{{ $loop->index + 1}}</th>
                        <td>{{ $id->customer->name }}</td>
                        <td>{{ $id->customer->email }}</td>
                        <td>{{ $id->service->name}}</td>
                        <td>{{ $id->service->name}}</td>
                        <td>{{ $id->from}}</td>
                        <td>{{ $id->to}}</td>
                        <td name="status" id="status" value="">{{ $id->status }}</td>
                        <td>

                            <select name="status" data-id="{{$id->id}}" class="action">
                                <option selected>Action</option>
                                @foreach (Status::cases() as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </td>

                    </tr>

                @endforeach
            </tbody>
        </table>
    @elseif(Session::get('customer_id') == 2)
        <table id="example" class="table table-striped" style="width:100%">

            <thead>
                <tr>
                    <th scope="col">#</th>

                    <th scope="col">services</th>
                    <th scope="col">status</th>
                    <th scope="col">price </th>
                    <th scope="col">from </th>
                    <th scope="col">to</th>
                    <th scope="col">actions</th>
                </tr>
            </thead>
            </thead>
            <tbody>
                @foreach ($customers as $customer)

                    <tr>


                        <th scope="row" class="form">{{ $loop->index + 1}}</th>

                        <td>{{ $customer->service->name }}</td>
                        <td name="status" id="status" value="">{{ $customer->status }}</td>
                        <td>{{ $customer->service->price }} ₹</td>
                        <td>{{ $customer->from }}</td>
                        <td>{{ $customer->to }}</td>
                        <td>
                            <a href="" class="btn btn-primary">edit</a><a href="" class="btn btn-danger">cancel</a>
                        </td>

                    </tr>

                @endforeach
            </tbody>
        </table>
    @endif

@endsection
<!--end::App Wrapper-->
@section('script')

    @if (Session::get('loginid') == 1)
        <script>

            $('.action').on('change', function () {

                // let id = $('.form').attr('data-id');
                var id = $(this).attr("data-id");
                console.log(id)
                let text = 'want to change?'
                let element = $('#form')
                if (confirm(text) == true) {
                    text = "You pressed OK!";
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        type: "post",

                        url: "{{ route('status', $id)  }}",

                        data: $(this).serialize(),
                        success: function (data) {
                            location.reload()
                        }

                    });
                    element.submit();
                } else {
                    console.log("You canceled!");
                }

            });


        </script>
    @elseif (Session::get('customer_id') == 3)
        <script>

            $('.action').on('change', function () {

                // let id = $('.form').attr('data-id');
                var id = $(this).attr("data-id");
                console.log(id)
                let text = 'want to change?'
                let element = $('#form')
                if (confirm(text) == true) {
                    text = "You pressed OK!";
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        type: "post",

                        url: "{{ route('status', $id)  }}",

                        data: $(this).serialize(),
                        success: function (data) {
                            location.reload()
                        }

                    });
                    element.submit();
                } else {
                    console.log("You canceled!");
                }

            });


        </script>
    @elseif(Session::get('loginid') == 2)
        <script>
consol.log('request page')
           


        </script>
    @endif
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.colVis.min.js"></script>

    <script>
        new DataTable('#example', {
            layout: {
                topStart: {
                    buttons: ['copy', 'excel', 'pdf', 'colvis']
                }
            }
        });
    </script>



@endsection