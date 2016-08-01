@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Signature Added
                    <button onclick="location.href='{{ url('/') }}'" style="float:right; padding:5px 5px 5px 5px; margin:-5px -10px 5px 5px" type="button" class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </div>

                <div class="panel-body">
                    {{ $thanks_message }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
