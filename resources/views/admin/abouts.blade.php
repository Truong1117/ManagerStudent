@extends('layouts.master')

@section('title')
About Us | Funda o f Web IT
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> This is About Us page</h4>
            </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table">
                        <thead class=" text-primary">
                            <th class="w-10">
                                Id
                            </th>
                            <th class="w-25">
                                Title
                            </th>
                            <th class="w-25">
                                Sub-Title
                            </th>
                            <th class="text-right w-25">
                                Description
                            </th>
                            <th class="text-center" width="150px">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" s>
                                    <i class="fas fa-plus"></i>
                                </button>
                            </th>
                        </thead>
                        <tbody>
                            @foreach($abouts as $about)
                            <tr>
                                <td>{{$about->id}}</td>
                                <td>{{$about->title}}</td>
                                <td>{{$about->subtitle}}</td>
                                <td>
                                    <div style="height:67px; overflow:hidden;">
                                        {{$about->description}}
                                    </div>
                                </td>
                                <td class="d-flex pb-3">
                                    <a href="#" class="show-modal btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ url('about-us/'.$about->id)}}" class="mx-2 edit-modal btn btn-info btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <button class="deletebtn btn btn-info btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </a>
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
<!-- Modal form add table abouts -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Abouts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/save-aboutus" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Title :</label>
                        <input type="text" name="title" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Sub-Title :</label>
                        <input type="text" name="subtitle" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <textarea name="description" class="form-control" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="deletemodalpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delete_modal_form" method="POST">
                @csrf

                <div class="modal-body">
                    <input type="hidden" id="delete_aboutus_id">
                    <h5> Are you sure? You want to delete data?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes, Delete it.</button>
                </div>
            </form>
        </div>  
    </div>
</div>

<!-- Modal form add table abouts -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Abouts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/save-aboutus" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Title :</label>
                        <input type="text" name="title" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Sub-Title :</label>
                        <input type="text" name="subtitle" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <textarea name="description" class="form-control" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
       
        $('#dataTable').on('click','.deletebtn',function(){

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            // console.log(data);

            $('#delete_aboutus_id').val(data[0]);

            $('#delete_modal_form').attr('action', '/about-us-delete/'+data[0]);

            $('#deletemodalpop').modal('show');
        });
    });
</script>
@endsection