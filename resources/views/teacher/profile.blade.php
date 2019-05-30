@extends('app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div>
                    <h2>修改个人信息</h2>
                </div>
                <div class="card mt-4 card-body">
                    <form action="{{route('teacher.settings.profile')}}" method="post">
                        {{--教师号--}}
                        <div class="form-group row">
                            <label for="studentId" class="col-sm-2 col-form-label">教师号</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="studentId"
                                       value="{{$profile->id}}">
                            </div>
                        </div>

                        {{--系部--}}
                        <div class="form-group row">
                            <label for="department" class="col-sm-2 col-form-label">系部</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="department"
                                       value="{{$profile->department->name}}">
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
                                <legend class="col-form-label col-sm-2 pt-0">性别</legend>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="sex"
                                           value="{{$profile->sex}}">
                                </div>
                            </div>
                        </fieldset>

                        {{--联系电话--}}
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">联系电话</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone"
                                       value="{{$profile->phone}}">
                            </div>
                        </div>

                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection