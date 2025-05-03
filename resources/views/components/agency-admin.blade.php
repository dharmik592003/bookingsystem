
 
        <main class="app-main">
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-6">
                            <div class="small-box text-bg-warning">
                                <div class="inner">
                                    <h3>{{ $usercount  }}</h3>
                                    <p>agency Registrations</p>
                                </div>
                                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path
                                        d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z">
                                    </path>
                                </svg>
                                        <button type="button" id="" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#myModal">
                                    add agency
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $list)
                                    <tr>
                                        <td>{{ $loop->index + 1  }}</td>
                                        <td>{{ $list->name }}</td>
                                        
                                        <td>{{ $list->user->email }}</td>
                                        <td>
                                            <a href="" class="btn btn-success">edit</a>
                                            <a class="btn btn-danger" href="{{ route('customer.delete',[$user->id]) }}">delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">

                                <div class="mb-3" id="mainform">
                                    <div id="contant">
                                    <form action="/addagency" method="post">
                                @csrf
                                <!-- User Type Selection -->
                                <div class="mb-3">
                                    
                                        <div class="form-check">
                                            <input class="role form-check-input" checked type="radio" name="role" id="agency"
                                                value="3">
                                            <label class="form-check-label" for="agency">Agency</label>
                                        </div>
                                   
                                </div>

                                <!-- Common Fields -->
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullname" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>


                                <!-- Agency-Specific Fields (Hidden by Default) -->
                                <div id="agencyFields" >
                                    <div class="mb-3">
                                        <label for="agencyName" class="form-label">Agency Name</label>
                                        <input type="text" class="form-control" id="agencyName" name="agencyname">
                                    </div>
                                    <div class="agencyname flex-column align-items-center mb-4">
                                        
                                        
                                        <label for="">State</label>
                                        <select name="state_id" onchange="upd()" class="form-select" id="inputState2">
                                            <option value="">Select State</option>
                                        </select>
                                        <label for="">City</label>
                                        <select name="city_id" class="form-select" id="inputcities">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-warning w-100 mb-3">add</button>
                            </form>
                                       
                                    </div>
                                </div>



                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
        </main>

        <!--end::Footer-->
