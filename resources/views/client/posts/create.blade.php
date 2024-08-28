@extends('layouts.app')

@section('content')
    <div class="container w-50">
        <div class="row">
            <div class="my-3">
                <a href="{{ route('client.home') }}" class="btn btn-secondary">Back</a>
            </div>

            <div class="content">
                <form action="{{ route('client.post.store') }}" method="post">
                    @csrf

                    <div class="mt-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Enter your title...">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="content">Content</label>
                        <textarea class="form-control" name="content" id="content" cols="95" rows="5"
                            placeholder="Enter your content..."></textarea>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="post_tag">Select Tags</label>
                        <select class="form-select" name="tags[]" id="post_tag" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-primary w-100">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
