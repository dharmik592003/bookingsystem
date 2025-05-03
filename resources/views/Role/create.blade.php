@extends('layout.layout')
@section('main')


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ route('Role.store') }}" method="post">
                    @csrf
                    <div class="mb-3 flex flex-col">
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
        </div>
    </div>
</div>
@endsection