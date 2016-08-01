@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Sign Petition - {{ $petition->title }}
                    <button onclick="location.href='{{ url('/') }}'" style="float:right; padding:5px 5px 5px 5px; margin:-5px -10px 5px 5px" type="button" class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </div>

                <div class="panel-body">
                    {!! Form::model($signature, [
                        'method' => 'POST',
                        'route'  => ['signatory.store', $petition->id],
                    ]) !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="padding-bottom:25px">
                            <label for="name" class="col-md-2 control-label">Name</label>
    
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', !Auth::guest() ? Auth::user()->name : '') }}">
    
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="padding-bottom:25px">
                            <label for="email" class="col-md-2 control-label">Email</label>
    
                            <div class="col-md-7">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email', !Auth::guest() ? Auth::user()->email : '') }}">
    
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
    
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}" style="padding-bottom:25px">
                            <label for="phone" class="col-md-2 control-label">Phone #</label>
    
                            <div class="col-md-7">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone', $signature->phone) }}">
    
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-7" style="text-align:right">
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-ok" style="margin-right:10px"></span>Sign
                                </button>
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
