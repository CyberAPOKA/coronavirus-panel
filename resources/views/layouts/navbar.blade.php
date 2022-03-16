<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow navMobile" data-background-color="blue">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,700;1,700&display=swap" rel="stylesheet">

    <div class="container-fluid" style="height: 49px;">
        
        <div class="w-100 header tituloMobile"> Gerenciador Painel Covid-19 </div>
            <a data-toggle="collapse" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i style="color:rgb(59, 37, 158) font-size: 30px;" class="fas fa-sign-out-alt fa-2x"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
    </div>
</nav>

</div>
