@extends('layouts.app')

@section('content')


<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Statistici</h3>
                    </div>
                    <div class="row">
                       
                        <!-- Main content -->
                        <section class="content mt-5">
                            <div class="container-fluid">
                            <!-- Small boxes (Stat box) -->
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                    <h3>{{$barci}}</h3>
                    
                                    <p>Barci</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="/admin/barca/listare" class="small-box-footer">Mai multe informatii <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                    <h3>{{$chartere}}</h3>
                    
                                    <p>Chartere</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="/admin/charter/listare" class="small-box-footer">Mai multe informatii <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                    <h3>{{$expeditii}}</h3>
                    
                                    <p>Expeditii</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="/admin/expeditie/listare" class="small-box-footer">Mai multe informatii <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                    <h3>{{$regate}}</h3>
                    
                                    <p>Regate</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="/admin/regata/listare" class="small-box-footer">Mai multe informatii <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-secondary">
                                    <div class="inner">
                                    <h3>{{$corporate}}</h3>
                    
                                    <p>Evenimente corporate</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="/admin/corporate/listare" class="small-box-footer">Mai multe informatii <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-light">
                                    <div class="inner">
                                    <h3>{{$evenimente}}</h3>
                    
                                    <p>Evenimente personalizate</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="/admin/eveniment-personalizat/listare" class="small-box-footer">Mai multe informatii <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-dark">
                                    <div class="inner">
                                    <h3>{{$jurnale}}</h3>
                    
                                    <p>Jurnale</p>
                                    </div>
                                    <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="/admin/jurnal/listare" class="small-box-footer">Mai multe informatii <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                </div>
                            </div>
                            </div>
                        </section>

                    </div>

                </div>

            </div>
        </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection