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

                    <!-- if you already have posts created you will see a button to add new post  
                        and the average lenght of your posts  -->
                    @if (count($my_blog_posts) > 0)
                    <div class="text-center mt-3">
                        <a href="{{ url('new-post') }}" class="btn btn-success"> Add new </a>
                    </div>
                    <h4 class="text-center mt-4 text-info font-weight-bold">Average lenght of the blog posts: {{ $average_posts }}</h4>

                    <ul class="list-group">
                        @foreach ($my_blog_posts as $post)
                        <li class="list-group-item">
                            <!-- show post's title and content -->
                            <h4> {{ $loop->iteration }}. {{ $post->title }}</h4>
                            <p class="font-italic"> {{ $post->content }} </p>
                            <!-- to show the date that the post was created  -->
                            <p class="font-weight-bold float-right"> Created at {{ date('d-M-y H:i', strtotime($post->created_at)) }} </p>
                            <!-- each post has option to be deleted -->
                            <a href="{{ url('delete-post/' . $post->post_id ) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger mt-3" role="button" title="Delete this post"> Delete </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <!-- If you dont have any post created you'll have a button to create a post -->
                    <div class="text-center">
                        <h4> You don't have any posts!</h4>
                        <a href="{{ url('new-post') }}" class="btn btn-success"> Create post </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection