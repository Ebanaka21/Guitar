@foreach($comments as $comment)
    @if($comment->status === 'approved')
        <div class="mb-4 p-4 border rounded">
            <strong>{{ $comment->user->name }}</strong>
            <p>{{ $comment->content }}</p>
            <small>{{ $comment->created_at->format('d.m.Y H:i') }}</small>
        </div>
    @endif
@endforeach
