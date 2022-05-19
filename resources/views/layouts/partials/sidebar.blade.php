<aside class="main-sidebar sidebar-dark-primary elevation-4">


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="logo-programatorweb mt-3 pb-3 mb-3 d-flex">
            <div class="logo">
                <a href="/dashboard"><img src="{{ asset('/files/2022-02-09_135737.png') }}" ></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                @if(isset($lists))
                    @foreach($lists as $element)

                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                {{ucfirst($element)}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($element != "statistici" && $element != "contacte")
                                <li class="nav-item">
                                    <a href="/admin/{{$element}}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Adauga {{ucfirst($element)}}</p>
                                    </a>
                                </li>
                            @endif
                            @if ($element != "despre-noi" && $element != "politica-de-confidentialitate" && $element != "termeni-si-conditii" && $element != "statistici")
                                <li class="nav-item">
                                    <a href="/admin/{{$element}}/listare" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Afiseaza {{ucfirst($element)}}</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @endforeach
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>