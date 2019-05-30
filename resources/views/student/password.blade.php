@extends('app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div>
                    <h2>修改密码</h2>
                </div>
                <div class="card card-body mt-4">
                    <form action="{{route('student.settings.password')}}" method="post" class="m-0">
                        {{--旧密码--}}
                        <div class="form-group row">
                            <label for="old_password" class="col-sm-2 col-form-label">旧密码</label>
                            <div class="col-sm-10">
                                <input name="old_password" type="password" class="form-control @if($errors->has('old_password')) is-invalid @endif" id="old_password"
                                       value="{{old('old_password')}}" placeholder="请输入旧密码">
                                @if($errors->has('old_password'))
                                    @foreach($errors->get('old_password') as $message)
                                        <p class="invalid-feedback">{{$message}}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        {{--新密码--}}
                        <div class="form-group row">
                            <label for="new_password" class="col-sm-2 col-form-label">新密码</label>
                            <div class="col-sm-10">
                                <input name="new_password" type="password" class="form-control @if($errors->has('new_password')) is-invalid @endif" id="new_password"
                                       value="{{old('new_password')}}" placeholder="请输入新密码">
                                @if($errors->has('new_password'))
                                    @foreach($errors->get('new_password') as $message)
                                        <p class="invalid-feedback">{{$message}}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        {{--确认密码--}}
                        <div class="form-group row">
                            <label for="confirm_password" class="col-sm-2 col-form-label">确认密码</label>
                            <div class="col-sm-10">
                                <input name="confirm_password" type="password" class="form-control @if($errors->has('confirm_password')) is-invalid @endif" id="confirm_password"
                                       value="{{old('confirm_password')}}" placeholder="请再次输入新密码">
                                @if($errors->has('confirm_password'))
                                    @foreach($errors->get('confirm_password') as $message)
                                        <p class="invalid-feedback">{{$message}}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <input type="hidden" name="_method" value="PUT">

                        {{csrf_field()}}
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">修改密码</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection