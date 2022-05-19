@extends('main.app')

@section('content')
<div class="row">
    <div class="container-jurnale-image d-flex justify-content-center">
        <div class="wrapper d-flex align-items-center h-50">
            <div class="content">
                <h1 class="m-0">Jurnal</h1>
                <div class="line d-flex align-items-center">
                    <img src="files/Line 8.png" alt="">
                </div>
                <p>
                </p>
            </div>
        </div>
    </div>
    @foreach($jurnale as $jurnal)

    <div class="container-jurnale d-flex justify-content-center mb-5">

        <div class="card rounded-3 justify-content-center">
            <div class="row">

                <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                    <div class="image">
                        <img src="/files/{{$jurnal->imagine}}" class="img-fluid" alt="" srcset="">
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                    <div class="d-flex align-items-center h-100">
                        <div class="card-body">
                            <h4 class="card-title">{{$jurnal->nume_eveniment}}</h4>
                            <p>{{$jurnal->itinerariu}}</p>
                            <p class="card-text">{!!$jurnal->descriere!!}</p>
                            <p class="card-text"><img src="/files/5402455_calendar_appointment_date_event_month_icon 2.png">  Perioada: {{$jurnal->perioada}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="detalii d-flex">
                    <a href="jurnal/{{$jurnal->slug}}" class="ms-auto me-3">Vezi detalii</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="pagination-wrapper">
        {!! $jurnale->links() !!}
    </div>

</div>

@endsection
