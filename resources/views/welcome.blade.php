@extends('layouts.blog')

@section('title')
  Oriol's Blog
@endsection

@section('header')
  <header class="header text-center text-white" style="background-image: linear-gradient(-225deg, #607ADB 0%, #8466DB 48%, #607ADB 100%);">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto">
            <h1>Welcome to Oriol's Blog</h1>
            <p class="lead-2 opacity-90 mt-6">Read and get updated on how we progress here...</p>
        </div>
      </div>
    </div>
  </header>
@endsection


@section('content')
<main class="main-content">
      <div class="section bg-gray">
        <div class="container">
          <div class="row">


            <div class="col-md-8 col-xl-9">
              <div class="row gap-y">
              <!-- POST SECTION -->
              @forelse ($posts as $post)
               <div class="col-md-6">
                  <div class="card border hover-shadow-6 mb-6 d-block">
                    <a href="{{ route('blog.show', $post->id) }}"><img class="card-img-top" src="http://localhost/blog-system/public/storage/{{$post->image}}" alt="image"></a>
                    <div class="p-6 text-center">
                      <p><a class="small-5 text-lighter text-uppercase ls-2 fw-400" href="#">{{$post->category->name}}</a></p>
                      <h5 class="mb-0"><a class="text-dark" href="{{ route('blog.show', $post->id) }}">{{$post->title}}</a></h5>
                    </div>
                  </div>
                </div>
              @empty
                <div class="alert alert-danger col-12" role="alert">
                  <p>No results found for <strong>{{ request()->query('search') }}</strong> 😔😓</p>
                </div>  
              @endforelse
                
              <!-- END POST SECTION -->
            </div>

            <!-- DEFAULT LARAVEL PAGINATION -->
              {{ $posts->appends(['search' => request()->query('search') ])->links() }}
            <!--
              <nav class="flexbox mt-30">
                <a class="btn btn-white disabled"><i class="ti-arrow-left fs-9 mr-4"></i> Newer</a>
                <a class="btn btn-white" href="#">Older <i class="ti-arrow-right fs-9 ml-4"></i></a>
              </nav>
            -->
            </div>



            <div class="col-md-4 col-xl-3">
              <div class="sidebar px-4 py-md-0">
                <!-- SEARCH SECTION -->
                <h6 class="sidebar-title">Search</h6>
                <form class="input-group" action="{{ route('welcome') }}" method="GET">
                
                  <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request()->query('search') }}">
                  <div class="input-group-addon">
                    <span class="input-group-text"><i class="ti-search"></i></span>
                  </div>
                </form>

                <hr>
                <!-- CATEGORY SECTION -->
                <h6 class="sidebar-title">Categories</h6>
                <div class="row link-color-default fs-14 lh-24">
                @foreach ($categories as $category)
                  <div class="col-6"><a href="#">{{$category->name}}</a></div>
                @endforeach
                </div>
                
                <hr>
                <!-- TAG SECTION -->
                <h6 class="sidebar-title">Tags</h6>
                <div class="gap-multiline-items-1">
                @foreach ($tags as $tag)
                  <a class="badge badge-secondary" href="#">{{ $tag->name }}</a>
                @endforeach
                </div>
                <hr>
                <!-- ABOUT SECTION -->
                <h6 class="sidebar-title">About</h6>
                <p class="small-3">This is a my personal Blog.</p>


              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
@endsection
