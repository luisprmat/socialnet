@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card border-0">
                    <form action="{{ route('status.store') }}" method="POST">
                        @csrf
                        <div class="card-body bg-light">
                            <textarea class="form-control border-0 bg-light" name="body" placeholder="¿Qué estás pensando Luis?"></textarea>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" id="create-status">Publicar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

