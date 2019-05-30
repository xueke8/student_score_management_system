@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div>
                    <h2>成绩列表</h2>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <form class="form-inline m-0" action="{{route('student.score')}}" method="get">

                            <div class="form-group">
                                <label for="year">学年</label>
                                <select name="year" class="form-contro form-control-sm ml-2" id="year">
                                    <option value="" @if(request('year')=='') selected @endif>全部</option>
                                    @foreach(range(\Illuminate\Support\Facades\Date::now()->year,\Illuminate\Support\Facades\Date::now()->year-5) as $year)
                                        <option @if(request('year')==$year) selected @endif  value="{{$year}}">{{$year}}
                                            年-{{$year+1}}年
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mx-3">
                                <label for="semester">学期</label>
                                <select name="semester" class="form-contro form-control-sm ml-2" id="semester">
                                    <option value="" @if(request('semester')=='') selected @endif>全部</option>
                                    <option value="上学期" @if(request('semester')=='上学期') selected @endif>上学期</option>
                                    <option value="下学期" @if(request('semester')=='下学期') selected @endif>下学期</option>
                                </select>
                            </div>

                            <div class="form-group  text-right">
                                <button type="submit" class="btn btn-primary btn-sm">确认</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body p-0" style="overflow-x: auto">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">课程</th>
                                <th scope="col">类型</th>
                                <th scope="col">学年</th>
                                <th scope="col">学期</th>
                                <th scope="col">成绩</th>
                                <th scope="col">备注</th>
                                <th scope="col">创建时间</th>
                                <th scope="col">更新时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($scores as $score)
                                <tr>
                                    {{--<th scope="row">1</th>--}}
                                    <td>{{$score->id}}</td>
                                    <td>{{$score->course_name}}</td>
                                    <td>{{$score->type}}</td>
                                    <td>{{$score->year}}</td>
                                    <td>{{$score->semester}}</td>
                                    <td>{{$score->score}}</td>
                                    <td>{{$score->remark}}</td>
                                    <td>{{$score->created_at}}</td>
                                    <td>{{$score->updated_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()