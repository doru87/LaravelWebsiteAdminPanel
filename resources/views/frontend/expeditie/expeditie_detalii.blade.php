@extends('main.app')

@section('content')
<div class="container-expeditie-detalii">
    <div class="breadcrumb-container">
        <div class="d-flex align-items-center h-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Acasa</a></li>
                <li class="breadcrumb-item"><a href="/expeditii">Expeditii</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$expedition->nume}}</li>
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

                            @foreach($expedition->details->imagini as $imagine)
                            <li class="splide__slide">
                                <img src="/files/{{$imagine}}" class="img-fluid" />
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <ul id="thumbnails" class="thumbnails">
                    @foreach($expedition->details->imagini as $imagine)
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
                        <div class="d-flex justify-content-between">
                            <h3 class="">{{$expedition->nume}}</h3>
                            <div class="d-flex">
                                <h3 class="pret">{{$expedition->pret}}</h3><span class="persoana mt-1">/ persoana</span>
                            </div>
                        </div>

                        <div class="descriere">
                            <p>{!!$expedition->descriere!!}</p>
                        </div>
                        <div class="statistici">
                            <div class="row">
                                <div class="d-flex">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="/files/5402455_calendar_appointment_date_event_month_icon 2.png">
                                            <span>Perioada</span>
                                            <p class="text-center">{{$expedition->perioada}}</p>
                                        </div>
                                    </div>
                                    <div><img src="/files/Line 5.png"></div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="/files/4047325_drop_sail_sea_transportation_water_icon 2.png">
                                            <span>Barca</span>
                                            <p class="text-center">{{$expedition->model}}</p>
                                        </div>
                                    </div>
                                    <div><img src="/files/Line 5.png"></div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="/files/logo mariner colour icon 5.png">
                                            <span>Skipper</span>
                                            <p class="text-center">{{$expedition->skipper}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="servicii_incluse">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="section">
                                    <div class="d-flex align-items-center">
                                        <span class="ms-1">Servicii incluse</span>
                                    </div>
                                    <div class="text">
                                        <p>{{$expedition->details->servicii_incluse}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
  
    <div>
        <div class="col-lg-12 col-md-12 col-sm-12">
        <table class="table table-borderless py-5" >
            <thead class="tableHead">
                <tr>
                    <th scope="col" class="w-17">Destinatie</th>
                    <th scope="col" class="w-17">Perioada</th>
                    <th scope="col" class="">Descriere</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expedition->itineraries as $itinerary)
                    <tr>
                        <td>{{$itinerary->destinatie}}</td>
                        <td>{{$itinerary->perioada}}</td>
                        <td>{{$itinerary->descriere}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <div>
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
