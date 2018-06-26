@extends('layouts.app')
@section('content')
    <div class="container">


        <h3>Add category</h3>

        <hr>

        {!! Form::open(array('route' => 'category.store')) !!}

        <div class="form-group">
            <label for="exampleFormControlInput1">Category name</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">Parent Category</label>
            <select name="parent_id" multiple class="form-control">
                <option value="" selected="selected">-</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        {{Form::submit('Submit',['class'=>'btn btn-success'])}}

        {!! Form::close() !!}


    </div>
@endsection