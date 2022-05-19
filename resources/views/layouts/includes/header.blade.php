<header class="header-content">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <a href="<?= route('home') ?>" class="my-0 mr-md-auto font-weight-normal text-decoration-none">
            <span class="fs-4">Vomehad</span>
        </a>
        {{--        <div class="col">--}}
        {{--            <a href="{{ route(\App\Helpers\Helper::getAction(), ['locale' => 'RU']) }}" class="btn btn-default">RU</a>--}}
        {{--            <a href="{{ route(\App\Helpers\Helper::getAction(), ['locale' => 'EN']) }}" class="btn btn-default">EN</a>--}}
        {{--        </div>--}}

        <nav class="my-2 my-md-0 mr-md-3 nav-content">
            @isset($nav)
                @foreach($nav as $link)
                    <a class="p-2 text-dark text-decoration-none" href="{{ $link['url'] }}">{{ $link['name'] }}</a>
                @endforeach
            @endisset
            @guest
                <a href="{{ route('Login') }}" class="btn btn-outline-primary">Login</a>
                <a class="btn btn-outline-primary" href="{{ route('SignUp') }}">Sign up</a>
            @endguest
            @auth
                <a href="{{ route('Account') }}" class="btn btn-outline-primary">Account</a>
                <a href="{{ route('Logout') }}" class="btn btn-outline-prim">Logout</a>
            @endauth
        </nav>
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal">{{ $title ?? __('Titles' . '.' . \App\Helpers\NameHelper::getActionName()) }}</h1>
    </div>
</header>
