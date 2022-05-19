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
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Adauga sezon regate</h3>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nume">Nume</label>
                                    <input type="text" class="form-control" id="nume" name="nume" placeholder="" value="">
                                </div>

                                <div class="form-group">
                                    <label for="descriere">Descriere</label>
                                    <textarea class="form-control" id="descriere" name="descriere" rows="2" placeholder="Enter ..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="nivel_performanta">Nivel performata</label>
                                    <input type="text" class="form-control" id="nivel_performanta" name="nivel_performanta" placeholder="" value="">
                                </div>

                                <div class="form-group">
                                    {{-- <label for="model">Model</label>
                                    <input type="text" class="form-control" id="model" name="model" placeholder=""> --}}
                                    <select class="form-control" name="modelBarcaSelectat" id="modelBarcaSelectat">
                                        <option>Selecteaza model barca</option>
                                            @foreach ($boats as $boat)
                                                <option value="{{ $boat->model }}"> {{ $boat->model }} </option>
                                            @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="an_fabricatie">Anul fabricatiei</label>
                                    <select class="custom-select form-control-border" id="an_fabricatie" name="an_fabricatie">
                                        @foreach($ani_fabricatie as $an)
                                        <option>{{$an}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col mt-3 mb-5 me-3">
                            <div class="form-group">
                                <label for="pret">Pret</label>
                                <input type="text" class="form-control" id="pret" name="pret" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="inceput_sezon">Inceput sezon</label>
                                <div class='input-group date'>
                                    <input type='text' class="form-control" id="inceput_sezon" name="inceput_sezon" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="final_sezon">Final sezon</label>
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
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-primary" id="addRegattaSeason">Submit</button>
                        </div>
                        <!-- </form> -->
                    </div>

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    @endsection

