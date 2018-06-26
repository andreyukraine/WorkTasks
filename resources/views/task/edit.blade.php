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
            <label for="exampleFormControlInput2">Task status</label>
            <input name="status" type="text" class="form-control" id="status" value="{{$task->status}}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">Task Category</label>

            <select name="cat_id" multiple class="form-control">
                @if(!isset($select_category))
                    <option selected="selected" value="1">-</option>
                @else
                    <option value="1">-</option>
                @endif
                @foreach($categories as $category)
                        @if(isset($select_category))
                            @if($category->id == $select_category->id)
                            <option selected="selected" value="{{$category->id}}">{{$category->name}}</option>
                            @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Task Description</label>
            <textarea name="task_description" class="form-control" id="exampleFormControlTextarea1" rows="3" >{{$task->descriptions}}</textarea>
        </div>

        {{Form::submit('Submit',['class'=>'btn btn-success'])}}

        {!! Form::close() !!}


    </div>
@endsection