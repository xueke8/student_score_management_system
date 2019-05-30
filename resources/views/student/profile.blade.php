@extends('app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div>
                    <h2>修改个人信息</h2>
                </div>
                <div class="card mt-4 card-body">
                    <form class="m-0" action="{{route('student.settings.profile')}}" method="post">
                        {{--学号--}}
                        <div class="form-group row">
                            <label for="studentId" class="col-sm-2 col-form-label">学号</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="studentId"
                                       value="{{$profile->id}}">
                            </div>
                        </div>

                        {{--班级--}}
                        <div class="form-group row">
                            <label for="class" class="col-sm-2 col-form-label">班级</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="class"
                                       value="{{$profile->class_->name}}">
                            </div>
                        </div>

                        {{--姓名--}}
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">姓名</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="name"
                                       value="{{$profile->name}}">
                            </div>
                        </div>

                        {{--性别--}}
                        <fieldset class="form-group">
                            <div class="row">
                                <label for="sex" class="col-sm-2 col-form-label">性别</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="sex"
                                           value="{{$profile->sex}}">
                                </div>
                        </fieldset>

                        {{--身份证号--}}
                        <div class="form-group row">
                            <label for="id_number" class="col-sm-2 col-form-label">身份证号</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_number" name="id_number"
                                       value="{{$profile->id_number}}">
                            </div>
                        </div>

                        {{--联系电话--}}
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">联系电话</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone"
                                       value="{{$profile->phone}}">
                            </div>
                        </div>

                        {{--家庭住址--}}
                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">家庭住址</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="address" name="address"
                                       value="{{$profile->address}}">
                            </div>
                        </div>

                        <input type="hidden" name="_method" value="PUT">

                        {{csrf_field()}}
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection