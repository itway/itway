{!! Form::open(array('class' => '', 'style'=>'width:auto;height:auto;display:inline;', 'method' => 'DELETE', 'url' => [route('itway::quiz::delete', $quiz->id)])) !!}

{!! Form::submit('Delete', array('class' => 'button button-danger')) !!}

{!! Form::close() !!}