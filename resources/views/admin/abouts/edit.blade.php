@extends('layouts.master')

@section('title')
About Us Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> About us - Edit data</h4>
                </div>
                <form action=" {{ url('aboutus-update/'.$aboutus->id )}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Title :</label>
                        <input type="text" name="title" class="form-control" value="{{ $aboutus->title}}">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Sub-Title :</label>
                        <input type="text" name="subtitle" class="form-control" value="{{ $aboutus->subtitle}}">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <textarea name="description" class="form-control">{{ $aboutus->description}}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('abouts')}}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection