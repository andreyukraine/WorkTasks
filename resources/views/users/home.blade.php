@extends('layouts.app')

@section('content')
<div class="container">


                <h3>User panel</h3>
                <hr>
                <p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </p>


</div>
@endsection
