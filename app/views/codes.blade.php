@extends('layouts.master')

@section('title')
Codes
@stop


@section('content')
	@for ($i=0; $i<count($codes); $i++) 
		<p>{{ $codes[$i]->getId() }}</p> 
@stop
