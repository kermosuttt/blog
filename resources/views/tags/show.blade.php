@extends('partials.layout')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Posts tagged with "{{ $tag->name }}"</h1>
        
        @if($posts->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title">
                                <a href="{{ route('post', $post->slug) }}" class="text-primary">{{ $post->title }}</a>
                            </h2>
                            <p>{{ Str::limit($post->body, 100) }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                <p class="text-sm text-gray-500">{{ $post->comments_count }} comments</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @else
            <p>No posts found for this tag.</p>
        @endif
    </div>
@endsection
