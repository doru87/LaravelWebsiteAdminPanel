@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
   
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content jurnal">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Adauga jurnal</h3>
                    </div>
                    <div class="col-6">
                        <div class="mt-5 mb-5">
                            <select class="form-control" name="resoureceName" id="evenimentSelectat">
                                <option>Selecteaza eveniment</option>
                                @foreach ($customEvents as $customEvent)
                                <option value="{{ $customEvent->id }}"> {{ $customEvent->nume }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="hidden_diary" id="diary">
                        <div class="row">
                            <div class="col">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nume">Pozitie</label>
                                        <input type="text" class="form-control" id="pozitie" name="pozitie" placeholder="" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="nume">Nume eveniment</label>
                                        <input type="text" class="form-control" id="nume" name="nume" placeholder="" value="" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="descriere">Descriere</label>
                                        <textarea class="form-control" id="descriere" name="descriere" rows="2" placeholder="Enter ..."></textarea>
                                        <input type="hidden" id="eventId" name="eventId" />
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

                                </div>
                            </div>
                            <div class="col mt-3 mb-5 me-3">
                                <div class="form-group">
                                    <label for="itinerariu">Itinerariu</label>
                                    <input type="text" class="form-control" id="itinerariu" name="itinerariu" placeholder="" value="" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="imagine">Imagine</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="imagine" name="imagine" readonly>
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
                                                <input type="file" class="custom-file-input" id="imagini" name="imagini[]" multiple="multiple" readonly>
                                                <label class="custom-file-label" for="imagini">Alege imagini</label>
                                                <div id="galerie" class="d-flex"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-primary" id="addDiary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    @endsection
