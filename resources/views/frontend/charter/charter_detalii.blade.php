@extends('main.app')

@section('content')
<div class="container-charter-detalii">
    <div class="breadcrumb-container">
        <div class="d-flex align-items-center h-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Acasa</a></li>
                <li class="breadcrumb-item"><a href="/chartere">Chartere</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$charter->nume}}</li>
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
                            @foreach($charter->details->imagini as $imagine)
                            <li class="splide__slide">
                                <img src="/files/{{$imagine}}" class="img-fluid" />
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <ul id="thumbnails" class="thumbnails">
                    @foreach($charter->details->imagini as $imagine)
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
                            <h3 class="">{{$charter->nume}}</h3>
                            <h3 class="pret">{{$charter->pret}}</h3>
                        </div>
                        <div class="descriere">
                            <p>{!!$charter->descriere!!}</p>
                        </div>
                        <div class="statistici">
                            <div class="row">
                                <div class="d-flex">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="/files/309035_user_account_human_person_icon 2.png">
                                            <span>Capacitate</span>
                                            <p class="text-center">{{$charter->capacitate}} pers.</p>
                                        </div>
                                    </div>
                                    <div><img src="/files/Line 5.png"></div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="/files/5402455_calendar_appointment_date_event_month_icon 2.png">
                                            <span>Perioada</span>
                                            <p class="text-center">{{$charter->perioada}}</p>
                                        </div>
                                    </div>
                                    <div><img src="/files/Line 5.png"></div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="/files/logo mariner colour icon 5.png">
                                            <span>Skipper</span>
                                            <p class="text-center">{{$charter->skipper}}</p>
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
                                        <p>{{$charter->details->servicii_incluse}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
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
