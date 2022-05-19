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
                            <th class="text-center">Tip activitate</th>
                            <th class="text-center">Durata</th>
                            <th class="text-center">Destinatie</th>
                            <th class="text-center">Imagine</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $corporate)
                        <tr class="item{{$corporate->id}}">
                            <td class="text-center">{{$corporate->pozitie}}</td>
                            <td class="text-center">{{$corporate->nume}}</td>
                            <td class="text-center">{!!$corporate->descriere!!}</td>
                            <td class="text-center">{{$corporate->tip_activitate}}</td>
                            <td class="text-center">{{$corporate->durata}}</td>
                            <td class="text-center">{{$corporate->destinatie}}</td>
                            <td class="text-center"> <img src="/files/{{$corporate->imagine}}" class="corporate_image" alt=""></td>

                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-corporate="{{json_encode($corporate)}}" data-toggle="modal" data-target="#corporateEditModal">
                                    Edit
                                </button>
                                <button class="btn btn-danger" type="button" data-corporate="{{json_encode($corporate)}}" data-toggle="modal" data-target="#corporateDeleteModal">
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

<div class="modal fade corporate" id="corporateEditModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Corporate</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('corporate.edit')}}" id="form_corporate_edit" method="POST" enctype="multipart/form-data">
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
                                <textarea class="form-control" id="descriere" name="descriere" rows="4" placeholder="Enter ..."></textarea>
                                <input type="hidden" id="corporateEditId" name="corporateEditId" value="{{old('')}}" />
                            </div>
                            
                            <div class="form-group">
                                <label for="tip_activitate">Tip activitate</label>
                                <textarea class="form-control" id="tip_activitate" name="tip_activitate" rows="2" placeholder="Enter ..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="durata">Durata</label>
                                <input type="text" class="form-control" id="durata" name="durata" placeholder="" value="">
                            </div>

                            <div class="form-group">
                                <label for="destinatie">Destinatie</label>
                                <input type="text" class="form-control" id="destinatie" name="destinatie" placeholder="" value="">
                            </div>

                            <div class="form-group">
                                <label for="capacitate">Capacitate</label>
                                <select class="custom-select form-control-border" id="capacitate" name="capacitate">
                                    @foreach($capacitate_corporate as $capacitate)
                                    <option>{{$capacitate}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col mt-3 mb-5 me-3">
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
                                <textarea class="form-control" id="servicii_incluse" name="servicii_incluse" rows="3" placeholder="Enter ..."></textarea>
                            </div>

                            <div class="form-group mt-5">
                                <label for="servicii_optionale">Servicii optionale</label>
                                <textarea class="form-control" id="servicii_optionale" name="servicii_optionale" rows="3" placeholder="Enter ..."></textarea>
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


<div class="modal fade" id="corporateDeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sterge eveniment corporate</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('corporate.delete')}}" id="form_corporate_delete" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="corporateDeleteId" name="corporateDeleteId" value="" />
                        <p>Vrei sa stergi evenimentul corporate: <span id="corporateDeleteName"></span>?</p>
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
