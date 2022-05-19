@extends('main.app')

@section('content')
<div class="row">
    <div class="container-corporate-image d-flex justify-content-center">
        <div class="wrapper d-flex align-items-center h-50">
            <div class="content">
                <h1 class="m-0">Corporate</h1>
                <div class="line d-flex align-items-center">
                    <img src="files/Line 8.png" alt="">
                </div>
                <p>Evenimente corporate originale la bordul unuia sau mai multor yacht-uri cu vele!
                </p>
                <p>Contacteaza-ne si iti vom propune un eveniment personalizat!</p>
            </div>
        </div>
    </div>
    @foreach($evenimente_corporate as $eveniment_corporate)

    <div class="container-corporate d-flex justify-content-center mb-5">

        <div class="card rounded-3 justify-content-center">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                    <div class="image">
                        <img src="/files/{{$eveniment_corporate->imagine}}" class="img-fluid" alt="" srcset="">
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                    <div class="d-flex align-items-center h-100">
                        <div class="d-flex flex-column">
                            <div class="card-body">
                                <p class="tip_activitate">{{$eveniment_corporate->tip_activitate}}</p>
                                <h4 class="card-title">{{$eveniment_corporate->nume}}</h4>
                                <p class="card-text">{!!Str::limit($eveniment_corporate->descriere, 100, '...')!!}</p>
                                <div class="lista-informatii">
                                    <div class="row">
                                        <div class="col-4">
                                           <img src="/files/pin 2.png"><span>&nbsp;Destinatie:&nbsp;</span> <span> {{$eveniment_corporate->destinatie}}</span>
                                        </div>
                                        <div class="col-4">
                                           <img src="/files/309035_user_account_human_person_icon 2.png"><span>&nbsp;Capacitate:&nbsp;</span><span> {{$eveniment_corporate->capacitate}} </span>
                                        </div>
                                        <div class="col-4">
                                           <img src="/files/time 4.png"><span>&nbsp;Durata:&nbsp;</span><span> {{$eveniment_corporate->durata}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                    </div>
                </div>
            </div>
      
            <div class="row">
                <div class="detalii d-flex">
                    <a href="corporate/{{$eveniment_corporate->slug}}" class="ms-auto me-3">Vezi detalii</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="pagination-wrapper">
        {!! $evenimente_corporate->links() !!}
    </div>

</div>

@endsection
