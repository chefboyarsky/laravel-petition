<div class="panel-group" id="accordion">
    @foreach( $petitions as $petition )
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $petition->id }}">{{ $petition->title }}</a>
                </h4>
            </div>
            <div id="collapse{{ $petition->id }}" class="panel-collapse collapse">
                <div class="panel-body">
                    <div style="margin-top:5px"><b>{{ $petition->summary }}</b>
                        @if( !$petition->mediafiles->isEmpty() )
                            <hr/>
                            @foreach($petition->mediafiles as $mediafile)
                                <img src="{{ URL::asset('/') . '/public/mediafiles/' . $mediafile->filename }}" style="max-width:100px; max-height:100px"/>
                            @endforeach
                        @endif
                        <hr/>
                        {{ $petition->body }}
                    </div>
                </div>
                <div class="panel-footer" style="height:50px">
                    @if ( $controls )
                        <div style="float:right">

                            {!! Form::open([
                                'method' => 'PUT',
                                'route' => ['petition.publish', $petition->id],
                                'class' => 'btn-group'
                            ]) !!}
                                <button title="{{ $petition->published ? 'Unpublish Petition' : 'Publish Petition' }}"
                                        id="publish{{ $petition->id }}"
                                        type="submit"
                                        class="btn btn-{{ $petition->published ? 'warning' : 'primary' }}">
                                    <span class="glyphicon glyphicon-{{ $petition->published ? 'check' : 'globe' }}" style="margin:-5px"></span>
                                </button>
                                <input type="hidden" class="btn"><!-- fake sibling to right -->
                            {!! Form::close() !!}

                            {!! Form::open([
                                'method' => 'GET',
                                'route' => ['petition.mediafiles', $petition->id],
                                'class' => 'btn-group'
                            ]) !!}
                                <input type="hidden" class="btn"><!-- fake sibling to left -->
                                <button title="Upload Media"
                                        type="submit"
                                        class="btn btn-info">
                                    <span class="glyphicon glyphicon-file" style="margin:-5px"></span>
                                </button>
                                <input type="hidden" class="btn"><!-- fake sibling to right -->
                            {!! Form::close() !!}

                            {!! Form::open([
                                'method' => 'GET',
                                'route' => ['petition.edit', $petition->id],
                                'class' => 'btn-group'
                            ]) !!}
                                <input type="hidden" class="btn"><!-- fake sibling to left -->
                                <button title="Edit Petition"
                                        type="submit"
                                        class="btn btn-info">
                                    <span class="glyphicon glyphicon-pencil" style="margin:-5px"></span>
                                </button>
                                <input type="hidden" class="btn"><!-- fake sibling to right -->
                            {!! Form::close() !!}

                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['petition.destroy', $petition->id],
                                'class' => 'btn-group'
                            ]) !!}
                                <input type="hidden" class="btn"><!-- fake sibling to left -->
                                <button title="Delete Petition" id="delete{{ $petition->id }}" type="submit" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-remove" style="margin:-5px"></span>
                                </button>
                            {!! Form::close() !!}
                        </div>
                    @else
                        <div style="float:right">
                            {!! Form::open([
                            'method' => 'GET',
                            'route' => ['signatory.sign', $petition->id],
                            'class' => 'btn-group'
                            ]) !!}
                            <input type="hidden" class="btn"><!-- fake sibling to left -->
                            <button title="Sign Petition"
                                    type="submit"
                                    class="btn btn-success">
                                <span class="glyphicon glyphicon-pencil" style="margin:-5px"></span>
                            </button>
                            <input type="hidden" class="btn"><!-- fake sibling to right -->
                            {!! Form::close() !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
