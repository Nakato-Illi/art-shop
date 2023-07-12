@extends('layouts.app')

@section('content')
    <div class="create_message_flex">
        <div class="create_message_left">
            <h1>Send us a Message</h1>
            {!! Form::open(['action' => 'App\Http\Controllers\MessagesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('m_username', 'Username')}}
                {{Form::text('m_username', '', ['class' => 'form-control', 'placeholder' => 'Username'])}}
            </div>
            <div class="form-group">
                {{Form::label('m_title', 'Message Title')}}
                {{Form::text('m_title', '', ['class' => 'form-control', 'placeholder' => 'Message Title'])}}
            </div>
            <div class="form-group">
                {{Form::label('m_body', 'Message')}}
                {{Form::textarea('m_body', '', ['class' => 'form-control', 'placeholder' => 'Message'])}}
            </div>
            <div class=" create_message_img" >
                <p><strong>Add Image: </strong></p>
                <div>
                    <div>
                        {{ Form::radio('img', 'lob.png', true, ['id' => 'img1']) }}
                        {{ Form::label('img1', 'lob.png (default)')}}
                    </div>

                    <div>
                        {{ Form::radio('img', 'frage.png', false, ['id' => 'img2']) }}
                        {{ Form::label('img2', 'frage.png ')}}
                    </div>

                    <div>
                        {{ Form::radio('img', 'kritik.png', false, ['id' => 'img3']) }}
                        {{ Form::label('img3', 'kritik.png ')}}
                    </div>
                </div>


            </div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
        <div class="create_message_right">
            <img src="/storage/message/lob.png">
            <img src="/storage/message/frage.png">
            <img src="/storage/message/kritik.png">
        </div>
    </div>

@endsection
