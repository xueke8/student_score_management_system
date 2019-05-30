<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>

    <link rel="stylesheet" href="{{url('/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('/vendor/laravel-admin/font-awesome/css/font-awesome.min.css')}}">
    @yield('head')
    <style>
        body {
            background: rgb(245, 245, 255);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="#">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            @if(Auth::guard('student')->check())
                <li class="nav-item @if(request()->routeIs('student')) active @endif">
                    <a class="nav-link" href="{{route('student')}}">我的课程</a>
                </li>
                <li class="nav-item  @if(request()->routeIs('student.score')) active @endif">
                    <a class="nav-link" href="{{route('student.score')}}">我的成绩</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('teacher')) active @endif"
                       href="{{route('teacher')}}">我的课程</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('teacher.score')) active @endif"
                       href="{{route('teacher.score')}}">成绩查询</a>
                </li>
            @endif

        </ul>
        <div class="dropdown show">
            <a class="dropdown-toggle text-white" href="#" data-toggle="dropdown">
                @if(Auth::guard('teacher')->check())
                    {{Auth::guard('teacher')->user()->name}}
                @else
                    {{Auth::guard('student')->user()->name}}
                @endif
            </a>

            <div style="right: 0;left: auto;" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                @if(Auth::guard('student')->check())
                    <a class="dropdown-item" href="{{route('student.settings.profile')}}">个人信息</a>
                    <a class="dropdown-item" href="{{route('student.settings.password')}}">修改密码</a>
                @else
                    <a class="dropdown-item" href="{{route('teacher.settings.profile')}}">个人信息</a>
                    <a class="dropdown-item" href="{{route('teacher.settings.password')}}">修改密码</a>
                @endif

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('logout')}}">注销</a>
            </div>
        </div>
    </div>
</nav>

@yield('content')

<script src="{{url('/vendor/jquery/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

@yield('foot')
</body>
</html>