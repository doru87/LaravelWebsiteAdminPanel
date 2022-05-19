@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content corporate">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Adauga eveniment corporate</h3>
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
                                <textarea class="form-control" id="servicii_incluse" name="servicii_incluse" rows="2" placeholder="Enter ..."></textarea>
                            </div>

                            <div class="form-group mt-5">
                                <label for="servicii_optionale">Servicii optionale</label>
                                <textarea class="form-control" id="servicii_optionale" name="servicii_optionale" rows="2" placeholder="Enter ..."></textarea>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button class="btn btn-primary" id="addCorporate">Submit</button>
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