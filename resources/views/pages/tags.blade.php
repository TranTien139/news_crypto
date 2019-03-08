@extends('layout.index')

@section('title')
    <?php if($type == 'tag'){ ?>
     {{ request()->segment(2) }}
    <?php }else{ ?>
     {{ 'Kết quả tìm kiếm : ' . request()->get('keyword') }}
    <?php } ?>
@endsection

@section('content')
    <section>
        <div class="container" id="main_content">
            <?php if($type == 'tag'){ ?>
            <h3>Chuyện mục: <?php echo request()->segment(2);?> //</h3>
            <?php }else{ ?>
            <h3>Kết quả tìm kiếm từ khóa: {{ request()->get('keyword') }} //</h3>
            <?php } ?>
            @foreach($result as $item)
                <div class="row level1_content">
                    <div class="col-sm-3">
                        <a href="{{ route('detail', $item->slug) }}"><img src="{{ $item->thumbnail }}"
                                                                          class="img-responsive" alt="no img"></a>
                    </div>
                    <div class="col-sm-9">
                        <h3 class="title"><a href="{{ route('detail', $item->slug) }}">{{ $item->title }}</a></h3>
                        <p class="description">{{ $item->description }}</p>
                        <p class="date">{{ NiceTime($item->published_at) }}</p>
                        <p class="link_detail"><a href="{{ route('detail', $item->slug) }}">Xem thêm</a></p>
                    </div>
                </div>
            @endforeach

            <div class="row" style="background: #fff;">
                <?php
                $start = 1;
                $end = 1;
                if (ceil($total / 20) <= 5) {
                    $start = 1;
                    $end = ceil($total / 20);
                } else {
                    if ($page - 3 <= 0) {
                        $start = 1;
                        $end = 5;
                    } else if ($page + 2 >= ceil($total / 20)) {
                        $start = ceil($total / 20) - 4;
                        $end = ceil($total / 20);
                    } else {
                        $start = $page - 2;
                        $end = $page + 2;
                    }
                }
                $currentQueries = request()->query();
                $newQuerieStart = ['page' => 1];
                $newQuerieStart = array_merge($currentQueries, $newQuerieStart);
                $newQuerieStart = request()->fullUrlWithQuery($newQuerieStart);

                $newQuerieEnd = ['page' => ceil($total / 20)];
                $newQuerieEnd = array_merge($currentQueries, $newQuerieEnd);
                $newQuerieEnd = request()->fullUrlWithQuery($newQuerieEnd);
                ?>
                @if($total>0)
                    <div class="pagination">
                        <a href="{{ $newQuerieStart }}">&laquo;</a>
                        <?php for($stt = $start; $stt <= $end; $stt++){
                        $newQueries = ['page' => $stt];
                        $newQueries = array_merge($currentQueries, $newQueries);
                        $newQueries = request()->fullUrlWithQuery($newQueries);
                        ?>
                        <a href="{{ $newQueries }}" class="<?php if ($page == $stt) {
                            echo "active";
                        }?>">{{ $stt }}</a>
                        <?php } ?>
                        <a href="{{ $newQuerieEnd }}">&raquo;</a>
                    </div>
                @endif
            </div>

        </div>
    </section>
@endsection