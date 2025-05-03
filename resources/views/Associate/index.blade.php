@extends('layout.layout')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/fh-3.3.1/r-2.4.0/sb-1.4.0/datatables.min.css">
@endsection
@section('main')
    <div class="py-12">
        <div class="w-7 mx-auto px-6 px-8">
            <div class=" d-flex justify-content-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRole">Add Team member</button>
            </div>
            <table id="example" class="table table-striped table-bordered" style="width:100% overfolow-x:hidden;">
                <thead>
                    <tr>
                        <th class="">
                            Sr No.
                        </th>
                        <th class="">
                            Team member
                        </th>
                        <th class="">
                            Roles
                        </th>

                        <th class="">
                            actions
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($Accociates as $Asscociate)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="">
                                {{$loop->index + 1}}
                            </td>
                          

                            <th scope="row" class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$Asscociate->user->name}}
                            </th>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ ($Asscociate->user->roles->pluck('name')->implode(', '))}}
                            </td>
                            <td class="">
                                <a href="/Associate/{{$Asscociate->id}}/edit" class="btn btn-primary  m-2">edit</a><a
                                    href="/Associate/{{$Asscociate->id}}/delete" class="btn btn-danger  m-2">delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="createRole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Team member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Associate.store') }}" method="post">
                        @csrf
                        <div class="mb-3 d-flex flex-column">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" list="email-list">

                            <!-- <label for="name">email</label>
                                <input value="{{ old('email') }}" type="text" name="email" placeholder="Add email"
                                    class="border-grey-300 text-dark shadow-sm w-1/2 rounded-lg" id="">
                                @error('email')
                                    <p class="text-gray-900 font-semibold">{{ $message }}</p>
                                @enderror -->

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js'></script>
    <script src = "https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/fh-3.3.1/r-2.4.0/sb-1.4.0/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').dataTable();
        });
    </script>

@endsection