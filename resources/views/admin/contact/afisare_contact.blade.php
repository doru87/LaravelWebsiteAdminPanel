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
                            <th class="text-center">Email</th>
                            <th class="text-center">Telefon</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $contact)
                        <tr class="item{{$contact->id}}">
                            <td class="text-center">{{$contact->nume}}</td>
                            <td class="text-center">{{$contact->email}}</td>
                            <td class="text-center">{{$contact->telefon}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-contact="{{json_encode($contact)}}" data-toggle="modal" data-target="#contactViewModal">
                                    View
                                </button>
                                <button class="btn btn-danger" type="button" data-contact="{{json_encode($contact)}}" data-toggle="modal" data-target="#contactDeleteModal">
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

<div class="modal fade" id="contactViewModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Mesaje contact</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nume">Nume</label>
                                <input type="text" class="form-control" id="nume" name="nume" placeholder="" value="">
                                <input type="hidden" id="contactId" name="contactId" value="{{old('')}}" />
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="" value="">
                            </div>
                            
                            <div class="form-group">
                                <label for="telefon">Telefon</label>
                                <input type="text" class="form-control" id="telefon" name="telefon" placeholder="" value="">
                            </div>
                            <div class="form-group">
                                <label for="mesaj">Mesaj</label>
                                <textarea class="form-control" id="mesaj" name="mesaj" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>


<div class="modal fade" id="contactDeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sterge mesaje</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('contact.delete')}}" id="form_contact_delete" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="contactDeleteId" name="contactDeleteId" value="" />
                        <p>Vrei sa stergi mesajul ?</p>
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
