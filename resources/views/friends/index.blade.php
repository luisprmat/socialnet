@extends('layouts.app')

@section('content')
    <div class="container">
        @forelse ($friends as $friend)
            <p>{{ $friend->name }}</p>
        @empty
            <p>No tienes amigos aún</p>
        @endforelse
    </div>
@endsection

