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
                <?php if($stt == 0 &&  !request()->get('page')){ ?>
                <div class="row top_content">
                    <div class="col-sm-8">
                        <h2 class="title"><a href="{{ route('detail', $item->slug) }}">{{ $item->title }}</a></h2>
                        <p class="description">{{ $item->description }}</p>
                        <p class="date">//&nbsp;{{ NiceTime($item->published_at) }}</p>
                        <p class="link_detail"><a href="{{ route('detail', $item->slug) }}">Xem thêm</a></p>
                    </div>
                    <div class="col-sm-4">
                        <a href="{{ route('detail', $item->slug) }}"><img src="{{ $item->thumbnail }}"
                                                                          class="img-responsive" alt="no img"></a>
                    </div>
                </div>
                <?php }else{ ?>
                    <div class="list_content_home">
                        <div class="row level1_content">
                            <div class="col-sm-3">
                                <a href="{{ route('detail', $item->slug) }}"><img src="{{ $item->thumbnail }}"
                                                                                  class="img-responsive"
                                                                                  alt="no img"></a>
                            </div>
                            <div class="col-sm-9">
                                <h3 class="title"><a href="{{ route('detail', $item->slug) }}">{{ $item->title }}</a>
                                </h3>
                                <p class="description">{{ $item->description }}</p>
                                <p class="date">//&nbsp;{{ NiceTime($item->published_at) }}</p>
                                <p class="link_detail"><a href="{{ route('detail', $item->slug) }}">Xem thêm</a></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                @php
                    $stt += 1;
                @endphp
            @endforeach

            <div id="list_content_home_wrap"></div>

            <div id="loading" class="text-center"><img src="{{ asset('images/loading.gif') }}"></div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            var page = 1;
            var win = $(window);
            var isloading = true;
            win.scroll(function () {
                if (($(document).height() - win.height() == win.scrollTop()) && isloading == true) {
                    $('#loading').show();
                    isloading = false
                    page++;
                    var domain = '{{ route('home') }}' + '?page=' + page;

                    $('#list_content_home_wrap').append($('<div>').load(domain + ' .list_content_home', function () {
                        if($(this).html()) {
                            $('#loading').hide();
                            isloading = true;
                        }else{
                            $('#loading').hide();
                        }
                    }));
                }
            });
        });
    </script>
@endsection