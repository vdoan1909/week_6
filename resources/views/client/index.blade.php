@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="my-3 d-flex justify-content-between">
                <a href="{{ route('client.post.create') }}" class="btn btn-primary">Create a new post</a>

                <div class="d-flex justify-content-center align-items-center gap-2">
                    @if (isset($title))
                        <a href="{{ route('client.home') }}" class="btn-close" aria-label="Close"></a>
                    @endif

                    <form class="form-group d-flex gap-2" action="{{ route('client.searchPostByTitle') }}" method="POST">
                        @csrf

                        <input class="form-control" type="text" name="title" placeholder="Search..."
                            value="{{ $title ?? '' }}">

                        <button class="btn btn-success">Search</button>
                    </form>
                </div>
            </div>

            <div class="content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Published At</th>
                            <th>Tags</th>
                            <th>Manage</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ Str::limit($item['title'], 20) }}</td>
                                <td>{{ Str::limit($item['content'], 100) }}</td>
                                <td>{{ $item['published_at'] }}</td>
                                <td>
                                    <form action="{{ route('client.searchPostByTag') }}" method="post">
                                        @csrf

                                        @foreach ($item['tags'] as $tag)
                                            <input type="submit" class="btn btn-secondary btn-sm" name="tag"
                                                value="{{ $tag['name'] }}">
                                        @endforeach
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('client.post.show', $item['slug']) }}" class="btn btn-info">Show</a>

                                    <a href="{{ route('client.post.edit', $item['slug']) }}"
                                        class="btn btn-warning my-2">Edit</a>

                                    <form action="{{ route('client.post.destroy', $item['slug']) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Yet suree???')"
                                            class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('toast')
    @if (session('success'))
        <script>
            swal("Good job!", "{{ session('success') }}", "success");
        </script>
    @endif
@endsection
