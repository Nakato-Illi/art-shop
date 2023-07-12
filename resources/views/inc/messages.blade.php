@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert-danger alert">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert-success alert">
        {{session('success')}}
    </div>
@endif


@if(session('error'))
    <div class="alert-danger alert">
        {{session('error')}}
    </div>
@endif
