@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">My Petitions</div>

                <div class="panel-body">
                    <button id="addbutton" style="float:right" onclick="location.href='{{ url('/petition/create') }}'" type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button><br/><br/>
                    @include('petition.partials.list', ['controls' => true])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
