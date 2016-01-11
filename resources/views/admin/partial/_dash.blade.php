<!-- Main content -->
<section class="content">
    <div class="row">
        <h4 class="ui horizontal divider header">
            <i class="icon-users icon text-twitter"></i>
            Users Info
        </h4>
        <div class="ui segment admin-segment">
            <div class="ui three statistics" style="margin-top: 0px">
                <div class="statistic">
                    <div class="value">
                        0
                    </div>
                    <div class="label">
                        Today New users
                    </div>
                </div>
                <div class="statistic">
                    <div class="value">
                        <i class="icon-user icon"></i>
                        {!! Visitor::loggedIn()->count() !!}
                    </div>
                    <div class="label">
                        LoggedIn Visitors
                    </div>
                </div>
                <div class="statistic">
                    <div class="value">
                        <img src="/images/joe.jpg" class="ui circular inline image">
                        {{Itway\Models\User::all()->count()}}
                    </div>
                    <div class="label">
                        All Users
                    </div>
                </div>
            </div>
        </div>
        <h4 class="ui horizontal divider header">
            <i class="icon-view_list icon text-brown"></i>
            Instances Info
        </h4>
        <div class="ui segment admin-segment">
            <div class="ui three statistics">
                <div class="statistic">
                    <div class="value">
                        <i class="icon-pencil icon"></i>
                        {!! $countTodayPosts !!}
                    </div>
                    <div class="label">
                        Today's posts
                    </div>
                </div>
                <div class="statistic">
                    <div class="value">
                        <i class="icon-event icon"></i>
                        {!! $countTodayEvents !!}
                    </div>
                    <div class="label">
                        Today's events
                    </div>
                </div>
                <div class="statistic">
                    <div class="value">
                        <i class="icon-group icon"></i>
                        {!! $countTodayTeams !!}
                    </div>
                    <div class="label">
                        Today's teams
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->
