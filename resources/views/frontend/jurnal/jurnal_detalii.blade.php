@extends('main.app')

@section('content')
<div class="container-jurnal-detalii">
    <div class="breadcrumb-container">
        <div class="d-flex align-items-center h-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Acasa</a></li>
                <li class="breadcrumb-item"><a href="/jurnale">Jurnale</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$jurnal->nume_eveniment}}</li>
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

                            @foreach($jurnal->details->imagini as $imagine)
                            <li class="splide__slide">
                                <img src="/files/{{$imagine}}" class="img-fluid" />
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <ul id="thumbnails" class="thumbnails">
                    @foreach($jurnal->details->imagini as $imagine)
                    <li class="thumbnail">
                        <img src="/files/{{$imagine}}" />
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="right-section">
                <div class="d-flex align-items-center h-100">
                    <div class="flex-column w-100">
                        <h3 class="">{{$jurnal->nume_eveniment}}</h3>
                        <p class="card-text"><img src="/files/5402455_calendar_appointment_date_event_month_icon 2.png">  Perioada: {{$jurnal->perioada}}</p>
                        <div class="descriere">
                            <p>{!!$jurnal->descriere!!}</p>
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
