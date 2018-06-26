@extends('layouts.app')
@section('content')
    <div class="container">


        <h3>Update category</h3>

        <hr>

        {!! Form::open(array('route' => ['category.update', $category->id ],'method'=>'PUT')) !!}

        <div class="form-group">
            <label for="exampleFormControlInput1">Category name</label>
            <input name="name" type="text" value="{{$category->name}}" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">Parent Category</label>
            <select name="parent_id" multiple class="form-control">
                <option value="" selected="selected">-</option>
                @foreach($categories as $cat)
                    <?php $temp_cat = 0;?>
                    @if($cat->parent_id == 0)
                    <?php $temp_cat = $cat->id;?>
                    @endif
                    @if($cat->id != $category->id)
                            @if($cat->id != $temp_cat)
                                <option class="par" value="{{$cat->id}}">{{$cat->name}}</option>
                                @else
                                <option class="not_par" value="{{$cat->id}}">{{$cat->name}}</option>
                            @endif
                    @endif
                @endforeach
            </select>
        </div>

        {{Form::submit('Submit',['class'=>'btn btn-success'])}}

        {!! Form::close() !!}


    </div>
@endsection