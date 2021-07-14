@extends('template.portfolio_template')
@section('header_title', '第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫評審系統')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
@endsection
@section('main')


    <!-- Header-->
    <header class="bg-Custom-blue py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-5 fw-bolder">第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫<br>攝影比賽作品集</h1>
                <p class="lead fw-normal text-white-50 mb-0">樹德科技大學</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5" style="min-height:50vh">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row justify-content-center mb-4">
                <h1 class="text-center">所有作品</h1>
            </div>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($all as $data)
                    <div class="col mb-5">
                        <div class="card h-100">

                            <!-- Product image-->
                            {{-- <img class="card-img-top"
                                src="https://drive.google.com/uc?export=view&id=1wmuADUn2sqCHBXryWipG1SowByzTQXeh" alt="..."
                                width="268px" height="179px" />
                            <img class="card-img-top" src="{{ url('images') }}/" alt="..."
                                width="268px" height="179px" /> --}}
                            <img class="card-img-top"
                                src="https://drive.google.com/uc?export=view&id={{ $data->photoPath }}" alt="..."
                                width="268px" height="179px" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ $data->photoName }}</h5>
                                    <span>{{ $data->applicantCommunity }}</span>
                                    <span>{{ $data->applicantName }}</span>
                                    <div class="d-flex justify-content-center large text-warning mb-2">
                                        @php
                                            $score = $data->total;
                                            $fullStarCount = intval($score / 10) / 2; //整顆星星
                                            $halfStarCount = $score % 10 > 0 ? 1 : 0; //半顆星星
                                        @endphp
                                        @for ($i = 0; $i < $fullStarCount; $i++)
                                            <div class="bi-star-fill"></div>
                                        @endfor
                                        @if ($halfStarCount == 1)
                                            <div class="bi bi-star-half"></div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><button class="btn btn-outline-dark mt-auto"
                                        onclick="control.watchItems(`{{ $data->photoId }}`)">前往評分</button></div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center ">
                    {!! $all->render('vendor.pagination.bootstrap-4') !!}
                </div>

            </div>

        </div>
    </section>
    <!-- Footer-->

@endsection
@section('scripts')

    <script>
        var control = {
            watchItems: (id) => {
                window.location.href = `{{ url('/portfolio/items/${id}') }}`
            }
        }
    </script>
@endsection
