@extends('layouts.app')

@section('content')
    <div class="container w-50">
        <div class="row">
            <div class="my-3">
                <a href="{{ route('client.home') }}" class="btn btn-secondary">Back</a>
            </div>

            <div class="mb-3">
                <h3>
                    Show post: {{ $post->title }}
                </h3>
            </div>

            <div class="content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Published At</th>
                            <th>Tags</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->content }}</td>
                            <td>{{ $post->published_at }}</td>
                            <td>
                                @foreach ($post->tags as $tag)
                                    {{ $tag->name }}
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
