@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Petition</div>

                <div class="panel-body">
                    {!! Form::model($petition, [
                        'method' => 'PATCH',
                        'route'  => ['petition.update', $petition->id]
                    ]) !!}

                    @include('petition.partials.form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
