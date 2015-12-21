@if (count($errors) > 0)
    <div class="ui error message">
        <i class="close icon icon-close"></i>

        <p class="error-small-header">
            <strong>WT hack!</strong> Problems apeared!
        </p>
        <ul class="list hidden">
            <strong>
                @foreach ($errors->all() as $error)
                    <li class="text-info">{{ $error }}</li>
                @endforeach
            </strong>
        </ul>
    </div>
@endif
