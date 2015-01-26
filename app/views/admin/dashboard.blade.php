@extends('layouts.master')

@section('title')
Admin Dashboard
@stop


@section('content')
	<div class="container" style="margin-top:80px, margin-bottom:80px,">	
		<p><a href="/admin/codes">Codes</a></p>
		<p><a href="/admin/users">Users</a></p>
	</div>	
@stop
