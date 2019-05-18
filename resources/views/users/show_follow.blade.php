@extends('layouts.default')

@section('title', $title)

@section('content')
<div class="offset-md-2 col-md-8">
    <div class="list-group list-group-flush">
        @foreach($users as $user)
            <div class="list-group-item">
                <img class="mr-3" src="{{ $user->gravatar() }}" alt="{{ $user->name }}" width=32>
                <a href="{{ route('users.show', $user->id) }}">
                    {{ $user->name }}
                </a>

            </div>
        @endforeach
    </div>

    <div class="mt-3">
        {!! $users->render() !!}
    </div>

</div>
@stop
