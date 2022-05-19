@extends('main.app')

@section('content')
<div class="row">
    <div class="container-barci-image d-flex justify-content-center">
        <div class="wrapper d-flex align-items-center h-50">
            <div class="content">
                <h1 class="m-0">Barcile noastre</h1>
                <div class="line d-flex align-items-center">
                    <img src="files/Line 8.png" alt="">
                </div>
                <p>Mariner Yachting va ofera experiente pe mare in ambarcatiuni moderne, bine echipate si intretinute, produse de unul din faimoasele santiere frantuzesti cu o traditie de peste 60 ani in construirea velierelor de agreement, “Chantier Dufour”.
                </p>
            </div>
        </div>
    </div>
    @foreach($barci as $barca)

    <div class="container-barci d-flex justify-content-center mb-5">

        <div class="card rounded-3 justify-content-center">
            <div class="row">

                <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                    <div class="image">
                        <img src="/files/{{$barca->imagine}}" class="img-fluid" alt="" srcset="">
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                    <div class="d-flex align-items-center h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">{{$barca->nume}}</h4>
                                <p class="an-fabricatie">An fabricatie: {{$barca->an_fabricatie}}</p>
                            </div>
                            <p class="card-text">{!!Str::limit($barca->details->descriere, 100, '...')!!}</p>
                            <div class="lista-informatii">
                                <div class="row">
                                    <div class="col-6">
                                        <i class="fas fa-user"></i><span>&nbsp;Capacitate:&nbsp;</span> <span> {{$barca->capacitate}} pers.</span>
                                    </div>
                                    <div class="col-6">
                                        <i class="fas fa-bed"></i><span>&nbsp;Layout:&nbsp;</span><span> {{$barca->layout}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="detalii d-flex">
                    <a href="barca/{{$barca->slug}}" class="ms-auto me-3">Vezi detalii</a>
                </div>
            </div>
        </div>

    </div>
    @endforeach
    <div class="pagination-wrapper">
        {!! $barci->links() !!}
    </div>
</div>

@endsection
