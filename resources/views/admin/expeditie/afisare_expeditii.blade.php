@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content expeditie">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 ">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">Pozitie</th>
                            <th class="text-center">Nume</th>
                            <th class="text-center">Descriere</th>
                            <th class="text-center">Perioada</th>
                            <th class="text-center">Skipper</th>
                            <th class="text-center">Pret</th>
                            <th class="text-center">Imagine</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $expeditie)
                        <tr class="item{{$expeditie->id}}">
                            <td class="text-center">{{$expeditie->pozitie}}</td>
                            <td class="text-center">{{$expeditie->nume}}</td>
                            <td class="text-center">{!!$expeditie->descriere!!}</td>
                            <td class="text-center">{{$expeditie->perioada}}</td>
                            <td class="text-center">{{$expeditie->skipper}}</td>
                            <td class="text-center">{{$expeditie->pret}}</td>
                            <td class="text-center"> <img src="/files/{{$expeditie->imagine}}" class="expeditie_image" alt=""></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-expeditie="{{json_encode($expeditie)}}" data-toggle="modal" data-target="#expeditionEditModal">
                                    Edit
                                </button>
                                <button class="btn btn-danger" type="button" data-expeditie="{{json_encode($expeditie)}}" data-toggle="modal" data-target="#expeditionDeleteModal">
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

<div class="modal fade" id="expeditionEditModal">
    <div class="expeditie">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Expeditie</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
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
                                    <input type="hidden" id="expeditionEditId" name="expeditionEditId" value="{{old('expeditionEditId')}}" />
                                </div>

                                <div class="form-group">
                                    <label for="nume">Locatie</label>
                                    <input type="text" class="form-control" id="locatie" name="locatie" placeholder="" value="">
                                </div>

                                <div class="form-group">
                                    <label for="modelBarcaSelectat">Model Barca</label>
                                    <select class="form-control" name="modelBarcaSelectat" id="modelBarcaSelectat">
                                        <option>Selecteaza model barca</option>
                                        @foreach ($boats as $boat)
                                        <option value="{{ $boat->model }}"> {{ $boat->model }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="perioada_expeditie">Perioada</label>
                                    <p class="check_in"></p>
                                    <p class="check_out"></p>
                                    <input type="text" class="form-control" id="perioada_expeditie" name="perioada_expeditie" placeholder="" value="" readonly>
                                </div>

                                <div class="form-group">
                                <div class="lista_itinerarii"></div>
                                </div>
                            </div>

                            <div class="col mt-3 mb-5 me-3">
                                <div class="form-group">
                                    <label for="skipper">Skipper</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <input type="checkbox" id="skipper">
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="skipper-text" name="skipper">
                                    </div>
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

                                <div class="form-group mt-5">
                                    <label for="servicii_incluse">Servicii incluse</label>
                                    <textarea class="form-control" id="servicii_incluse" name="servicii_incluse" rows="2" placeholder="Enter ..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="check_in">Check-in</label>
                                    <div class='input-group date'>
                                        <input type='text' class="form-control" id="check_in" name="check_in" value />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="check_out">Check-out</label>
                                    <div class="input-group date" id="datepicker">
                                        <input type="text" class="form-control" id="check_out" name="check_out" value>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" id="editExpedition">Save changes</button>
                        </div>
                    </div>
             
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </div>
<!-- /.modal -->
    </div>
</div>


<div class="modal fade" id="expeditionDeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sterge expeditie</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('expedition.delete')}}" id="form_expedition_delete" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="expeditionDeleteId" name="expeditionDeleteId" value="" />
                        <p>Vrei sa stergi expeditia: <span id="expeditionDeleteName"></span>?</p>
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
