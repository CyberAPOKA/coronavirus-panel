<div class="main-panel">
    <div class="content">
        <div class="page-inner" style=" background-color:#f5f7fb">
            <div class="page-category">

                @yield('content')

            </div>
        </div>
    </div>
    @if(!Request::is('registrar*') && !Request::is('login') )
    @include('layouts.footer')
    @endif
</div>