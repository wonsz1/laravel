@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Add Task
    </div>
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- New Task Form -->
        <form action="{{ url('/task')}} " method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- Task Name -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>

    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Task</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <!-- Task Name -->
                            <td class="table-text">
                                <div>{{ $task->name }}</div>
                            </td>

                            <td>
                                <form action="{{ url('/task/' . $task->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


    <!-- TODO: Current Tasks -->
@endsection