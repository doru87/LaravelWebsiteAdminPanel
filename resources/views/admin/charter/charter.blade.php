@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="charter">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Adauga charter</h3>
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
                                        <label for="descriere">Descriere</label>
                                        <textarea class="form-control" id="descriere" name="descriere" rows="2" placeholder="Enter ..."></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="perioada">Perioada</label>
                                        <input type="text" class="form-control" id="perioada" name="perioada" placeholder="" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="capacitate">Capacitate</label>
                                        <select class="custom-select form-control-border" id="capacitate" name="capacitate">
                                            @foreach($capacitate_charter as $capacitate)
                                            <option>{{$capacitate}}</option>

                                            @endforeach
                                        </select>
                                    </div>

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
                                        <input type="text" class="form-control" id="skipper-text" name="skipper-text" value="Nu e inclus" readonly>
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

                                {{-- <div class="form-group">
                                    <label for="check_in">Check-in</label>
                                    <div class='input-group date'>
                                        <input type='text' class="form-control" id="check_in" name="check_in" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="check_out">Check-out</label>
                                    <div class="input-group date" id="datepicker">
                                        <input type="text" class="form-control" id="check_out" name="check_out">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div> --}}
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-primary" id="addCharter">Submit</button>
                        </div>
                        </form>
                    </div>

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection
