@foreach ($blogs as $blog)
    <div id="cardBlog" class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img id="blogImage" src="{{ asset('admins/images/' . $blog->blogImage->name) }}" class="rounded-start"
                    alt="not found">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <a href="{{ route('user.show', encrypt($blog->id)) }}" class="card-title">
                        <h3>{{ $blog->title }}</h3>
                    </a>
                    <p class="card-text">{{ str_limit(strip_tags($blog->description), 90) }}
                        @if (strlen(strip_tags($blog->description)) > 90)
                            <a href="{{ route('user.show', encrypt($blog->id)) }}" class="btn-sm">Read More</a>
                        @endif
                    </p>
                    <p class="card-text"><small class="text-muted">Created at
                            {{ $blog->created_at->toDateString() }}</small></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Divider-->
    {{-- <hr class="my-4"> --}}
@endforeach
