@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Adauga sectiunea Politica de confidentialitate</h3>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card-body">
                                <form action="{{ route('privacy-policy.create') }}" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <textarea name="editor-privacy-policy" id="editor-privacy-policy" cols="30" rows="10"></textarea>
                                        {{ csrf_field() }}
                                        <input class="btn btn-primary mt-2 politica-de-confidentialitate" value="Submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection
