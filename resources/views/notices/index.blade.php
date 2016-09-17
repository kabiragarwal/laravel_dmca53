@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-heading">DMCA Notice Lists</h1>
    <hr>
    
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>This Content:</th>
                <th>Accessible Here:</th>
                <th>Is Infringing Upon My Work Here:</th>
                <th>Notice Sent:</th>
                <th>Content removed:</th>
            </tr>
        </thead>
        <tbody>
            <?php //@foreach($notices->where('content_removed',0, false) as $notice) ?>
            @foreach($notices as $notice)
                <tr>
                    <td>{{$notice->infringing_title}}</td>
                    <td>{!! link_to($notice->infringing_link) !!}</td>
                    <td>{!! link_to($notice->original_link) !!}</td>
                    <td>{{ $notice->created_at->diffForHumans() }}</td>
                    <td>
                        {!! Form::open(['data-remote', 'method' => 'patch', 'url' =>'notices/'.$notice->id]) !!}
                        
                        <div class="form-group">
                            {!! Form::checkbox('content_removed',$notice->content_removed,$notice->content_removed,['data-click-submits-form']) !!}
                            
                            {!!  Form::submit('Submit') !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @unless(count($notices))
        <p class="text-center">you haven't sent any DMCA notice yet!</p>
    @endunless
</div>
@endsection
