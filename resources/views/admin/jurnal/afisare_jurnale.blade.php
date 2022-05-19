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
                            <th class="text-center">Descriere</th>
                            <th class="text-center">Inceput perioada</th>
                            <th class="text-center">Final perioada</th>
                            <th class="text-center">Itinerariu</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="diary_table">
                        @foreach($data as $jurnal)
                        <tr class="item{{$jurnal->id}}">
                            <td class="text-center">{{$jurnal->pozitie}}</td>
                            <td class="text-center">{!!$jurnal->descriere!!}</td>
                            <td class="text-center">{{$jurnal->inceput_perioada}}</td>
                            <td class="text-center">{{$jurnal->final_perioada}}</td>
                            <td class="text-center">{{$jurnal->itinerariu}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-jurnal="{{json_encode($jurnal)}}" data-toggle="modal" data-target="#diaryEditModal">
                                    Edit
                                </button>
                                <button class="btn btn-danger" type="button" data-jurnal="{{json_encode($jurnal)}}" data-toggle="modal" data-target="#diaryDeleteModal">
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

<div class="modal fade jurnal" id="diaryEditModal">
    <div class="col-lg-6 col-md-6 mx-auto">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Jurnal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('diary.edit')}}" id="form_diary_edit" method="POST" enctype="multipart/form-data">
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
                                    <label for="descriere">Descriere sumara</label>
                                    <textarea class="form-control" id="descriere" name="descriere" rows="2" placeholder="Enter ..."></textarea>
                                    <input type="hidden" id="diaryEditId" name="diaryEditId" />
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
                                    <label for="itinerariu">Itinerariu</label>
                                    <input type="text" class="form-control" id="itinerariu" name="itinerariu" placeholder="" value="">
                                </div>
                                
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

<div class="modal fade" id="diaryDeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sterge barca</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('diary.delete')}}" id="form_diary_delete" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="diaryDeleteId" name="diaryDeleteId" value="" />
                        <p>Vrei sa stergi jurnalul: <span id="diaryDeleteName"></span>?</p>
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
