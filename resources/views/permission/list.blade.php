@extends('layout.layout')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/fh-3.3.1/r-2.4.0/sb-1.4.0/datatables.min.css">
@endsection
@section('main')
    <div class="p-12">
        <div class="w-7 ms-auto p-6">
            <div class=" d-flex justify-content-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRole">create</button>
            </div>

            <table id="example" class="table table-striped table-bordered" style="width:100% overfolow-x:hidden;">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Permisssion name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Groupname
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Created at
                        </th>

                        <th scope="col" class="px-6 py-3">
                            action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <th scope="row" class="font-medium text-dark whitespace-nowrap dark:text-white">
                                {{$permission->name}}
                            </th>
                            <td class="text-dark">
                                {{$permission->group_by}}
                            </td>
                            <td class="text-dark">
                                {{$permission->created_at->format('d M,Y')}}
                            </td>
                            <td class="">
                                <a href="/permission/{{$permission->id}}/edit" class=" btn btn-primary px-3 py-2 m-2">edit</a><a
                                    href="/permission/{{$permission->id}}/delete"
                                    class="btn btn-danger px-3 py-2 m-2">delete</a>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('permission.store') }}" method="post">
                        @csrf
                        <div class="mb-3 d-flex flex-column">
                            <label for="name">Name</label>
                            <input value="{{ old('name') }}" class='form-control' type="text" name="name"
                                placeholder="name permission"
                                class="border-grey-300 text-[#1b1b18] shadow-sm w-1/2 rounded-lg" id="">
                            @error('name')
                                <p class="text-gray-900 font-semibold">{{ $message }}</p>
                            @enderror
                            <label for="name">group Name</label>
                            <input value="{{ old('group_name') }}" class='form-control' type="text" name="group_by"
                                placeholder="name group" class="border-grey-300 text-[#1b1b18] shadow-sm w-1/2 rounded-lg"
                                id="">
                            @error('roup_name')
                                <p class="text-gray-900 font-semibold">{{ $message }}</p>
                            @enderror

                            <label for="name">Permission Type</label>
                            <input class="form-control" type="text" name="group_name"
                                placeholder="name group type ex: create delete"
                                class="border-grey-300 text-[#1b1b18] shadow-sm w-1/2 rounded-lg" id="">
                            @error('roup_name')
                                <p class="text-gray-900 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">add</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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