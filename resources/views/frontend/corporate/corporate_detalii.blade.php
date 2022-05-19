@extends('main.app')

@section('content')
<div class="container-corporate-detalii">
    <div class="breadcrumb-container">
        <div class="d-flex align-items-center h-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Acasa</a></li>
                <li class="breadcrumb-item"><a href="/barci">Corporate</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$corporate_event->nume}}</li>
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
                            @foreach($corporate_event->details->imagini as $imagine)
                            <li class="splide__slide">
                                <img src="/files/{{$imagine}}" class="img-fluid" />
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <ul id="thumbnails" class="thumbnails">
                    @foreach($corporate_event->details->imagini as $imagine)
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
                            <p class="tip_activitate">{{$corporate_event->tip_activitate}}</p>
                            <h3 class="">{{$corporate_event->nume}}</h3>
                        <div class="descriere">
                            <p>{!!$corporate_event->descriere!!}</p>
                        </div>
                        <div class="statistici">
                            <div class="row">
                                <div class="d-flex">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="/files/pin 2.png">
                                            <span>Destinatie</span>
                                            <p class="text-center">{{$corporate_event->destinatie}}</p>
                                        </div>
                                    </div>
                                    <div><img src="/files/Line 5.png"></div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="/files/309035_user_account_human_person_icon 2.png">
                                            <span>Capacitate</span>
                                            <p class="text-center">{{$corporate_event->capacitate}}</p>
                                        </div>
                                    </div>
                                    <div><img src="/files/Line 5.png"></div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="/files/time 4.png">
                                            <span>Durata</span>
                                            <p class="text-center">{{$corporate_event->durata}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="servicii_incluse">
                                    <div class="section pe-3">
                                        <div class="d-flex align-items-center">
                                            <span class="ms-1">Servicii incluse</span>
                                        </div>
                                        <div class="text">
                                            <p>{{$corporate_event->details->servicii_incluse}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4"><img src="/files/Line 7.png"></div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="servicii_optionale">
                                    <div class="section ps-4">
                                        <div class="d-flex align-items-center">
                                            <span class="ms-1">Servicii optionale</span>
                                        </div>
                                        <div class="text">
                                            <p>{{$corporate_event->details->servicii_optionale}}</p>
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
