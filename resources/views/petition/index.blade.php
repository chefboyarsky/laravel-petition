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
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div style="margin-top:5px">{{ $petition->title }}</div>
                                        </div>
                                        <div class="col-md-1" style="padding-right: 0;">
                                            <div style="float:right">
                                            {!! Form::open([
                                                'method' => 'GET',
                                                'route' => ['petition.edit', $petition->id]
                                            ]) !!}
                                                {!! Form::submit('Edit', ['class' => 'btn btn-info', 'style' => 'padding:5px']) !!}
                                            {!! Form::close() !!}
                                            </div>
                                        </div>
                                        <div class="col-md-1"> 
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['petition.destroy', $petition->id]
                                            ]) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'style' => 'padding:5px']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
