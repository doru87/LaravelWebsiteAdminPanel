@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content barca">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Adauga barca</h3>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nume">Pozitie</label>
                                    <input type="text" class="form-control" id="pozitie" name="pozitie" placeholder="" value="">
                                </div>
                                <div class="form-group">
                                    <label for="nume">Nume</label>
                                    <input type="text" class="form-control" id="nume" name="nume" placeholder="" value="">
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
                        </div>
                        <div class="col mt-3">
                            <div class="form-group">
                                <label for="descriere">Descriere</label>
                                <textarea class="form-control" id="descriere" name="descriere" rows="3" placeholder="Enter ..."></textarea>
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
                            <div class="form-group">
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
                        <div class="col mt-3">
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
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button class="btn btn-primary" id="addBoat">Submit</button>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection