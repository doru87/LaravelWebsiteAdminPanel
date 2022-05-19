@extends('main.app')

@section('content')
<div class="container-sezon-regata-detalii">
    <div class="breadcrumb-container">
        <div class="d-flex align-items-center h-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Acasa</a></li>
                <li class="breadcrumb-item"><a href="/regate">Regate</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$sezonregata->nume}}</li>
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
                            @foreach($sezonregata->details->imagini as $imagine)
                            <li class="splide__slide">
                                <img src="/files/{{$imagine}}" class="img-fluid" />
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <ul id="thumbnails" class="thumbnails">
                    @foreach($sezonregata->details->imagini as $imagine)
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
                        <div class="d-flex justify-content-between">
                            <h3 class="">{{$sezonregata->nume}}</h3>
                            <h3 class="pret me-3">{{$sezonregata->pret}} EUR</h3>
                        </div>
                        <div class="descriere">
                            <p>{{$sezonregata->descriere}}</p>
                        </div>
                        <div class="lista d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <span>Nivel Performanata:</span><p class="nivel_performanta ms-2">{{$sezonregata->nivel_performanta}}</p>
                            </div>
                            <div class="d-flex flex-row mt-2">
                                <p><span>Model: </span>{{$sezonregata->model}}</p>
                                <p class="ms-3"><span>An fabricatie: </span>{{$sezonregata->an_fabricatie}}</p>
                                <a href="/barca/{{$slug}}" class="detalii_barca ms-3">Vezi detalii barca</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="calendar">
        <p>Calendar sezon regate</p>
        <div class="d-flex flex-wrap">
            @foreach ($calendar as $sezon_regate)
            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                <table class="table table-regatta table-borderless" >
                    <thead class="tableHead">
                        <tr>
                            <th scope="col" class="w-25 text-center">{{$sezon_regate->nume}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="d-flex flex-row justify-content-around">
                            <td class="text-center p-3"><p>Perioada</p>{{$sezon_regate->perioada}}</td>
                            <td class="text-center p-3"><p>Locatie</p>{{$sezon_regate->locatie}}</td>
                            <td class="text-center p-3"><img src="/files/Line 5.png"></td>
                        </tr>
                    </tbody>
                </table> 
            </div>
            @endforeach
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
