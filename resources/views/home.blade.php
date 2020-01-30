@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h2 class="text-center mb-5">My blog posts </h2>

            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (count($my_blog_posts) > 0)
                    <ul>
                        @foreach ($my_blog_posts as $post)

                        <li>
                            <h4> {{ $loop->iteration }}.- {{ $post->title }}</h4>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="text-center">
                        <h4> I don't have any post!</h4>
                        <input class="btn btn-success" type="submit" value="Create post" onClick="location.href = '{{ url('new_post') }}'">

                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection