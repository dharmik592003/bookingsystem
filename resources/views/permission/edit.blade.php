@extends('layout.layout')
@section('main')

    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-title">
                    <h1>
                        EDIT-PERMISSION
                    </h1>
                </div>
                <div class="card-body">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <form action="/permission/{{$permission->id}}/update" method="post">
                                @csrf
                                <div class="mb-3 d-flex flex-column">
                                    <label for="name">Name</label>
                                    <input value="{{ $permission->name }}" class="form-control" type="text" name="name"
                                        placeholder="name permission"
                                        class="border-grey-300 text-[#1b1b18] shadow-sm w-1/2 rounded-lg" id="">
                                    @error('name')
                                        <p class="text-gray-900 font-semibold">{{ $message }}</p>
                                    @enderror
                                    <label for="name">group Name</label>
                                    <input value="{{ $permission->group_by }}" class="form-control" type="text"
                                        name="group_by" placeholder="name group"
                                        class="border-grey-300 text-[#1b1b18] shadow-sm w-1/2 rounded-lg" id="">
                                    @error('roup_name')
                                        <p class="text-gray-900 font-semibold">{{ $message }}</p>
                                    @enderror
                                    <label for="name">Permission Type</label>
                                    <input value="{{ $permission->group_name }}" class="form-control" type="text"
                                        name="group_name" placeholder="name group type ex: create delete"
                                        class="border-grey-300 text-[#1b1b18] shadow-sm w-1/2 rounded-lg" id="">
                                    @error('roup_name')
                                        <p class="text-gray-900 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary">add</button>
                                    <a onclick="history.back()" class='btn btn-secondary'>back</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection