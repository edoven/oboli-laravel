@extends('layouts.master')

@section('title')
Codes
@stop


@section('content')
	@for ($i=0; $i<count($codes); $i++) 
		<p><a href="code/{{ $codes[$i]->getId() }}">{{ $codes[$i]->getId() }}</a></p> 
	@endfor
@stop
