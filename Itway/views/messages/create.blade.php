
 {!! Form::open(['route' => 'room.store', 'class' => 'create-chat']) !!}
    <div class="col-md-6">
        <!-- Subject Form Input -->
        <div class="form-group">
            <h3 class="label titl"> name </h3>
            {!! Form::text('subject', null, ['class' => ' input input-line', 'placeholder' => 'write the name of the chat']) !!}
        </div>

        <!-- Message Form Input -->
        <div class="form-group">
            <h3 class="label titl">message</h3>
            {!! Form::textarea('message', null, ['class' => 'input input-line','placeholder' => 'Write an initial message...', 'rows' => '2']) !!}
        </div>
        <div class="clearfix"></div>
        <h3 class="label titl">select users</h3>

        @if($users->count() > 0)
            <div class="checkbox-users">
                @foreach($users as $user)
                    <div class="ui checkbox">
                        <input  type="checkbox" name="recipients[]" value="{!!$user->id!!}">
                        <label title="{!!$user->name!!}"><img class="media-object" alt="{{ $user->name }}" src="@include('includes.user-image', $user)">{!!$user->name!!}</label>
                    </div>
                @endforeach
            </div>
            @endif

                    <!-- Submit Form Input -->
            <div class="form-group chat-create-btn">
                {!! Form::submit('Submit', ['class' => 'button button-primary form-control']) !!}
            </div>
    </div>
    {!! Form::close() !!}