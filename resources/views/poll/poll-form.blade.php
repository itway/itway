
<div class="l-12 m-12 s-12">
    <div class="form-group">
        {!! Form::text('poll-name', null, ['class' => 'input input-line', 'id' => 'poll-name','placeholder' => trans('poll.name')])!!}
    </div>
    <div class="pos-rel">
        <div class="input-count">left <span id="poll-name-counter"></span> symbols.</div>
    </div>
    <div class="poll-form-block">

        <span class="label titl">{{trans('poll.options')}}</span>
        <div class="form-group" style="display: block" id="pollOptions">

        <div class="options-block">
            <i class="icon-circle">1</i>
            <input name="options[]" id="option-id1" type="text" class="input input-line">
            <a class="button remove" data-action="delete"><i class="icon-remove text-danger"></i></a>
            <a class="button add_new" data-action="add"><i class="icon-add"></i></a>
        </div>


        </div>
    </div>
    <div class="form-group">
        {!! Form::text('poll-hint', null, ['class' => 'input input-line', 'id' => 'poll-hint','rows' => '3', 'placeholder' => trans('poll.hint')])!!}
    </div>
    <div class="pos-rel">
        <div class="input-count">left <span id="poll-hint-counter"></span> symbols.</div>
    </div>

</div>
