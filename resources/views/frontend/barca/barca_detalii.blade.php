@extends('main.app')

@section('content')
<div class="container-barca-detalii">
    <div class="breadcrumb-container">
        <div class="d-flex align-items-center h-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Acasa</a></li>
                <li class="breadcrumb-item"><a href="/barci">Barci</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$boat->nume}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="left-section">
                <div id="main-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">

                            @foreach($boat->details->imagini as $imagine)
                            <li class="splide__slide">
                                <img src="/files/{{$imagine}}" class="img-fluid" />
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <ul id="thumbnails" class="thumbnails">
                    @foreach($boat->details->imagini as $imagine)
                    <li class="thumbnail">
                        <img src="/files/{{$imagine}}" />
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="d-flex align-items-center h-100">
                <div class="right-section">
                    <div class="wrapper">
                        <h3 class="">{{$boat->nume}}</h3>
                        <h6 class="">An fabricatie: {{$boat->an_fabricatie}}</h6>
                        <div class="descriere">
                            <p>{!!$boat->details->descriere!!}</p>
                        </div>
                        <div class="statistici">
                            <div class="row">
                                <div class="d-flex">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-user fa-lg"></i>
                                            <span>Capacitate</span>
                                            <p class="text-center">{{$boat->capacitate}} pers.</p>
                                        </div>
                                    </div>
                                    <div><img src="/files/Line 5.png"></div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-anchor fa-lg"></i>
                                            <span>Lungime</span>
                                            <p class="text-center">{{$boat->details->lungime}} m</p>
                                        </div>
                                    </div>
                                    
                                    <div><img src="/files/Line 5.png"></div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-bed fa-lg"></i>
                                            <span>Layout</span>
                                            <p class="text-center">{{$boat->layout == 1 ? "cabina" : "cabine"}}</p>
                                        </div>
                                    </div>
                                    <div><img src="/files/Line 5.png"></div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-shower fa-lg"></i>
                                            <span>WC cu dus</span>
                                            <p class="ms-2">{{$boat->details->wc_dus}} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-dotari_punte_cockpit-tab" data-toggle="tab" href="#nav-dotari_punte_cockpit" role="tab" aria-controls="nav-dotari_punte_cockpit" aria-selected="true">Dotari punte si cockpit</a>
                            <a class="nav-item nav-link" id="nav-bucatarie_salon-tab" data-toggle="tab" href="#nav--dotari-bucatarie_salon" role="tab" aria-controls="nav-bucatarie_salon" aria-selected="false">Dotari bucatarie si salon</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-dotari_cabine" role="tab" aria-controls="nav-cabine" aria-selected="false">Dotari cabine</a>

                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active ps-4 pe-4" id="nav-dotari_punte_cockpit" role="tabpanel" aria-labelledby="nav-dotari_punte_cockpit-tab">
                            {{$boat->details->dotari_punte_cockpit}}
                        </div>
                        <div class="tab-pane fade ps-4 pe-4" id="nav--dotari-bucatarie_salon" role="tabpanel" aria-labelledby="nav-bucatarie_salon-tab">
                            {{$boat->details->dotari_bucatarie_salon}}
                        </div>
                        <div class="tab-pane fade ps-4 pe-4" id="nav-dotari_cabine" role="tabpanel" aria-labelledby="nav-cabine-tab">
                            {{$boat->details->dotari_cabine}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="echipament">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="left-section">
                    <div class="d-flex align-items-center">
                        <img src="/icons/4047325_drop_sail_sea_transportation_water_icon 1.png" class="sail_sea" alt="">
                        <span class="ms-1">Echipament navigatie</span>
                    </div>
                    <div class="text">
                        <p>{{$boat->details->echipament_navigatie}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="right-section">
                    <div class="d-flex align-items-center">
                        <img src="/icons/4049305_holiday_life jacket_tourism_travel_vacation_icon 1.png" class="jacket" alt="">
                        <span class="ms-1">Echipament de siguranta</span>
                    </div>
                    <div class="text">
                        <p>{{$boat->details->echipament_siguranta}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var splide = new Splide("#main-slider", {

            pagination: false
            , cover: true
        });

        var thumbnails = document.getElementsByClassName("thumbnail");
        var current;

        for (var i = 0; i < thumbnails.length; i++) {
            initThumbnail(thumbnails[i], i);
        }

        function initThumbnail(thumbnail, index) {
            thumbnail.addEventListener("click", function() {
                splide.go(index);
            });
        }

        splide.on("mounted move", function() {
            var thumbnail = thumbnails[splide.index];

            if (thumbnail) {
                if (current) {
                    current.classList.remove("is-active");
                }

                thumbnail.classList.add("is-active");
                current = thumbnail;
            }
        });

        splide.mount();
    });

</script>
