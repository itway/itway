    <style>
        #particles-js{
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
    <div class="landing">
    <div class="wrapper">
        <a href="/" target="_blank" title="Access the app" class="iw">Itway.io</a>
        <h1>
                {!! trans('landing.ult-devs') !!}
            <div class="landing-text text-center">
                {{ trans("landing.header") }} <br/> {{ trans("landing.header-break") }}
                <div class="subtext">{{ trans("landing.header-sub") }}</div>
            </div>
        </h1>

        <div class="buttons-landing">
            <a target="_blank" href="{{route("itway::teams::index")}}">

                <div>
                    <span>Go to</span>
                    <strong>Teams</strong>
                </div>
            </a>
            <a target="_blank" href="{{route("itway::events::index")}}">
                <div>
                    <span>Go to</span>
                    <strong>Events</strong>
                </div>
            </a>
            <a target="_blank" href="{{route("itway::chat")}}">
                <div>
                    <span>Go to</span>
                    <strong>Chat</strong>
                </div>
            </a>
            <a target="_blank" href="{{route("itway::job::index")}}">
                <div>
                    <span>Go to</span>
                    <strong>Job-Hunt</strong>
                </div>
            </a>
            <a class="cf_" target="_blank" href="{{route("itway::idea-show::index")}}">
                <div>
                    <span>Go to</span>
                    <strong>Idea-Share</strong>
                </div>
            </a>
            <a target="_blank" href="{{route("itway::posts::index")}}">
                <div>
                    <span>Go to</span>
                    <strong>Blog</strong>
                </div>
            </a>
            <a target="_blank" href="{{route("itway::task-board::index")}}">
                <div>
                    <span>Go to</span>
                    <strong>Task Board</strong>
                </div>
            </a>
        </div>
        <div class="access">
            <a class="button bg-danger" target="_blank" href="#"><i class="icon-youtube"></i><span> Youtube Live Demo</span></a>
        </div>
    </div>
        <div id="particles-js"></div>
    </div>

<div class="clearfix"></div>
<div class="container-fluid" style="margin-bottom: 0px!important; margin-top: 0px!important;  background-color: transparent; position: relative; overflow: hidden; padding-left: 0; padding-right:0;" >
    <section id="features" class="features">
        <div class="wrapper">
            <h2>
                <span>{{trans('landing.available-features')}}</span>
            </h2>
            <p>{{trans('landing.features-header')}}</p>
            <ul>
                <li>
                    <div>
                        <i class="icon-group"></i>
                    </div>
                    <h3>{{ trans("landing.teams-header") }}</h3>
                    <span>{{ trans("landing.teams-text") }}</span>
                </li>
                <li>
                    <div>
                        <i class="icon-poll"></i>
                    </div>
                    <h3>{{ trans("landing.quiz-header") }}</h3>
                    <span>{{ trans("landing.quiz-text") }}</span>
                </li>
                <li>
                    <div>
                        <i class="icon-pencil"></i>
                    </div>
                    <h3>{{ trans("landing.blog-header") }}</h3>
                    <span>{{ trans("landing.blog-text") }}</span>
                </li>
                <li>
                    <div>
                        <i class="icon-graduation-cap"></i>
                    </div>
                    <h3>{{ trans("landing.idea-share-header") }}</h3>
                    <span>{{ trans("landing.idea-share-text") }}</span>
                </li>
                <li>
                    <div>
                        <i class="icon-event"></i>
                    </div>
                    <h3>{{ trans("landing.events-header") }}</h3>
                    <span>{{ trans("landing.events-text") }}</span>
                </li>
                <li>
                    <div>
                        <i class="icon-briefcase"></i>
                    </div>
                    <h3>{{ trans("landing.job-hunt-header") }}</h3>
                    <span>{{ trans("landing.job-hunt-text") }}</span>
                </li>
                <li>
                    <div>
                        <i class="icon-chat"></i>
                    </div>
                    <h3>{{ trans("landing.chat-header") }}</h3>
                    <span>{{ trans("landing.chat-text") }}</span>
                </li>
                <li>
                    <div>
                        <i class="icon-tasks"></i>
                    </div>
                    <h3>{{ trans("landing.task-board-header") }}</h3>
                    <span>{{ trans("landing.task-board-text") }}</span>
                </li>
            </ul>
        </div>

    </section>

    <div class="text-center wrapper-bottom text-white" >{!! trans("landing.special-thanks") !!}</div>
</div>
@section('scripts-add')
<!-- particles.js lib - https://github.com/VincentGarreau/particles.js -->
<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    particlesJS("particles-js", {"particles":{"number":{"value":100,"density":{"enable":true,"value_area":800}},"color":{"value":"#707070"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3.8,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":128.27296486924183,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});var count_particles, stats, update; stats = new Stats; stats.setMode(0); stats.domElement.style.position = 'absolute'; stats.domElement.style.left = '0px'; stats.domElement.style.top = '0px'; document.body.appendChild(stats.domElement); count_particles = document.querySelector('.js-count-particles'); update = function() { stats.begin(); stats.end(); if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) { count_particles.innerText = window.pJSDom[0].pJS.particles.array.length; } requestAnimationFrame(update); }; requestAnimationFrame(update);;
</script>
    @endsection