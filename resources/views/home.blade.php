@extends('layouts.app')

@section('content')
    <script src="{{mix('/js/home.js')}}"></script>
    <script>
        window.getUsersMessagesUrl = '{{ route('getUsersMessages') }}';
    </script>
    <div class="container">
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('eatUsers') }}">
            @csrf

            <div class="card row" style="margin-top: 3em">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <button id="btn-search" data-action="{{ route('sortAllUsers') }}" class="card-title" title="Search by Name, Last Name and Location" >Search</button>
                    <button id="btn-mark-eaten" class="card-title" type="submit" title="Mark as 'Eaten'" name="eaten" >Eaten</button>

                    <table class="user-table col-xl-12 table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Date of birth</th>
                            <th scope="col">Location</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Date last login</th>
                            <th scope="col">'Eaten'</th>
                            <th scope="col">Send messages</th>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">
                                <input type="text" class="form-control" placeholder="Name" name="name">
                            </th>
                            <th scope="col"><input type="text" class="form-control" placeholder="Last Name" name="last_name"></th>
                            <th scope="col"></th>
                            <th scope="col"><input type="text" class="form-control" placeholder="Location" name="location"></th>
                            <th scope="col"></th>
                            <th scope="col" class="text-center">
                                <button id="btn-sorting" class="btn btn-secondary" data-action="{{ route('sortAllUsers') }}" data-sort="asc"><i class="glyphicon glyphicon-sort" aria-hidden="true"></i></button>
                            </th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>

                        <tbody id="body-table">
                        @php($numRow = 1)
                        @foreach($users as $user)
                            <tr>
                                <th scope="row"> {{ $numRow }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->dob }}</td>
                                <td>{{ $user->location }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->last_login_at }}</td>
                                <td class="text-center"><input type="checkbox" aria-label="Checkbox for 'Eaten'" class="check-eaten" data-user="{{$user->id}}" {{!empty($user->eaten) ? 'checked disabled' : ''}}></td>
                                <td>
                                    <button type="button" class="show-messages btn btn-secondary" data-action="{{ route('getUsersMessages') }}" data-user="{{$user->id}}" data-toggle="modal" data-target="#modalMessages">Send Message</button>
                                </td>
                            </tr>
                            @php($numRow++)
                        @endforeach
                        </tbody>
                    </table>

                    <div class="modal" id="modalMessages" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Dialog</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body d-flex justify-content-center modal-height">
                                    <div class="roller-container">
                                        <div class="lds-roller">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                                    <div class="container-fluid"></div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row w-100">
                                        <div class="col-10">
                                            <label for="message-box" class="col-form-label">Message:</label>
                                            <textarea class="form-control h-auto" id="message-box" placeholder="Enter message:"></textarea>
                                        </div>
                                        <div class="col-2 text-center">
                                            <button id="btn-send-new-message" class="btn btn-primary" data-action="{{ route('saveNewUsersMessage') }}">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="messages col-xl-12 msg-margin">
            </div>
        </form>
    </div>
</div>
@endsection
