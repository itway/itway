<div class="remodal" data-remodal-id="create-team">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h3>create your team</h3>

    <p>

    <div class="bg-white" style="">
        {!! Form::model( $teamInstance = new Itway\Models\Team, ['url' => App::getLocale().'/teams/store', 'class' => 'ui form', 'id' => 'team-form', 'files' => true ] ) !!}
        <div class="l-12 m-12 s-12 create-form">
            <div class="description">
                <label for="photoUpload" class="filelabel filelabel-team custom-file-input">
                    @if(isset($model) && $model->picture())
                        <div class="photo-block">
                            <div class="thumbnail" style='background: #ffffff'>
                                @foreach($picture as $pic)
                                    <img class="img-responsive" style=""
                                         src="{!! asset('images/teams/' . $pic->path) !!}">
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="photo-block"></div>
                    @endif
                    <span class="upload-span"><i class="fa fa-camera fa-2x"></i><br>Upload<br>team logo</span>
                </label>
                {!! Form::file('logo', ['id' => 'photoUpload','class' => 'file-input', 'data-multiple-caption'=> null, 'placeholder' => 'insert your post image here      (max: 1 )']) !!}
            </div>
            <br>

            <div class="field">
                <div class="title-block ">
                    <span class="label titl">{{trans('team-form.name')}}</span>

                    <div class="clearfix"></div>
                    {!! Form::text('name', null, ['class' => 'input-line', 'id' => 'title','placeholder' => 'insert team\'s name here      (max:120)'])!!}
                    <div class="pos-rel">
                        <div class="input-count">left <span id="counter1"></span> symbols.</div>
                    </div>
                    <div class="clearfix"></div>
                    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>

            <div class="field">
                <div class="tag-block">
                    <span class="label titl">#{{trans('team-form.tags')}}</span>

                    <div class="clearfix"></div>
                    {!! $tagsBuilder !!}
                    <div class="clearfix"></div>
                    {!! $errors->first('tags_list', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="field">
                <select multiple="multiple" style="z-index: 24!important;" name="trend[]" class="ui selection dropdown"
                        id="select-trend">
                    <option value="">Team's trend</option>
                    <option value="IT_consulting">IT-consulting</option>
                    <option value="Desktop">Desktop</option>
                    <option value="Mobile">Mobile</option>
                    <option value="HR">HR</option>
                    <option value="Web">Web</option>
                </select>
            </div>
            <div class="field">
                {!! $countryBuilder !!}
            </div>
            <div class="clearfix"></div>
            <div class="" style="text-align: center">
                <button data-remodal-action="cancel" class="remodal-cancel button button-danger">Cancel</button>
                {!! Form::submit('Create team', ['class' => 'confirm button button-primary'])!!}
            </div>
        </div>
        {!! Form::close() !!}
        <div class="clearfix"></div>
    </div>
    </p>
    @include('teams.create-team-scripts')
</div>
