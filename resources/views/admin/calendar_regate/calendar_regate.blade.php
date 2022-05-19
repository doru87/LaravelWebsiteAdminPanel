@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="charter">
    <div class="content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Adauga calendar</h3>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nume">Pozitie</label>
                                        <input type="text" class="form-control" id="pozitie" name="pozitie" placeholder="" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="nume">Nume</label>
                                        <input type="text" class="form-control" id="nume" name="nume" placeholder="" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="inceput_perioada">Inceput perioada</label>
                                        <div class='input-group date'>
                                            <input type='text' class="form-control" id="inceput_perioada" name="inceput_perioada" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="final_perioada">Final perioada</label>
                                        <div class="input-group date" id="datepicker">
                                            <input type="text" class="form-control" id="final_perioada" name="final_perioada">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="locatie">Locatie</label>
                                        <textarea class="form-control" id="locatie" name="locatie" rows="2" placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" id="addCalendar">Submit</button>
                                </div>
                            </div>
               
                    </div>

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection
