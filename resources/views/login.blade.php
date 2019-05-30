<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>

    <link rel="stylesheet" href="{{url('/vendor/bootstrap/css/bootstrap.min.css')}}">
    <style>
        body {
            background: rgb(43, 49, 55);
        }
    </style>
</head>
<body>
<div class="container">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-12 col-md-7" style="display: flex;align-items: center">
            <div>
                <h1 class="text-white">学生成绩管理系统</h1>
                <p style="font-size: 20px;color: rgba(255,255,255,0.6);">
                    学生对自己的成绩进行查询、课程查询和信息修改，教师录入学生成绩、查询成绩、查询所教课程和修改个人信息
                </p>
            </div>
        </div>
        <div class="col-12 col-md-5 ">
            <div class="card">
                <div class="card-header">
                    登录
                </div>
                <div class="card-body">
                    <form action="{{route('login')}}" method="post" class="p-0 m-0">
                        <div class="form-group">
                            <label for="id">用户名</label>
                            <input id="id" type="text" class="form-control @if($errors->has('id')) is-invalid @endif"
                                   name="id" placeholder="请输入学号或教师号" value="{{old('id')}}">
                            @if($errors->has('id'))
                                @foreach($errors->get('id') as $message)
                                    <p class="invalid-feedback">{{$message}}</p>
                                @endforeach
                            @endif
                            <small class="form-text text-muted">学生请输入8位学号，教师请输入8位教师号</small>
                        </div>
                        <div class="form-group">
                            <label for="">密码</label>
                            <input type="password"
                                   class="form-control @if($errors->has('password')) is-invalid @endif"
                                   name="password" placeholder="请输入密码" value="{{old('password')}}">
                            @if($errors->has('password'))
                                @foreach($errors->get('password') as $message)
                                    <p class="invalid-feedback">{{$message}}</p>
                                @endforeach
                            @endif
                            <small class="form-text text-muted">学生初始密码为身份证后6位，教师初始密码为'123456'，登录后可自行更改</small>
                        </div>
                        <div class="form-inline">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="identity" id="student"
                                       value="student" checked>
                                <label class="form-check-label" for="student">
                                    学生
                                </label>
                            </div>
                            <div class="form-check ml-2">
                                <input class="form-check-input" type="radio" name="identity" id="teacher"
                                       value="teacher">
                                <label class="form-check-label" for="teacher">
                                    老师
                                </label>
                            </div>
                        </div>

                        <div class="form-check my-2">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                   value="{{old('remember')}}">
                            <label class="form-check-label" for="remember">记住我</label>
                        </div>
                        {{csrf_field()}}
                        <div class="form-group m-0">
                            <button type="submit" class="btn btn-success btn-block btn-lg">登录</button>
                            <small class="form-text text-muted">请正确勾选教师或学生身份后点击登录，否则将会登陆失败</small>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>

<script src="{{url('/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{url('/vendor/jquery/jquery-3.4.1.min.js')}}"></script>
</body>
</html>