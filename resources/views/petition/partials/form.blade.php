{!! Form::token() !!}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}" style="padding-bottom:25px">
                            <label for="title" class="col-xs-3 control-label">Title</label>

                            <div class="col-xs-7">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $petition->title) }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('summary') ? ' has-error' : '' }}" style="padding-bottom:45px">
                            <label for="summary" class="col-xs-3 control-label">Summary</label>

                            <div class="col-xs-7">
                                <textarea id="summary" class="form-control" name="summary">{{ old('summary', $petition->summary) }}</textarea>

                                @if ($errors->has('summary'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('summary') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}" style="padding-bottom:45px">
                            <label for="body" class="col-xs-3 control-label">Body</label>

                            <div class="col-xs-7">
                                <textarea id="body" class="form-control" name="body">{{ old('body', $petition->body) }}</textarea>

                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" style="padding-bottom:25px; padding-top:25px">
                            <label class="col-xs-3 control-label">Thanks Messages</label>
                            <div class="col-xs-7">&nbsp;<br/></div>
                        </div>

                        <div class="clearfix hidden-xs-up"></div>

                        <div class="form-group{{ $errors->has('thanks_message') ? ' has-error' : '' }}" style="padding-bottom:45px">
                            <label for="thanks_message" class="col-xs-3 control-label">(site)</label>

                            <div class="col-xs-7">
                                <textarea id="thanks_message" class="form-control" name="thanks_message">{{ old('thanks_message', $petition->thanks_message) }}</textarea>

                                @if ($errors->has('thanks_message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('thanks_message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix hidden-xs-up"></div>

                        <div class="form-group{{ $errors->has('thanks_email') ? ' has-error' : '' }}" style="padding-bottom:45px">
                            <label for="thanks_email" class="col-xs-3 control-label">(email)</label>

                            <div class="col-xs-7">
                                <textarea id="thanks_email" class="form-control" name="thanks_email">{{ old('thanks_email', $petition->thanks_email) }}</textarea>

                                @if ($errors->has('thanks_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('thanks_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix hidden-xs-up"></div>

                       <div class="form-group{{ $errors->has('thanks_sms') ? ' has-error' : '' }}" style="padding-bottom:25px">
                            <label for="thanks_sms" class="col-xs-3 control-label">(SMS)</label>

                            <div class="col-xs-7">
                                <input id="thanks_sms" type="text" class="form-control" name="thanks_sms" value="{{ old('thanks_sms', $petition->thanks_sms) }}">

                                @if ($errors->has('thanks_sms'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('thanks_sms') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-3 col-md-offset-7" style="text-align:right">
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-ok" style="margin-right:10px"></span>Save
                                </button>
                            </div>
                        </div>
