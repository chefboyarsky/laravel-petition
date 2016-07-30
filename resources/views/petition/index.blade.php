@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <button style="float:right" onclick="location.href='{{ url('/petition/create') }}'"type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span> Add New
                    </button><br/><br/>
                    <ul class="list-group">
                        @foreach( $petitions as $petition )
                            <li class="list-group-item">
                                {{ $petition->title }}
                                <a href="{{ url('/petition/' . $petition->id . '/edit') }}">Edit</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
