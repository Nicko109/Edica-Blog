@extends('layouts.main')
@section('content')

<main class="blog">
    <div class="container card-footer">
        <h1 class="edica-page-title" data-aos="fade-up">Категории</h1>
        <section class="featured-posts-section">
            <ul class="post-list">
                @foreach($categories as $category)
                    <li class="nav-item">
                        <a href="{{ route('category.post.index', $category->id) }}" class="nav-link">
                            <div class="media-body">
                                <h4 class="nav-link text-success" >{{ $category->title }}</h4>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>

        </div>


</main>
@endsection

