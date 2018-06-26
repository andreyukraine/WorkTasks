@extends('layouts.app')
@section('content')
    <div class="container">


        <h3>Update task # - {{$task->id}}</h3>

        <hr>

        {!! Form::open(['route' => ['tasks.update', $task->id], 'method'=>'PUT']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Task Title') !!}
            {!! Form::text('title',$task->title, ['class'=>"form-control"]) !!}
            {{--<label for="exampleFormControlInput1">Task Title</label>--}}
            {{--<input name="title" type="text" class= id="title" value="{{$task->title}}">--}}
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">Task Manager</label>
            <input name="task_manager" type="text" class="form-control" id="task_manager" value="{{$task->task_manager}}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Task Description</label>
            <textarea name="task_description" class="form-control" id="exampleFormControlTextarea1" rows="3" >{{$task->descriptions}}</textarea>
        </div>

        {!! Form::close() !!}


    </div>
@endsection