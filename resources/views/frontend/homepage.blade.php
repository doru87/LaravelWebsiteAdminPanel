@extends('main.app')

@section('content')
<div class="row">
    <div class="container-homepage-image d-flex justify-content-center">
        <div class="homepage-image"></div>
        <div class="overlay">
            <div class="content d-flex align-items-center">
                <div class="text-content">
                    <h1>Exploreaza</h1>
                    <h1>Descopera</h1>
                    <h1>Navigheaza</h1>
                    <h2>alaturi de<h2>
                    <h1 class="mt-4">MARINER Yachting.</h1>
                    <a href="#section-charter" class="btn btn-lg text-white rounded-2 oferte">Descopera ofertele <img src="files/Arrow 1.png" alt=""></a>
                </div>
            </div>
    </div>
    </div>
    <div class="section1">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="left-section">
                    <div class="card-left">
                        <h3>Despre Mariner Yachting</h3>
                        <div class="descriere">
                            <p>MARINER Yachting ofera servicii de inchiriere veliere pentru vacante, plimbari, expeditii, antrenamente si regate, evenimente corporate sau private, sedinte foto sau chiar casatorii pe mare tuturor celor interesati de yachting, fie ei pasionati sau viitori navigatori.</p>
                            <p>Suntem si vom fi intodeauna orientati  spre a vă face timpul petrecut pe ambarcațiunile noastre de neuitat. Operăm în baza unor valori puternice: profesionalism, calitate, siguranta si bucuria de a fi pe mare, iar prioritatea noastra este sa oferim experiente autentice si inedite la bordul yachturilor MARINER.</p>
                            <p>Echipajul MARINER are experienta in conducerea ambarcatiunilor si a echipajelor acestora in iesiri scurte, expeditii de agreement, traversade cat si regate nationale si internationale.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="image-section-1">
                    <div class="right-section">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-barci">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="wrapper">
                    <div>
                        <h2>Barci din flota Mariner</h2>
                        <div class="descriere mt-4">
                            <p>Mariner Yachting va ofera experiente pe mare in ambarcatiuni moderne, bine echipate si intretinute, produse de unul din faimoasele santiere de pe coasta franceza, “Chantier Dufour”, cu o traditie de peste 60 ani in construirea velierelor de agreement.</p>
                        </div>
                        <a type="button" href="barci" class="btn buton_barci text-white ps-4 pe-4 pt-2 pb-2">Vezi barcile noastre</a>
                    </div>
                </div>
            </div>

            @foreach($barci as $barca)
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card mt-3">
                    <img src="/files/{{$barca->imagine}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="titlu">{{$barca->nume}}</h5>
                        <div class="capacitate d-flex">
                            <i class="fas fa-user mt-2 me-2"></i>
                            <p>Capacitate: {{$barca->capacitate}}</p>
                        </div>
                        <div class="lungime d-flex">
                            <i class="fas fa-anchor mt-2 me-2"></i>
                            <p>Lungime: {{$barca->details->lungime}}</p>
                        </div>
                        <div class="layout d-flex">
                            <i class="fas fa-bed mt-2 me-2"></i>
                            <p>Layout: {{$barca->layout}}</p>
                        </div>
                    </div>
                    <a href="barca/{{$barca->slug}}" class="ms-auto pe-3 pb-3 fw-bold">Vezi detalii</a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <div class="section-charter" id="section-charter">
        <h2 class="mb-4">Oferte Charter</h2>

        <div class="row">
            @foreach($chartere as $charter)

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card mt-3">
                    <img src="/files/{{$charter->imagine}}" class="card-img-top img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="titlu">{{$charter->nume}}</h5>
                        <div class="descriere">
                            {{$charter->descriere}}
                        </div>
                        <div class="pret mt-2">
                            <p>{{$charter->pret}}</p>
                        </div>
                    </div>
                    <a href="charter/{{$charter->slug}}" class="ms-auto pe-3 pb-3 fw-bold">Vezi detalii</a>
                </div>
            </div>

            @endforeach
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center mt-5">
                        <a type="button" href="chartere" class="btn buton_charter text-white ps-4 pe-4 pt-2 pb-2">Descopera toate ofertele</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="section-expeditii">
        <h2 class="mb-4">Expeditii in tara si strainatate</h2>
        <div class="row">
            @foreach($expeditii as $expeditie)
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card mt-3">
                    <img src="/files/{{$expeditie->imagine}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="titlu">{{$expeditie->nume}}</h5>
                        <div class="descriere">
                            <div class="wrapper-perioada-locatie">
                                <div class="perioada d-flex">
                                    <i class="far fa-calendar mt-1 me-2"></i>
                                    <p>{{$expeditie->perioada}}</p>
                                </div>
                                <div class="locatie d-flex">
                                    <i class="fas fa-map-marker-alt mt-1 me-2"></i>
                                    <p>{{$expeditie->locatie}}</p>
                                </div>
                            </div>
                            <div class="pret mt-2">
                                <p>{{$expeditie->pret}}</p>
                            </div>
                        </div>
                    </div>
                    <a href="expeditie/{{$expeditie->slug}}" class="ms-auto pe-3 pb-3 fw-bold">Vezi detalii</a>
                </div>
            </div>

            @endforeach

        </div>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center mt-5">
                    <a type="button" href="expeditii" class="btn buton_expeditii text-white ps-4 pe-4 pt-2 pb-2">Vezi toate expeditiile</a>
                </div>
            </div>
        </div>
    </div>
    <div class="section-regate">
        <h2 class="mb-4">Oferte de participare la regate</h2>
        <div class="row">
            @foreach($regate as $regata)
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card mt-3">
                    <img src="/files/{{$regata->imagine}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="titlu">{{$regata->nume}}</h5>
                        <div class="descriere">
                            {{$regata->descriere}}
                        </div>
                        <div class="pret mt-2">
                            <p>{{$regata->pret}}</p>
                        </div>
                    </div>
                    <a href="regata/{{$regata->slug}}" class="ms-auto pe-3 pb-3 fw-bold">Vezi detalii</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center mt-5">
                    <a type="button" href="regate" class="btn buton_regate text-white ps-4 pe-4 pt-2 pb-2">Descopera toate regatele</a>
                </div>
            </div>
        </div>
    </div>
    <div class="section-corporate">
        <h2 class="mb-4">Corporate organizate la cerere</h2>
        <div class="row">
            @foreach($evenimente_corporate as $eveniment_corporate)
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card mt-3">
                    <img src="/files/{{$eveniment_corporate->imagine}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="titlu">{{$eveniment_corporate->nume}}</h5>
                        <div class="descriere">
                            {{$eveniment_corporate->descriere}}
                        </div>
                    </div>
                    <a href="corporate/{{$eveniment_corporate->slug}}" class="ms-auto pe-3 pb-3 fw-bold">Vezi detalii</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center mt-5">
                    <a type="button" href="corporate" class="btn buton_corporate text-white ps-4 pe-4 pt-2 pb-2">Descopera toate ofertele</a>
                </div>
            </div>
        </div>
    </div>
    <div class="section-jurnal">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="left-section">
                    <div class="corporate-image">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="right-section">
                    <div class="wrapper">
                        <div class="d-flex">
                            <img src="/files/logo mariner colour icon 3.png" class="img-fluid" alt="">
                            <h2 class="titlu ms-2">Jurnal</h2>
                        </div>
                        <div class="statistici mt-5 mb-3">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="d-flex numar-expeditii">
                                    <span>{{$numarul_expeditii}}</span>
                                    <p class="ms-2">Expeditii</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="d-flex numar-regate">
                                    <span>{{$numarul_regate}}</span>
                                    <div>
                                        <p class="first ms-2">Participari</p>
                                        <p class="second ms-2">la regate</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="d-flex numar-evenimente">
                                    <span>{{$numarul_evenimente}}</span>
                                    <div>
                                        <p class="first ms-2">Evenimente</p>
                                        <p class="second ms-2">organizate</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="descriere">
                            <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; In dui mauris, congue in enim non, aliquam bibendum justo. Sed quis condimentum dolor, eu condimentum turpis. Nunc gravida tempus efficitur.</p>
                            <p>Duis ac pharetra enim. Morbi est nibh, lacinia volutpat placerat sit amet, finibus a velit. Quisque id erat nec quam luctus convallis. Curabitur pharetra eu nibh id dictum.</p>
                        </div>
                        <a href="evenimente">Vezi evenimentele organizate in trecut</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
