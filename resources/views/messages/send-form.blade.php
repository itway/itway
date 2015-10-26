


<div class="send-wrap ">
     <!-- Message Form Input -->
<div class="form-group">
    {!! Form::textarea('message', null, ['class' => 'form-control send-message input input-line', 'id'=> 'messageBox','placeholder' => 'Write a reply...', 'rows' => '2']) !!}
</div>

    <div class="button-panel row">
        <button type="submit" id="btnSendMessage" class="l-8 text-center button-primary button send-message-button pull-left"><i class="icon-envelope-o"></i> send</button>
        <a href="" class="l-3 button send-message-button button-primary pull-right" role="button"><i class="icon-upload"></i> add files</a>
    </div>
</div>