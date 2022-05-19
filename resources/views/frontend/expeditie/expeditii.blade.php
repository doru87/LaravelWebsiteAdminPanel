@extends('main.app')

@section('content')
<div class="row">
    <div class="container-expeditii-image d-flex justify-content-center">
        <div class="wrapper d-flex align-items-center h-50">
            <div class="content">
                <h1 class="m-0">Expeditii</h1>
                <div class="line d-flex align-items-center">
                    <img src="files/Line 8.png" alt="">
                </div>
                <p>Alatura-te uneia din expeditiile organizate de echipa Mariner in sezonul 2022!
                </p>
            </div>
        </div>
    </div>
    @foreach($expeditii as $expeditie)

    <div class="container-expeditii d-flex justify-content-center mb-5">

        <div class="card rounded-3 justify-content-center">
            <div class="row">

                <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                    <div class="image">
                        <img src="/files/{{$expeditie->imagine}}" class="img-fluid" alt="" srcset="">
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                    <div class="d-flex align-items-center h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">{{$expeditie->nume}}</h4>
                                <div class="d-flex">
                                    <h3 class="pret">{{$expeditie->pret}}</h3>
                                </div>
                            </div>
                            <p class="card-text">{!!Str::limit($expeditie->descriere, 100, '...')!!}</p>
                            <div class="lista-informatii">
                                <div class="row">
                                    <div class="col-4">
                                       <img src="/files/5402455_calendar_appointment_date_event_month_icon 2.png"><span>&nbsp;Perioada:&nbsp;</span> <span> {{$expeditie->perioada}}</span>
                                    </div>
                                    <div class="col-4">
                                       <img src="/files/2022-03-23_153206.png"><span>&nbsp;Barca:&nbsp;</span><span> {{$expeditie->model}} </span>
                                    </div>
                                    <div class="col-4">
                                       <img src="/files/logo mariner colour icon 5.png"><span>&nbsp;Skipper:&nbsp;</span><span> {{$expeditie->skipper}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="detalii d-flex">
                    <a href="expeditie/{{$expeditie->slug}}" class="ms-auto me-3">Vezi detalii</a>
                </div>
            </div>
        </div>

    </div>
    @endforeach
    <div class="pagination-wrapper">
        {!! $expeditii->links() !!}
    </div>

</div>

@endsection
