@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="page-heading">Confirm The DMCA Notice</h1>
        
        <hr>
        
        {!! Form::open(['action' =>'NoticesController@store']) !!}
        
        @include('errors.list')
        
        <div class="form-group">
        {!! Form::textarea('template', $template, ['class' => 'form-control'])!!}
        </div>
        
        <div class="form-group">
        {!! Form::submit('Deliver DMCA Notice Now', ['class' => 'btn btn-primary form-control']) !!} 
        </div>
        
        {!! Form::close() !!}
    </div>
    
    
</div>
@endsection
