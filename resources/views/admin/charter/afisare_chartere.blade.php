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
                            <th class="text-center">Descriere</th>
                            <th class="text-center">Perioada</th>
                            <th class="text-center">Capacitate</th>
                            <th class="text-center">Skipper</th>
                            <th class="text-center">Pret</th>
                            <th class="text-center">Imagine</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $charter)
                        <tr class="item{{$charter->id}}">
                            <td class="text-center">{{$charter->pozitie}}</td>
                            <td class="text-center">{{$charter->nume}}</td>
                            <td class="text-center">{!!$charter->descriere!!}</td>
                            <td class="text-center">{{$charter->perioada}}</td>
                            <td class="text-center">{{$charter->capacitate}}</td>
                            <td class="text-center">{{$charter->skipper}}</td>
                            <td class="text-center">{{$charter->pret}}</td>
                            <td class="text-center"> <img src="/files/{{$charter->imagine}}" class="charter_image" alt=""></td>

                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-charter="{{json_encode($charter)}}" data-toggle="modal" data-target="#charterEditModal">
                                    Edit
                                </button>
                                <button class="btn btn-danger" type="button" data-charter="{{json_encode($charter)}}" data-toggle="modal" data-target="#charterDeleteModal">
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

<div class="modal fade charter" id="charterEditModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Charter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('charter.edit')}}" id="form_charter_edit" method="POST" enctype="multipart/form-data">
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
                                <input type="hidden" id="charterEditId" name="charterEditId" value="{{old('charterEditId')}}" />
                            </div>

                            <div class="form-group">
                                <label for="perioada">Perioada</label>
                                <input type="text" class="form-control" id="perioada" name="perioada" placeholder="" value="">
                            </div>

                            <div class="form-group">
                                <label for="capacitate">Capacitate persoane</label>
                                <select class="custom-select form-control-border" id="capacitate" name="capacitate">
                                    @foreach($capacitate_charter as $capacitate)
                                    <option>{{$capacitate}}</option>
                                    @endforeach
                                </select>
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

<div class="modal fade" id="charterDeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sterge charter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('charter.delete')}}" id="form_charter_delete" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="charterDeleteId" name="charterDeleteId" value="" />
                        <p>Vrei sa stergi charter-ul: <span id="charterDeleteName"></span>?</p>
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
