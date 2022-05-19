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
                            <th class="text-center">Model</th>
                            <th class="text-center">An fabricatie</th>
                            <th class="text-center">Capacitate</th>
                            <th class="text-center">Layout</th>
                            <th class="text-center">Imagine</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $barca)
                        <tr class="item{{$barca->id}}">
                            <td class="text-center">{{$barca->pozitie}}</td>
                            <td class="text-center">{{$barca->nume}}</td>
                            <td class="text-center">{{$barca->model}}</td>
                            <td class="text-center">{{$barca->an_fabricatie}}</td>
                            <td class="text-center">{{$barca->capacitate}}</td>
                            <td class="text-center">{{$barca->layout}}</td>
                            <td class="text-center"> <img src="/files/{{$barca->imagine}}" class="barca_image" alt=""></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-boat="{{json_encode($barca)}}" data-toggle="modal" data-target="#boatEditModal">
                                    Edit
                                </button>
                                <button class="btn btn-danger" type="button" data-boat="{{json_encode($barca)}}" data-toggle="modal" data-target="#boatDeleteModal">
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

<div class="modal fade barca" id="boatEditModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Barca</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('boat.edit')}}" id="form_boat_edit" method="POST" enctype="multipart/form-data">
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
                                <label for="nume">Nume barca</label>
                                <input type="text" class="form-control" id="nume" name="nume" placeholder="" value="">
                            </div>
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model" placeholder="" value="{{old('model')}}">
                                <input type="hidden" id="boatEditId" name="boatEditId" value="{{old('boatEditId')}}" />
                            </div>
                            <div class="form-group">
                                <label for="an_fabricatie">Anul fabricatiei</label>
                                <select class="custom-select form-control-border" id="an_fabricatie" name="an_fabricatie" value="{{old('an_fabricatie')}}">
                                    @foreach($ani_fabricatie as $an)
                                    <option>{{$an}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="capacitate">Capacitate</label>
                                <select class="custom-select form-control-border" id="capacitate" name="capacitate">
                                    @foreach($capacitate_persoane as $capacitate)
                                    <option>{{$capacitate}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="layout">Layout</label>
                                <input type="text" class="form-control" id="layout" name="layout" placeholder="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="descriere">Descriere</label>
                                <textarea class="form-control" id="descriere" name="descriere" rows="2" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="wc_dus">WC cu dus</label>
                                <select class="custom-select form-control-border" id="wc_dus" name="wc_dus">
                                    @foreach($wc_dus as $wc)
                                    <option>{{$wc}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lungime">Lungime</label>
                                <input type="text" class="form-control" id="lungime" name="lungime" placeholder="" value="">
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
                            <div class="form-group mt-5">
                                <label for="imagini">Galerie Imagini</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imagini" name="imagini[]" multiple="multiple">
                                        <label class="custom-file-label" for="imagini">Alege imagini</label>
                                        <div id="galerie" class="d-flex"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="punte_cockpit">Dotari punte si cockpit</label>
                                <textarea class="form-control" id="punte_cockpit" name="punte_cockpit" rows="2" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="bucatarie_salon">Dotari bucatarie si salon</label>
                                <textarea class="form-control" id="bucatarie_salon" name="bucatarie_salon" rows="2" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="cabine">Dotari cabine</label>
                                <textarea class="form-control" id="cabine" name="cabine" rows="2" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="echipament_navigatie">Echipament de navigatie</label>
                                <textarea class="form-control" id="echipament_navigatie" name="echipament_navigatie" rows="2" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="echipament_siguranta">Echipament de siguranta</label>
                                <textarea class="form-control" id="echipament_siguranta" name="echipament_siguranta" rows="2" placeholder="Enter ..."></textarea>
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


<div class="modal fade" id="boatDeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sterge barca</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('boat.delete')}}" id="form_delete" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="boatDeleteId" name="boatDeleteId" value="" />
                        <p>Vrei sa stergi barca: <span id="boatDeleteName"></span>?</p>
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
