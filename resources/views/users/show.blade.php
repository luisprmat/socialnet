@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('partials.user')
            </div>
            <div class="col-md-9">
                <div class="card border-0 bg-light shadow-sm">
                    <status-list
                        url="{{ route('users.statuses.index', $user) }}"
                    ></status-list>
                </div>
            </div>
        </div>
    </div>
@endsection

