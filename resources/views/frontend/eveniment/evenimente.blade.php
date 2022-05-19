@extends('main.app')

@section('content')
<div class="row">
    <div class="container-evenimente-image d-flex justify-content-center">
        <div class="wrapper d-flex align-items-center h-50">
            <div class="content">
                <h1 class="m-0">Evenimente</h1>
                <div class="line d-flex align-items-center">
                    <img src="files/Line 8.png" alt="">
                </div>
                <p>Transforma un moment intr-o amintire deosebita pe mare alaturi de echipa si barcile noastre!
                </p>
            </div>
        </div>
    </div>
    @foreach($evenimente as $eveniment)

    <div class="container-evenimente d-flex justify-content-center mb-5">

        <div class="card rounded-3 justify-content-center">
            <div class="row">

                <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                    <div class="image">
                        <img src="/files/{{$eveniment->imagine}}" class="img-fluid" alt="" srcset="">
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                    <div class="d-flex align-items-center h-100">
                        <div class="card-body">
                            <h4 class="card-title">{{$eveniment->nume}}</h4>
                            <p class="card-text">{{$eveniment->destinatie}}</p>
                            <p class="card-text">{!!$eveniment->descriere!!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="detalii d-flex">
                    <a href="eveniment/{{$eveniment->slug}}" class="ms-auto me-3">Vezi detalii</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="pagination-wrapper">
        {!! $evenimente->links() !!}
    </div>

</div>

@endsection
