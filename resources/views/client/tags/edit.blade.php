@extends('layouts.app')

@section('content')
    <div class="container w-50">
        <div class="row">
            <div class="my-3">
                <a href="{{ route('client.tag.index') }}" class="btn btn-secondary">Back</a>
            </div>

            <div class="mb-3">
                <h3>Edit tag: {{ $tag->name }}</h3>
            </div>

            <div class="content">
                <form action="{{ route('client.tag.update', $tag->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="mt-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter your name..." value="{{ $tag->name }}">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-primary w-100">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
