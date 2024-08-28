@extends('layouts.app')

@section('content')
    <div class="container w-50">
        <div class="row">
            <div class="my-3">
                <a href="{{ route('client.home') }}" class="btn btn-secondary">Back</a>
            </div>

            <div class="mb-3">
                <h3>
                    Edit {{Auth::user()->name }}'s profile
                </h3>
            </div>

            <div class="content">
                <form action="{{ route('client.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mt-3">
                        <label for="bio">Bio</label>
                        <textarea class="form-control" name="bio" id="bio" cols="95" rows="5"
                            placeholder="Enter your bio...">{{ $user->bio }}</textarea>
                        @error('bio')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="date_of_birth">Date of birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                            placeholder="Enter your date_of_birth..." value="{{ $user->date_of_birth }}">

                        @error('date_of_birth')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="avatar">Avatar</label>
                        <input type="file" class="form-control" id="avatar" name="avatar">

                        @error('avatar')
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
