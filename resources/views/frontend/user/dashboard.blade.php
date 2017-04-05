@extends('frontend.layouts.app')

@section('content')

@if (Auth::check())

<form action="{{route('posts.store')}}" method="post">
    {{csrf_field()}}
    @foreach (Config::get('locale.languages') as $key => $val)
          
           {!! Form::label('title', trans("labels.frontend.user.profile.post").':('. $key.')', ['class' => '']) !!}
           
           {{ Form::text("text_".$key, null, ['class' => 'form-control', 'placeholder' => 'post']) }}
    @endforeach
     <input type="submit" value="Save" class="btn btn-default">
</form>

@foreach($posts as $post)

<li>{{ $post->text }}</li>

@endforeach

@else
<script type="text/javascript">
    window.location.href="/";//here double curly bracket
</script>
@endif

@endsection
