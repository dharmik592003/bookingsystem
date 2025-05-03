@extends('layout.layout')
@section('main')
<div class="py-12">
    <div class="w-7 mx-auto px-6 px-8">
        <div class=" d-flex justify-content-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRole">create</button>
        </div>
        <table class="w-100 table text-dark text-left ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="justify-content-center align-items-center text-left">
                        Sr No.
                    </th>
                    <th scope="col" class="justify-content-center align-items-center text-left">
                        Role name
                    </th>
                    <th scope="col" class="justify-content-center align-items-center text-center">
                        permissions
                    </th>
                    <th scope="col" class="justify-content-center align-items-center text-center">
                        action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Roles as $Role)
                <tr class="">
                    <td class="text-left align-content-center col-xl-2">
                        <p>
                        {{$loop->index + 1}}</p>
                    </td>
                    <th scope="row" class="text-left  align-content-center  font-medium col-xl-2">
                        <p>
                        {{$Role->name}}</p>
                    </th>
                    <td class="text-left  col-xl-6">

                        @foreach ($Role->permissions as $permission)
                        <span class="badge bg-success me-1">{{ $permission->name}}</span>
                        @endforeach


                    </td>
                    <td class="justify-content-center align-items-center text-center col-xl-2">
                        <a href="/Role/{{$Role->id}}/edit" class="btn btn-primary">edit</a><a
                            href="/Role/{{$Role->id}}/delete" class="btn btn-danger">delete</a>
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
                <form action="{{ route('Role.store') }}" method="post">
                    @csrf
                    <div class="mb-3 d-flex flex-column">
                        <label for="name">Name</label>
                        <input value="{{ old('name') }}" type="text" name="name" placeholder="Name Role"
                            class="border-grey-300 text-dark shadow-sm w-1/2 rounded-lg" id="">
                        @error('name')
                        <p class="text-gray-900 font-semibold">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="mt-3 flex-col ">
                        @foreach ($permissions as $permission)
                        <div class="m-3">
                            <input type="checkbox" class='rounded' id='permission-{{ $permission->id }}'
                                value="{{ $permission->name }}" name="permission[]" id="">
                            <label for="permision">{{ $permission->name }}</label>
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" class="bg-gray-500 text-sm rounded-md px-5 py-2">add</button>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">add</button>
            </div>
        </div>
    </div>
</div>
@endsection