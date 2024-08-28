@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="my-3">
                <a href="{{ route('client.tag.create') }}" class="btn btn-primary">Create a new tag</a>
            </div>

            <div class="content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Manage</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ route('client.tag.edit', $item->id) }}" class="btn btn-warning my-2">Edit</a>

                                    <form action="{{ route('client.tag.destroy', $item->id) }}" method="post">
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
