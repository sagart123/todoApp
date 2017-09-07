@extends('welcome')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                @include('common.error')

                <!-- New Task Form -->
                    <form action="{{ url('task')}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control"
                                       value="{{ old('task') }}">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        Current Tasks
                        <form action="{{ url('task/all') }}" method="POST">
                            {{ csrf_field() }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i>Delete all
                            </button>
                        </form>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                            <th>Task</th>
                            <th>&nbsp;</th>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $task->name }}</div>
                                    </td>

                                    <!-- Task Delete Button -->
                                    <td>
                                        <form action="{{ url('task/'.$task->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <tbody>
                        @foreach($tasks as $task)
                            @if($task->done)
                                <tr>
                                    <td>{{$task->name}}</td>
                                    <td>
                                        <form action="{{ url('task/' . $task->id) }}" method="post">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                        </form> <br>
                                        <form action="{{ url('task/undo/' . $task->id) }}" method="post">
                                            <button type="submit" class="btn btn-success">Return back</button>
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection