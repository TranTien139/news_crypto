@extends('layout.index')

@section('title')
    {{ 'Trang chủ' }}
@endsection

@section('content')
    <section>
        <div class="container" id="main_content">
            @php
            $stt = 0;
            @endphp
            @foreach($article as $item)
                <?php if($stt==0){ ?>
                <div class="row top_content">
                    <div class="col-sm-8">
                        <h2 class="title"><a href="{{ route('detail', $item->slug) }}">{{ $item->title }}</a></h2>
                        <p class="description">{{ $item->description }}</p>
                        <p class="link_detail"><a href="{{ route('detail', $item->slug) }}">Xem thêm</a></p>
                    </div>
                    <div class="col-sm-4">
                        <a href="{{ route('detail', $item->slug) }}"><img src="{{ $item->thumbnail }}" class="img-responsive" alt="no img"></a>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="row level1_content">
                    <div class="col-sm-3">
                        <a href="{{ route('detail', $item->slug) }}"><img src="{{ $item->thumbnail }}" class="img-responsive" alt="no img"></a>
                    </div>
                    <div class="col-sm-9">
                        <h3 class="title"><a href="{{ route('detail', $item->slug) }}">{{ $item->title }}</a></h3>
                        <p class="description">{{ $item->description }}</p>
                        <p class="link_detail"><a href="{{ route('detail', $item->slug) }}">Xem thêm</a></p>
                    </div>
                </div>
                <?php } ?>
                @php
                    $stt += 1;
                @endphp
            @endforeach

        </div>
    </section>
@endsection