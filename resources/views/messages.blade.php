@extends('layouts.app')

@section('content')
    <div class="">
        @foreach($messages as $message)
                <div class="message_box">
                    <img src="/storage/message/{{$message->m_photo}}" class="img-fluid">
                    <div class="message_text_box">
                        <h4>{{ $message->m_title}}</h4>
                        <p>{{$message->m_body}}</p>
                        <small>Message by User: <strong>  {{ $message->m_username}}</strong></small>
                        <small>Created at: {{ $message->created_at}}</small>
                    </div>
                </div>
        @endforeach
    </div>
@endsection
