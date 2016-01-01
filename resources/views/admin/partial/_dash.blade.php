<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="ui cards" style="margin-top: 0px">
        <div class="l-4 xs-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        {!! $countTodayPosts !!}
                    </h3>
                    <p>
                        Today's posts
                    </p>
                </div>
                <div class="icon">
                    <i class="icon-pencil"></i>
                </div>
                <a href="{{route('itway::posts::index')}}" class="small-box-footer">
                    More info <i class="icon-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="l-4 xs-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>
                        {{Itway\Models\User::all()->count()}}
                    </h3>
                    <p>
                        User Registrations
                    </p>
                </div>
                <div class="icon">
                    <i class="icon-user"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="icon-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="l-4 xs-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>
                        {!! Visitor::loggedIn()->count() !!}
                    </h3>
                    <p>
                        LoggedIn Visitors
                    </p>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="icon-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    </div><!-- /.row -->
 </div>
</section><!-- /.content -->
