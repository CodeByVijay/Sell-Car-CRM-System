@extends('errors.app')
@section('title','403')
@section('content')
	<div class="error-page d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="pd-10">
			<div class="error-page-wrap text-center">
				<h1>403</h1>
				<h3>Error: 403 Forbidden</h3>
				<p>Sorry, access to this resource on the server is denied.<br>Either check the URL</p>
				<div class="pt-20 mx-auto max-width-200">
                    <a href="{{route('login')}}" class="btn btn-primary btn-block btn-lg">Go To Login</a>
				</div>
			</div>
		</div>
	</div>
    @endsection
