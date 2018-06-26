@extends('layouts.app')

@section('content')
    <div class="container">


        <h3>Users</h3>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                 <div class="table-responsive">
                    <table class="table table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Data create</th>
                </tr>
        @foreach($users as $user)
                    <tr>
                        <td>{!! $user->id !!}</td>
                        <td>{!! $user->name !!}</td>
                        <td>{!! $user->role !!}</td>
                        <td>{!! $user->email !!}</td>
                        <td>{!! $user->created_at->format('d-m-Y') !!}</td>
                        {{--<td>--}}
                            {{--<a href="{!! route('tasks.show',$task->id) !!}"><span class="glyphicon glyphicon-eye-open"></span></a>--}}
                            {{--<a href="{{ route('tasks.edit',$task->id) }}"><span class="glyphicon glyphicon-pencil"></span></a>--}}
                            {{--<a href = 'delete/{{ $task->id }}'><span class="glyphicon glyphicon-remove"></span></a>--}}
                        {{--</td>--}}
                    </tr>
        @endforeach
            </table>
                 </div>
    </div>
            </div>
        </div>
@endsection