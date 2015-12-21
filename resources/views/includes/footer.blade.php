<footer id="footer" class="container-fluid">
    <h6 class="text-center text-white">{{ trans('footer.head') }}
        <span class="love-to-it">IT & Web</span>
    </h6>

    <div>
        <div class="l-12  m-12  s-12  xs-12 text-center">
            <p class="text-success">{{ trans('footer.online') }}</p>
            <button id="vk" name="vk" class="button button-info">VK <span class="icon-vk"></span>
            </button>
            <button id="facebook" name="facebook" class="button button-primary">Facebook <span
                        class="icon-facebook"></span>
            </button>
            <button id="google" name="google" class="button button-danger">Google+ <span
                        class="icon-googleplus2"></span>
            </button>
        </div>

    </div>
    <div class="row text-center">

        <p class="pull-right" style="width:100%">
            <copyright>Copyright 2015</copyright>
        </p>
        <small><a class="text-right" href="/">Created by Nilsenj</a></small>
    </div>
    </div>

</footer>

@include('includes.scripts')


