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
                            <th class="text-center">Nume</th>
                            <th class="text-center">Model</th>
                            <th class="text-center">Descriere</th>
                            <th class="text-center">Nivel performanta</th>
                            <th class="text-center">An fabricatie</th>
                            <th class="text-center">Pret</th>
                            <th class="text-center">Imagine</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $sezonregate)
                        <tr class="item{{$sezonregate->id}}">
                            <td class="text-center nume">{{$sezonregate->nume}}</td>
                            <td class="text-center model">{{$sezonregate->model}}</td>
                            <td class="text-center descriere">{{$sezonregate->descriere}}</td>
                            <td class="text-center nivel_performanta">{{$sezonregate->nivel_performanta}}</td>
                            <td class="text-center an_fabricatie">{{$sezonregate->an_fabricatie}}</td>
                            <td class="text-center pret">{{$sezonregate->pret}}</td>
                            <td class="text-center"> <img src="/files/{{$sezonregate->imagine}}" class="regata_image" alt=""></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-sezonregate="{{json_encode($sezonregate)}}" data-toggle="modal" data-target="#regattaSeasonEditModal">
                                    Edit
                                </button>
                                <button class="btn btn-danger" type="button" data-sezonregate="{{json_encode($sezonregate)}}" data-toggle="modal" data-target="#regattaSeasonDeleteModal">
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

<div class="modal fade" id="regattaSeasonEditModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('regattaseason.edit')}}" id="form_regattaseason_edit" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nume">Nume</label>
                                <input type="text" class="form-control" id="nume" name="nume" placeholder="" value="">
                            </div>

                            <div class="form-group">
                                <label for="descriere">Descriere</label>
                                <textarea class="form-control" id="descriere" name="descriere" rows="2" placeholder="Enter ..."></textarea>
                                <input type="hidden" id="regattaSeasonEditId" name="regattaSeasonEditId" value="{{old('')}}" />
                            </div>

                            <div class="form-group">
                                <label for="nivel_performanta">Nivel performata</label>
                                <input type="text" class="form-control" id="nivel_performanta" name="nivel_performanta" placeholder="" value="">
                            </div>

                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="an_fabricatie">Anul fabricatiei</label>
                                <select class="custom-select form-control-border" id="an_fabricatie" name="an_fabricatie">
                                    @foreach($ani_fabricatie as $an)
                                    <option>{{$an}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pret">Pret</label>
                                <input type="text" class="form-control" id="pret" name="pret" placeholder="">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="check_in">Inceput sezon</label>
                                <div class='input-group date'>
                                    <input type='text' class="form-control" id="inceput_sezon" name="inceput_sezon" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="check_out">Final sezon</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="text" class="form-control" id="final_sezon" name="final_sezon">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="imagine">Imagine</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imagine" name="imagine">
                                        <label class="custom-file-label" for="imagine">Alege imagine</label>
                                        <div id="previzualizare_imagine" class="d-flex justify-items-center"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-5 mb-5">
                                <div class="input-group">
                                    <label for="imagini">Galerie imagini</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="imagini" name="imagini[]" multiple="multiple">
                                            <label class="custom-file-label" for="imagini">Alege imagini</label>
                                            <div id="galerie" class="d-flex"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pret">Locatie</label>
                                <input type="text" class="form-control" id="locatie" name="locatie" placeholder="">
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

<div class="modal fade" id="regattaSeasonDeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sterge regata</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('regattaseason.delete')}}" id="form_regattaseason_delete" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="regattaSeasonDeleteId" name="regattaSeasonDeleteId" value="" />
                        <p>Vrei sa stergi regata: <span id="regattaSeasonDeleteName"></span>?</p>
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