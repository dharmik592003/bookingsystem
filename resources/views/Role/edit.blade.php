@extends('layout.layout')
@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/Role/{{$Role->id}}/update" method="post">
                        @csrf
                        <div class="mb-3 flex flex-col">
                            <label for="name">Name</label>
                            <input value="{{ $Role->name }}" type="text" name="name" placeholder="Role Name"
                                class=" border-grey-300 text-[#1b1b18] shadow-sm w-1/2 rounded-lg" id="">
                            @error('name')
                                <p class="text-gray-900 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Permissions</th>
                               
                                    @foreach ($permisisontypes as $group_names => $group_permissions)
                                    <th scope="col">{{ $group_names }}</th>
                                    @endforeach
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $group_name => $group_permissions)
                                    <tr>
                                        <td>{{ $group_name }}</td>
                                        @foreach ($group_permissions as $permission)
                                            <td>
                                                <input {{ ($hasPermissions->contains($permission->name)) ? 'checked' : '' }}
                                                    type="checkbox" class='permission' id='permission-{{ $permission->id }}'
                                                    value="{{ $permission->name}}" name="permission[]">
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="bg-gray-500 text-sm rounded-md px-5 py-2">add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.allcheck').change(function () {
            if ($(this).is(':checked')) {
                $(`input[data-group='${$(this).attr('data-group')}']`).prop('checked', true)
            } else {
                $(`input[data-group='${$(this).attr('data-group')}']`).prop('checked', false)
            }
        })
    </script>
@endsection