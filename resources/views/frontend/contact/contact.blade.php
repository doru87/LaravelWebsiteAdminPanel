@extends('main.app')

@section('content')
<div class="container-contact">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="left-section">
                <img src="/files/Fundal Contact_1888479103.jpg" class="img-fluid"alt="">
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="right-section">
                <div class="wrapper">
                    <h4>Contact.</h4>
                    <p>Daca ai intrebari despre serviciile pe care le oferim, contacteaza-ne!</p>
                    <p>Iti vom raspunde in cel mai scurt timp posibil!</p>
                    <div class="telefon-email w-75">
                        <div class="d-flex">
                            <img src="/files/phone-call 1.png" alt="">
                            <p class="ms-2">0751 110 225 // 0748 074 911</p>
                        </div>
                        <div class="d-flex">
                            <img src="/files/envelope 1.png" alt="">
                            <p class="email ms-2"><a href="mailto:contact@mariner.ro">contact@mariner.ro</a></p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <img src="/files/pin 3.png" alt="">
                        <p class="ms-2">Limanu, Jud. Constanta </p>
                    </div>

                        <div class="formular">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $e)
                                        <li><strong>{{ $e }}</strong></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
        
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <form method="POST" id="contactForm" action="{{ route('front.contact.create')}}">
                                @csrf
                                {!!  GoogleReCaptchaV3::renderField('contact_us_ajax_id','contact_us_action') !!}
                            <div class="d-flex">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label for="nume">Nume</label>
                                        <input type="text" class="form-control" id="nume" name="nume" placeholder="" value="{{old('nume')}}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group ms-2">
                                        <label for="nume">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{old('email')}}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group ms-2">
                                        <label for="nume">Telefon</label>
                                        <input type="text" class="form-control" id="telefon" name="telefon" placeholder="" value="{{old('telefon')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group formular-mesaj">
                                    <label for="mesaj">Mesaj</label>
                                    <textarea class="form-control" id="mesaj" name="mesaj" rows="6" placeholder="Enter ..." >{{old('mesaj')}}</textarea>
                                </div>
                            </div>
                            <button class="btn" id="contactFormular">Trimite</button>
                        </form>
                        </div>
               
                </div>
            </div>
        </div>
    </div>
</div>
{!!  GoogleReCaptchaV3::init() !!}
@endsection
