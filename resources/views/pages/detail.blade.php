@extends('layout.index')

@section('title')
{{ $detail->title }}
@endsection

@section('content')
    <section>
        <div class="container" id="main_content">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <!--<div class="img_detail">-->
                    <!--<img src="images/network_0.png" class="img-responsive" alt="no img">-->
                    <!--</div>-->
                    <div class="info_detail">
                        <h1 class="title">{{ $detail->title }}</h1>
                        <p class="date_published">//&nbsp;{{ NiceTime($detail->published_at) }}</p>
                        <p class="description">{{ $detail->description }}</p>
                    </div>
                    <div class="content_detail">
                        {!! $detail->content !!}
                    </div>

                    <div class="tag_detail">
                        <ul class="list-inline">
                            <li>Tags:</li>
                            @if($detail->source != null)
                            <li><a href="{{ route('tags', $detail->source) }}">#{{ $detail->source }}</a></li>
                            @endif
                            @foreach($tags as $item)
                            <li><a href="{{ route('tags', str_slug($item)) }}">#{{ $item }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="related_detail">
                        <h4>Tin liên quan //</h4>
                        <div class="row">
                            @foreach($related as $relate)
                                <div class="col-sm-6">
                                    <a href="{{ route('detail', $relate->slug) }}"><img src="{{ $relate->thumbnail }}" class="img-responsive"></a>
                                    <p><a href="{{ route('detail', $relate->slug) }}">{{ $relate->title }}</a></p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-1"></div>
        </div>
    </section>
@endsection