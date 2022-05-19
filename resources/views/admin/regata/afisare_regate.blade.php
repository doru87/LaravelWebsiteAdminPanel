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
            <div class="col-lg-12">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">Pozitie</th>
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
                        @foreach($data as $regatta)
                        @if ($regatta !== null)
                        <tr class="item{{$regatta->id}}">
                            <td class="text-center">{{$regatta->pozitie}}</td>
                            <td class="text-center">{{$regatta->nume}}</td>
                            <td class="text-center">{{$regatta->model}}</td>
                            <td class="text-center">{!!$regatta->descriere!!}</td>
                            <td class="text-center">{{$regatta->nivel_performanta}}</td>
                            <td class="text-center">{{$regatta->an_fabricatie}}</td>
                            <td class="text-center">{{$regatta->pret}}</td>
                            <td class="text-center"> <img src="/files/{{$regatta->imagine}}" class="regata_image" alt=""></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-regatta="{{json_encode($regatta)}}" data-toggle="modal" data-target="#regattaEditModal">
                                    Edit
                                </button>
                                <button class="btn btn-danger" type="button" data-regatta="{{json_encode($regatta)}}" data-toggle="modal" data-target="#regattaDeleteModal">
                                    <i class="fas fa-trash fa-sm"></i> Delete</button>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<div class="modal fade regatta" id="regattaEditModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Regata</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('regatta.edit')}}" id="form_regatta_edit" method="POST" enctype="multipart/form-data">
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
                            </div>
      
                            <div class="form-group">
                                <label for="descriere">Descriere</label>
                                <textarea class="form-control" id="descriere" name="descriere" rows="2" placeholder="Enter ..."></textarea>
                                <input type="hidden" id="regattaEditId" name="regattaEditId" value="{{old('')}}" />
                            </div>

                            <div class="form-group">
                                <label for="nivel_performanta">Nivel performata</label>
                                <input type="text" class="form-control" id="nivel_performanta" name="nivel_performanta" placeholder="" value="">
                            </div>
                            <div class="form-group">
                                <label for="modelBarcaSelectat">Model barca</label>
                                <select class="form-control" name="modelBarcaSelectat" id="modelBarcaSelectat">
                                    <option value="0">Selecteaza model barca</option>
                                        @foreach ($boats as $boat)
                                            <option value="{{ $boat->model }}" class="{{ $boat->model }}">{{ $boat->model }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col">

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

<div class="modal fade" id="regattaDeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sterge regata</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('regatta.delete')}}" id="form_regatta_delete" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="regattaDeleteId" name="regattaDeleteId" value="" />
                        <p>Vrei sa stergi regata: <span id="regattaDeleteName"></span>?</p>
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