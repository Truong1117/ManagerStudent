@extends('layouts.master')

@section('title')
Edit Registered| Funda of Web IT
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Role for Registered User.</h3>
            </div>
            <div class="card-body">

                <form action="/roleRegister/{{$users->id}}/update" method="POST" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{$users->name}}" class="form-control">
                    </div>
                    <select name="usertype" id="" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="vendor">Vendor</option>
                        <option value="">None</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/roleRegister" class="btn btn-danger">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection