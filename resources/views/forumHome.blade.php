<!DOCTYPE html>
<html>
    <head>
	<title>Forum</title>
    </head>
    <body>
	<p>Form for posting threads goes here!</p>
	@if(count($threads) != 0)
	    @foreach($threads as $thread)
		<div>
		    <p>Author:{{ $thread->author }}, Posted: {{ $thread->created }}</p>
		    <p>Subject: {{ $thread->subject }}</p>
		    <a href="/reply/{{ $thread->id }}">Reply</a>
		</div>
	    @endforeach
	@else
	    There aren't any threads yet!
	@endif
    </body>
</html>
