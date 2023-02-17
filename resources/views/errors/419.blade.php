@extends('errors.app')
@section('title','419')
@section('content')
	<div class="error-page d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="pd-10">
			<div class="error-page-wrap text-center">
				<h1>419</h1>
				<h3>Error: 419 CSRF Token Not Found</h3>
				<p>An error ocurred and your request couldn’t be completed..<br>Either check the URL</p>
				<div class="pt-20 mx-auto max-width-200">
                    <a href="javascript:void(0)" onclick="history.back()" class="btn btn-primary btn-block btn-lg">Go To Back</a>

				</div>
			</div>
		</div>
	</div>
@endsection
