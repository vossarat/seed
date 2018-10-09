@extends('layouts.template-100')

@section('content')



<section class="section bg-white text-center" style="padding:15px;">

    <div class="shell">
        <div class="range range-xs-center range-60 range-lg-200">
            <div class="cell-xs-12 cell-sm-6 cell-sm-offset-6">
                <h2>
                    Новости
                </h2>

                @foreach($viewdata as $post)
                <div class="row text-left news-list">
                    <div class="row news-list-date">
                        <span style="background-color: #f8a63d;color:#000;">
                            {{ $post->changed_at }}
                        </span>
                    </div>

                    <div class="row">
                        {{ $post->title }}
                    </div>
                    <div class="row">
                        <a href="{{ route('onepost', $post->id) }}">
                            Подробнее
                        </a>
                    </div>
                    <div class="divider-default">
                    </div>
                </div>

                @endforeach



            </div>
        </div>
    </div>
</section>

<section class="section bg-white text-center">

</section>

@endsection