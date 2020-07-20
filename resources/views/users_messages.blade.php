@foreach($posts as $post)
    <div class="chat-line-item">
        <div class="{{ $post['class'] ?? ''}}">
            <p class="font-italic font-weight-bold"> {{ $post['name_sender'] ?? ''}} </p>
            <p>{{ $post['message'] ?? ''}}</p>
            <p>{{ $post['date_time'] ?? ''}}</p>
        </div>
    </div>
@endforeach
