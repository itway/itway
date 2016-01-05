
@extends('admin/app')
@section('navigation.buttons')
    @include('user.site-btns')
@overwrite

@if(count($users)=== 0 )

    @include('errors.nothing')

@else
@section('content')
    <span class="admin-head-title">
        The number of users ({!! \Itway\Models\User::all()->count() !!})
        &middot;
        <b class="pull-right">{!! link_to_route('admin::users::create', 'Add new user') !!}</b>
    </span>
    <div class="row admin-block">
        <div class="xs-12">
            <div class="block branding">
                <div class="header">
                    <h3 class="title text-center">The list of users</h3>
                    <div class="block-tools">
                        <form action="#" method="get" class="input-group" >
                            <input type="text" name="q" class="input input-l inline" placeholder="Search">
                            <button class="button button-group"><i class="icon-search"></i></button>
                        </form>

                    </div>
                </div><!-- /.box-header -->
                <div class="content table-responsive no-padding">
                    <table class="table table-hover">
        <thead style="width: 100%!important;">
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created at</th>
        <th>Role</th>
        <th class="text-right text-info">Actions</th>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{!! $no !!}</td>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->created_at !!}</td>
                <td>
                    @foreach ($user->roles()->get() as $role)
                        {{ $role->name }}
                    @endforeach</td>
                <td class="text-center">
                    <a href="{!! route('admin::users::edit', $user->id) !!}">change</a>
                </td>
                <td class="text-center">
                    <a class="text-warning" href="{!! route('admin::users::ban', $user->id) !!}"> @if($user->banned === 0) ban @else unban @endif</a>
                </td>
                <td class="text-center">
                {!! Form::open(['class' => '', 'style'=>'width:auto;height:auto;display:inline;', 'method' => 'DELETE', 'url' => [route('admin::users::delete', $user->id)]])!!}
                {!! Form::submit('delete', array('class' => 'href text-danger')) !!}
                {!! Form::close()!!}
                </td>
            </tr>
            <?php $no++ ;?>
        @endforeach
        </tbody>
    </table>
    </div><!-- /.box-body -->
    </div><!-- /.box -->
    </div>
    </div>
    <div class="text-center">
        {!! (new Itway\Models\Pagination($users))->render() !!}
    </div>
@endif
@overwrite
@section('scripts-add')
    <script>
        var disqus_shortname = '{{ Config::get("config.disqus_shortname") }}';
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
            var s = document.createElement('script');
            s.async = true;
            s.type = 'text/javascript';
            s.src = '//' + disqus_shortname + '.disqus.com/count.js';
            (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
    </script>

@overwrite
