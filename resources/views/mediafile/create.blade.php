@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-heading">Upload Files
                    <button onclick="location.href='{{ url('/home') }}'" style="float:right; padding:5px 5px 5px 5px; margin:-5px -10px 5px 5px" type="button" class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </div>

                <div class="panel-body">
                    <!-- TODO use Form tags -->
                    <form action="{{ url('/petition/' . $id . '/mediafile')}}" method="post" enctype="multipart/form-data">
                        {!! Form::token() !!}
                        {!! Form::file('filefield', null) !!}
                        <input type="submit">
                    </form>

                    <!-- TODO factor out shared code into template -->
                    @foreach($mediafiles as $mediafile)
                        @if ( $mediafile->mime == 'video/quicktime')
                            <div class="row" style="margin:5px">
                                <div class="col-md-7 col-md-offset-1">

                                    <video controls="controls" style="max-width:400px" width="100%" height="auto" name="Video Name" src="{{ URL::asset('/') . '/public/mediafiles/' . $mediafile->filename }}"></video>

                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['mediafile.destroy', $mediafile->id],
                                        'class' => 'btn-group'
                                    ]) !!}
                                        <button title="Delete Media" id="delete{{ $mediafile->id }}" type="submit" class="btn btn-danger" style="display:inline">
                                            <span class="glyphicon glyphicon-remove" style="margin:-5px"></span>
                                        </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @foreach($mediafiles as $mediafile)
                        @if ( $mediafile->mime != 'video/quicktime')
                            <div class="row" style="margin:5px">
                                <div class="col-md-7 col-md-offset-1">

                                    <img src="{{ URL::asset('/') . '/public/mediafiles/' . $mediafile->filename }}" style="max-width:100px; max-height:100px"/>

                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['mediafile.destroy', $mediafile->id],
                                        'class' => 'btn-group'
                                    ]) !!}
                                    <button title="Delete Media" id="delete{{ $mediafile->id }}" type="submit" class="btn btn-danger" style="display:inline">
                                        <span class="glyphicon glyphicon-remove" style="margin:-5px"></span>
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
