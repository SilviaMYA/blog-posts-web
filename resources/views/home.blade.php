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
                    <ul class="list-group">
                        @foreach ($my_blog_posts as $post)

                        <li class="list-group-item">
                            <h4> {{ $loop->iteration }}.  {{ $post->title }}</h4>
                            <p class="font-italic"> {{ $post->content }} </p>

                            <a href="{{ url('delete-post/' . $post->post_id ) }}" onclick="return confirm('Are you sure?')"  class="btn btn-danger" role="button" title="Delete this post"> Delete </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="text-center">
                        <h4> I don't have any post!</h4>
                        <a href="{{ url('new-post') }}" class="btn btn-success" > Create post </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection