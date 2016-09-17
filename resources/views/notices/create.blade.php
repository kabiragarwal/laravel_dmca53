@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="page-heading">Prepare A DMCA Notice</h1>
        
        {!! Form::open(['method' => 'get', 'action' =>'NoticesController@confirm']) !!}
        
        @include('errors.list')
        <div class="form-group">
        {!! Form::label('provider_id', 'Infringing Source:') !!} 
        {!! Form::select('provider_id', $provider, null, ['class' => 'form-control','placeholder' => 'Choose a provider'])!!}
        </div>
        
        <div class="form-group">
        {!! Form::label('infringing_title', 'Infringing Title:') !!} 
        {!! Form::text('infringing_title', null, ['class' => 'form-control'])!!}
        </div>
        
        <div class="form-group">
        {!! Form::label('infringing_link', 'Infringing Link:') !!} 
        {!! Form::text('infringing_link', null, ['class' => 'form-control'])!!}
        </div>
        
        <div class="form-group">
        {!! Form::label('original_link', 'Original Link:') !!} 
        {!! Form::text('original_link', null, ['class' => 'form-control'])!!}
        </div>
        
        <div class="form-group">
        {!! Form::label('additional_description', 'Additional Description:') !!} 
        {!! Form::textarea('additional_description', null, ['class' => 'form-control'])!!}
        </div>
        
        <div class="form-group">
        {!! Form::submit('submit', ['class' => 'btn btn-primary form-control']) !!} 
        </div>
        
        {!! Form::close() !!}
    </div>
    
    
</div>
@endsection
