
    <?php 
    $second_url = \Request::segment(1);
    $third_url = \Request::segment(2);
    ?>
<div class="navigation">
    <div class="contact">
        <div class="phone-email d-flex align-items-center">
            <div class="email-icon ms-2"><i class="far fa-envelope"></i></div>
            <div class="email ms-2">
                <span><a href="mailto:contact@mariner.ro">contact@mariner.ro</a></span>
            </div>
        </div>
    </div>
    <div class= {{$third_url == "detalii" || $second_url == "contact" ? "navigation-wrap-detalii start-header start-style":"navigation-wrap start-header start-style" }}>
        <div class="navigation-container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light ">

                        <div class="navbar-brand">
                           <a href="/"><img src="/files/logo.png" alt=""></a>
                        </div>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse py-2" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto py-md-0">
                                <li class="nav-item pl-4 pl-md-0 ml-0 active">
                                    <a class="nav-link" href="{{ route('front.barci.index') }}">Barcile noastre</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0">
                                    <a class="nav-link" href="{{ route('front.chartere.index') }}">Charter</a>
                                </li>
                                <li class="nav-item  pl-4 pl-md-0 ml-0 ">
                                    <a class="nav-link" href="{{ route('front.expeditii.index') }}">Expeditii</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ">
                                    <a class="nav-link" href="{{ route('front.regate.index') }}">Regate</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0">
                                    <a class="nav-link" href="{{ route('front.corporate.index') }}">Corporate</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ">
                                    <a class="nav-link" href="{{ route('front.evenimente.index') }}">Evenimente</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ">
                                    <a class="nav-link" href="{{ route('front.jurnale.index') }}">Jurnal</a>
                                </li>
                                <li class="nav-item  pl-4 pl-md-0 ml-0 ">
                                    <a class="nav-link" href="{{ route('front.contact.index') }}">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>