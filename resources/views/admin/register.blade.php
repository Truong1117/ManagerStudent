@extends('layouts.master')

@section('title')
Registered Roles | Funda of Web IT
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Registerd Roles</h4>
            </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead class=" text-primary">
                            <th>
                                No
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Usertype
                            </th>
                            <th class="text-center" width="150px">
                                <a href="#" id="#create-modal" class="create-modal btn btn-success" btn-sm data-toggle="modal" data-target="#createModalUser">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </th>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($users as $user)
                            <tr class="user{{$user->id}}">
                                <td>
                                    {{$no++}}
                                </td>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->phone}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    -{{$user->usertype}}
                                </td>
                                <td class="d-flex pb-3">
                                    <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$user->id}}" data-name="{{$user->name}}" data-phone="{{$user->phone}}" data-email="{{$user->email}}" data-usertype="{{$user->usertype}}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="roleRegister/{{$user->id}}/edit" class="mx-2 edit-modal btn btn-info btn-warning btn-sm" data-id="{{$user->id}}" data-title="{{$user->name}}" data-body="{{$user->phone}}" data-email="{{$user->email}}" data-usertype="{{$user->usertype}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="roleRegister/{{$user->id}}/delete" method="POST">
                                        @csrf
                                        <button class="delete-modal btn btn-info btn-danger btn-sm" data-id="{{$user->id}}" data-title="{{$user->name}}" data-body="{{$user->phone}}" data-email="{{$user->email}}" data-usertype="{{$user->usertype}}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createModalUser" tabindex="-1" role="dialog" aria-labelledby="createModalUser" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <p class="error text-center alert alert-danger hidden">Bạn không được để trống</p>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone :</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                        <p class="error text-center alert alert-danger hidden" > </p>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Email :</label>
                        <input class="form-control" name="email" id="email">
                        <p class="error text-center alert alert-danger hidden" >Email đã có người sử dụng</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="addUser" class="btn btn-primary">Save create</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // {{-- ajax Form Add Post--}}
    $(document).on('click', '.create-modal', function() {
        $('#createModalUser').modal('show');
        $('.form-horizontal').show();
        $('.modal-title').text('Add Post');
    });
    $("#addUser").click(function() {
        //Ví dụ có 1 input đều mình nê đặt id cho nó, đầu tiên lấy giá trị từ input id trươc
        // Thu 2 la gan gia tri sai o data
        var name = $('#name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        $.ajax({
            type: 'POST',
            url: 'roleRegister/addUser',
            data: {
                '_token': '{{ csrf_token() }}',
                name: name,
                phone: phone,
                email: email,
            },
            success: function(data) {

                if ((data.errors)) {
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                    $('.error').text(data.errors.phone);
                    $('.error').text(data.errors.email);
                } else {
                    $('.error').remove();
                    $('#table').append("<tr class='user" + data.id + "'>" +
                        "<td>" + data.id + "</td>" +
                        "<td>" + data.name + "</td>" +
                        "<td>" + data.phone + "</td>" +
                        "<td>" + data.email + "</td>" +
                        "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-phone='" + data.phone + "' data-email='" + data.email + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-phone='" + data.phone + "' data-email='" + data.email + "'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-phone='" + data.phone + "' data-email='" + data.email + "'><span class='glyphicon glyphicon-trash'></span></button></td>" +
                        "</tr>");
                }
            },
        });
        $('#name').val('');
        $('#phone').val('');
        $('#email').val('');
    });
</script>
@endsection