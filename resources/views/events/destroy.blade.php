{!! Form::open(array('class' => '', 'style'=>'width:auto;height:auto;display:inline;', 'method' => 'DELETE', 'url' => [route('itway::events::delete', $event->id)])) !!}

{!! Form::submit('Delete', array('class' => 'button button-danger')) !!}

{!! Form::close() !!}