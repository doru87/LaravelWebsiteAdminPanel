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
                            <th class="text-center">Destinatie</th>
                            <th class="text-center">Descriere</th>
                            <th class="text-center">Imagine</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $event)
                        <tr class="item{{$event->id}}">
                            <td class="text-center">{{$event->pozitie}}</td>
                            <td class="text-center">{{$event->nume}}</td>
                            <td class="text-center">{{$event->destinatie}}</td>
                            <td class="text-center">{!!$event->descriere!!}</td>
                            <td class="text-center"> <img src="/files/{{$event->imagine}}" class="event_image" alt=""></td>

                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-event="{{json_encode($event)}}" data-toggle="modal" data-target="#eventEditModal">
                                    Edit
                                </button>
                                <button class="btn btn-danger" type="button" data-event="{{json_encode($event)}}" data-toggle="modal" data-target="#eventDeleteModal">
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

<div class="modal fade eveniment" id="eventEditModal">
    <div class="col-lg-6 col-md-6 mx-auto">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Eveniment personalizat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('event.edit')}}" id="form_event_edit" method="POST" enctype="multipart/form-data">
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
                                <label for="destinatie">Destinatie</label>
                                <input type="text" class="form-control" id="destinatie" name="destinatie" placeholder="" value="">
                            </div>

                            <div class="form-group">
                                <label for="descriere">Descriere</label>
                                <textarea class="form-control" id="descriere" name="descriere" rows="2" placeholder="Enter ..."></textarea>
                                <input type="hidden" id="eventEditId" name="eventEditId" value="{{old('')}}" />
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
                <div class="modal-footer justify-content-between mt-3">
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


<div class="modal fade" id="eventDeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sterge eveniment personalizat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('event.delete')}}" id="form_event_delete" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="eventDeleteId" name="eventDeleteId" value="" />
                        <p>Vrei sa stergi evenimentul personalizat: <span id="eventDeleteName"></span>?</p>
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
