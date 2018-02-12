<!DOCTYPE html>
<html>
    <head>
	<title>Forum</title>
    </head>
    <body>
	@if($errors->any())
	    <div>
		The following errors have occured:
	    <ul>
		@foreach($errors->all() as $error)
		    <li>{{ $error }}</li>
		@endforeach
	    </ul>
	    </div>
	@endif
	<div>
	    {!! Form::open(['route' => 'forum.home.post']) !!}
	    <div>
		{!! Form::label('author', 'Author:') !!}
		{!! Form::text('author', null, null) !!}
	    </div>
	    <div>
		{!! Form::label('subject', 'Subject:') !!}
		{!! Form::text('subject', null, null) !!}
	    </div>
	    <div>
		{!! Form::label('content', 'Comment:') !!}
		{!! Form::text('content', null, null) !!}
	    </div>
	    <div>
		{!! Form::submit('Submit', null) !!}
	    </div>
	    {!! Form::close() !!}
	</div>
	@if(count($threads) != 0)
	    @foreach($threads as $thread)
		<div style="border: 2px solid black; margin: 5px 0px">
		    <p>Author:{{ $thread->author }}, Posted: {{ $thread->created }}</p>
		    <p>Subject: {{ $thread->subject }}</p>
		    <p>{{ $thread->content }}</p>
		    <a href="/reply/{{ $thread->id }}">Reply</a>
		</div>
	    @endforeach
	@else
	    There aren't any threads yet!
	@endif
    </body>
</html>
