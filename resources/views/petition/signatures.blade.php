@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Signatures for {{ $petition->title }}
                    <button onclick="location.href='{{ url('/home') }}'" style="float:right; padding:5px 5px 5px 5px; margin:-5px -10px 5px 5px" type="button" class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </div>

                <div class="panel-body">
                        @foreach($petition->signatures as $signature)
                            <div class="list-group">
                                <a href="#" class="list-group-item active">{{ $signature->name }}</a>
                                <a href="#" class="list-group-item">{{ $signature->email }}</a>
                                <a href="#" class="list-group-item">{{ $signature->phone }}</a>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
