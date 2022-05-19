@extends('main.app')

@section('content')
<div class="row">
    <div class="container-regate-image d-flex justify-content-center">
        <div class="wrapper d-flex align-items-center h-50">
            <div class="content">
                <h1 class="m-0">Regate</h1>
                <div class="line d-flex align-items-center">
                    <img src="files/Line 8.png" alt="">
                </div>
                <p>Participa alaturi de una din echipele noastre la o regata sau un intreg sezon!
                    In functie de experienta si apetitul pentru adrenalina poti ajunge colegul nostru intr-un echipaj de cruiser sau de racer!                    
                </p>
            </div>
        </div>
    </div>
    
    @foreach($regate as $regata)
        
        <div class="container-regate d-flex justify-content-center mb-5">
            <div class="card rounded-3 justify-content-center">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                        <div class="image">
                            <img src="/files/{{$regata->imagine}}" class="img-fluid" alt="" srcset="">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                        <div class="d-flex align-items-center h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title">{{$regata->nume}}</h4>
                                    <h3 class="pret">{{$regata->pret}}</h3>
                                </div>
                                <p class="card-text">{!!$regata->descriere!!}</p>
                                <div class="lista d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <span>Nivel Performanata:</span><p class="nivel_performanta ms-2">{{$regata->nivel_performanta}}</p>
                                    </div>
                                    <div class="d-flex flex-row mt-2">
                                        <div class="d-flex flex-wrap align-items-center">
                                        <span>Model: &nbsp;</span><span>{{$regata->model}}</span>
                                        </div>
                                        <div class="d-flex flex-wrap align-items-center">
                                        <span class="an_fabricatie">An fabricatie: &nbsp;</span><span>{{$regata->an_fabricatie}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="detalii d-flex">
                        <a href="regata/{{$regata->slug}}" class="ms-auto me-3">Vezi detalii</a>
                    </div>
                </div>
            </div>

        </div>
    @endforeach

   
    <div class="pagination-wrapper">
        {!! $regate->links() !!}
    </div>

</div>

@endsection
