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
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">Pozitie</th>
                            <th class="text-center">Nume</th>
                            <th class="text-center">Perioada</th>
                            <th class="text-center">Locatie</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $calendar_regata)
                        <tr class="item{{$calendar_regata->id}}">
                            <td class="text-center">{{$calendar_regata->pozitie}}</td>
                            <td class="text-center">{{$calendar_regata->nume}}</td>
                            <td class="text-center">{{$calendar_regata->perioada}}</td>
                            <td class="text-center">{{$calendar_regata->locatie}}</td>
                     
                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-calendar="{{json_encode($calendar_regata)}}" data-toggle="modal" data-target="#calendarEditModal">
                                    Edit
                                </button>
                                <button class="btn btn-danger" type="button" data-calendar="{{json_encode($calendar_regata)}}" data-toggle="modal" data-target="#calendarDeleteModal">
                                    <i class="fas fa-trash fa-sm"></i> Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<div class="modal fade" id="calendarEditModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Calendar regate</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('regattacalendar.edit')}}" id="form_calendar_edit" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nume">Pozitie</label>
                                <input type="text" class="form-control" id="pozitie" name="pozitie" placeholder="" value="">
                            </div>
                            <div class="form-group">
                                <label for="nume">Nume</label>
                                <input type="text" class="form-control" id="nume" name="nume" placeholder="" value="">
                                <input type="hidden" id="calendarEditId" name="calendarEditId" value="{{old('calendarEditId')}}" />
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

                  
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>
</div>

<div class="modal fade" id="calendarDeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sterge calendar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('regattacalendar.delete')}}" id="form_calendar_delete" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="calendarDeleteId" name="calendarDeleteId" value="" />
                        <p>Vrei sa stergi calendarul: <span id="calendarDeleteName"></span>?</p>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Nu</button>
                    <button type="submit" class="btn btn-primary">Da</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
