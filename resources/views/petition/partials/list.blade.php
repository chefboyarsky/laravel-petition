                    <ul class="list-group">
                        @foreach( $petitions as $petition )
                            <li class="list-group-item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div style="margin-top:5px">{{ $petition->title }}</div>
                                        </div>

                                        @if ($controls )
                                        <div class="col-xs-7" style="padding-left:0">
                                            {!! Form::open([
                                                'method' => 'PUT',
                                                'route' => ['petition.publish', $petition->id],
                                                'class' => 'btn-group'
                                            ]) !!}
                                                <button title="{{ $petition->published ? 'Unpublish Petition' : 'Publish Petition' }}"
                                                        id="publish{{ $petition->id }}" type="submit" class="btn btn-{{ $petition->published ? 'warning' : 'primary' }}">
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
                                                <button title="Upload Media" type="submit" class="btn btn-info">
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
                                                <button title="Edit Petition" type="submit" class="btn btn-info">
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
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
