@include('includes.head')
<body>

@include('includes.navigation')


<div class="container" style="margin-top: 60px;margin-bottom: 40px;">

    <div class="row">
		<div class="l-8 l-offset-2 m-8 m-offset-2 s-10 s-offset-1 xs-12" style="margin-bottom:10px;padding: 0 0">
			@include('includes.errors')
		</div>
        <div class="l-8 l-offset-2 m-8 m-offset-2 s-10 s-offset-1 xs-12  bg-white">
            <div class="title text-center text-primary">Reset Password</div>
					@if (session('status'))
						<div class="text-success text-center">
							{{ session('status') }}
						</div>
					@endif

					<form class="form" role="form" method="POST" action="{{ url('/password/email') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class=" l-4 m-4 s-4 xs-4 text-center label">E-Mail Address</label>
							<div class=" l-6 m-6 s-7 xs-7">
								<input type="email" class="input input-line" name="email" value="{{ old('email') }}">
							</div>
						</div>
						<div class="text-center">
							{!! $errors->first('email', '<div class="text-danger">:message</div>') !!}
						</div>
						<div class="form-group">
							<div class="  l-8 m-8 s-8 xs-8  m-offset-4 s-offset-4 xs-offset-4">
								<button type="submit" class="button button-primary">
									Send Password Reset Link
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
@include('includes.footer')
