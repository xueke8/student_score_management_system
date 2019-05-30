@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div>
                    <h2>成绩列表</h2>
                </div>
                <div class="card my-4">

                    <div class="card-header">

                        <div class="row">
                            <div class="col-6">
                                <form action="" class="form-inline m-0">

                                    {{--课程下拉框--}}
                                    <div class="form-group">
                                        <label for="course_id">课程</label>
                                        <select name="course_id" class="form-control form-control ml-2" id="course_id">
                                            @foreach($courses as $course)
                                                <option @if(request('course_id')==$course->id) selected
                                                        @endif  value="{{$course->id}}">
                                                    {{$course->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{--班级下拉框--}}
                                    <div class="form-group ml-4">
                                        <label for="class_id">班级</label>
                                        <select name="class_id" class="form-control form-control ml-2" id="class_id">
                                            @if($courses)
                                                @foreach($classes as $class)
                                                    <option @if(request('class_id')==$class->id) selected
                                                            @endif  value="{{$class->id}}">
                                                        {{$class->name}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="ml-4">
                                        <button type="submit" class="btn btn-success">确认</button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-6">
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                        data-target="#addScoreModal"><i class="fa fa-plus"></i> 新增
                                </button>

                                <div class="modal fade" id="addScoreModal" tabindex="-1" role="dialog"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">添加成绩</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="m-0"
                                                  action="{{route('teacher.score')}}?course_id={{request('course_id')}}&class_id={{request('class_id')}}"
                                                  method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="student_id" class="col-form-label">学生</label>
                                                        <select name="student_id" id="student_id"
                                                                class="form-control @if($errors->has('student_id')) is-invalid @endif">
                                                        </select>
                                                        @if($errors->has('student_id'))
                                                            @foreach($errors->get('student_id') as $message)
                                                                <p class="invalid-feedback">{{$message}}</p>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="type" class="col-form-label">类型</label>
                                                        <select name="type" id="type"
                                                                class="form-control @if($errors->has('type')) is-invalid @endif">
                                                            <option value="初考">初考</option>
                                                            <option value="补考">补考</option>
                                                            <option value="清考">清考</option>
                                                        </select>
                                                        @if($errors->has('type'))
                                                            @foreach($errors->get('type') as $message)
                                                                <p class="invalid-feedback">{{$message}}</p>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="score" class="col-form-label">成绩</label>
                                                        <input type="text"
                                                               class="form-control @if($errors->has('score')) is-invalid @endif"
                                                               id="score"
                                                               name="score" value="">
                                                        @if($errors->has('score'))
                                                            @foreach($errors->get('score') as $message)
                                                                <p class="invalid-feedback">{{$message}}</p>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="credit" class="col-form-label">学分</label>
                                                        <input type="text"
                                                               class="form-control @if($errors->has('credit')) is-invalid @endif"
                                                               id="credit"
                                                               name="credit" value="">
                                                        @if($errors->has('credit'))
                                                            @foreach($errors->get('credit') as $message)
                                                                <p class="invalid-feedback">{{$message}}</p>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="remark" class="col-form-label">备注</label>
                                                        <textarea type="text" class="form-control" id="remark"
                                                                  name="remark"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">关闭
                                                    </button>
                                                    {{csrf_field()}}
                                                    <button type="submit" class="btn btn-primary">保存</button>
                                                    @if($errors->has('course_id'))
                                                        @foreach($errors->get('course_id') as $message)
                                                            <p class="invalid-feedback">{{$message}}</p>
                                                        @endforeach
                                                    @endif
                                                    @if($errors->has('class_id'))
                                                        @foreach($errors->get('class_id') as $message)
                                                            <p class="invalid-feedback">{{$message}}</p>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-body p-0 table-responsive">
                        <table id="table" class="table table-hover m-0">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">学号</th>
                                <th scope="col">姓名</th>
                                <th scope="col">学年</th>
                                <th scope="col">学期</th>
                                <th scope="col">类型</th>
                                <th scope="col">成绩</th>
                                <th scope="col">学分</th>
                                <th scope="col">备注</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($scores as $score)

                                <tr>
                                    <td>{{$score->id}}</td>
                                    <td>{{$score->student_id}}</td>
                                    <td>{{$score->student->name}}</td>
                                    <td>{{$score->year}}</td>
                                    <td>{{$score->semester}}</td>
                                    <td>{{$score->type}}</td>
                                    <td>{{$score->score}}</td>
                                    <td>{{$score->credit}}</td>
                                    <td>{{$score->remark}}</td>
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

@section('foot')
    <script>

        $(document).ready(function () {

            @if($errors->count()>0)
            $('#addScoreModal').modal('show');
            @endif

            $.get('/api/class-students/' + '{{request('class_id')}}', function (students) {

                let td_student_id_list = $("#table tbody tr :nth-child(2)");
                let student_id_list = [];

                for (let td of td_student_id_list) {
                    student_id_list.push($(td).text())
                }

                let un_enter_student = students.filter(function (item) {
                    if (!student_id_list.includes(item['student_id'])) {
                        return item;
                    }
                });

                un_enter_student.forEach(function (student) {
                    $("#student_id").append($('<option>').val(student['id']).text(student['name']));
                })
            });


            // 课程下拉联动
            $("#course_id").change(function () {

                console.log('ss');

                // 先清空第班级下拉框
                let class_selector = $("#class_id");
                class_selector.empty();

                // 从接口获取数据
                $.get('/api/course-classes/' + $("#course_id").val(), '', function (data, status) {

                    data.forEach(function (item) {
                        class_selector.append($("<option>").val(item['id']).text(item['name']))
                    });
                });
            });

        });
    </script>
@endsection