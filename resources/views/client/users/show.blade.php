@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="profile-page">
            <div class="content">
                <div class="content__cover">
                    <div class="content__avatar">
                        @if ($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" alt="">
                        @else
                            <img src="https://www.hdwallpapers.in/download/cristiano_ronaldo_cr7_with_cup_in_blur_stadium_background_is_wearing_white_sports_dress_hd_cristiano_ronaldo-HD.jpg"
                                alt="">
                        @endif
                    </div>
                    <div class="content__bull"><span></span><span></span><span></span><span></span><span></span>
                    </div>
                </div>

                <div class="content__title">
                    <h1>{{ $user->name }}</h1>
                    <span>{{ $user->email }}</span>
                </div>

                <div class="content__description">
                    <p>
                        @if ($user->bio)
                            {{ $user->bio }}
                        @else
                            No bio.
                        @endif
                    </p>
                </div>

                <ul class="content__list">
                    <li>
                        <span>
                            @if ($user->date_of_birth)
                                {{ Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') }}
                            @else
                                No date_of_birth.
                            @endif
                        </span>
                    </li>
                </ul>

                <div class="content__button">
                    <a class="button" href="{{ route('client.home') }}">
                        <div class="button__border"></div>
                        <div class="button__bg"></div>
                        <p class="button__text">Back</p>
                    </a>

                    <a class="button" href="{{ route('client.profile.edit') }}">
                        <div class="button__border"></div>
                        <div class="button__bg"></div>
                        <p class="button__text">Edit</p>
                    </a>
                </div>
            </div>

            <div class="bg">
                <div><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
                </div>
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
    @if (session('error'))
        <script>
            swal("Good job!", "{{ session('error') }}", "error");
        </script>
    @endif
@endsection
