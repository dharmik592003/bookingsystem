@extends('layout.layout')
@section('main')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/Associate/{{$Associate->id}}/update" method="post">
                        @csrf
                        <div class="mb-3 flex flex-col">
                            <label for="name">Name</label>
                            <input value="{{ $Associate->user->name }}" type="text" name="name" placeholder="Associate Name"
                                class="border-grey-300 text-[#1b1b18] shadow-sm w-1/2 rounded-lg" id="">
                            @error('name')
                                <p class="text-gray-900 font-semibold">{{ $message }}</p>
                            @enderror

                            <label for="name">Email</label>
                            <input value="{{ $Associate->user->email }}" type="email" name="email" placeholder="User Name"
                                class="border-grey-300 text-[#1b1b18] shadow-sm w-1/2 rounded-lg" id="">
                            @error('name')
                            <p class="text-gray-900 font-semibold">{{ $message }}</p>
                            @enderror

                            <div class="mt-3 flex-col ">
                            @foreach ($Roles as $Role)
                                <div class="m-3">
                                    <input  {{ ($hasRoles?->contains($Role->name))? 'checked': '' }}   type="checkbox"class='rounded' id='role-{{ $Role->id }}' value="{{ $Role->name }}" name="role[]" id="">
                                    <label for="role">{{ $Role->name }}</label>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <button type="submit" class="bg-gray-500 text-sm rounded-md px-5 py-2">add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection