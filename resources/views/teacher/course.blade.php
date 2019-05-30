@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div>
                    <h2>我的课程</h2>
                </div>
                <div class="card my-4">
                    <div class="card-header">
                        课程列表
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>名称</th>
                                <th>班级</th>
                                <th>学年</th>
                                <th>学期</th>
                                <th>学分</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{$course->course_name}}</td>
                                    <td>{{$course->class_name}}</td>
                                    <td>{{$course->year}}</td>
                                    <td>{{$course->semester}}</td>
                                    <td>{{$course->credit}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection