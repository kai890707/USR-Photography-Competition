@extends('template.frontend_template')
@section('header_title', '第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫評審系統')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
@endsection
@section('main')


    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-5 fw-bolder">第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫<br>攝影比賽評審系統</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>
    <!-- Section-->


    <section class="py-5" style="min-height:50vh">

        <div class="container px-4 px-lg-5 mt-5 ">
            <div class="row justify-content-center mb-4">
                <h1 class="text-center">{{ $groupName->groupName }}</h1>
            </div>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @if (sizeof($groupItems) == 0)
                    <h2 class="text-center fw-bolder">尚無作品</h2>
                @else
                    @foreach ($groupItems as $data)
                        <div class="col mb-5">
                            <div class="card h-100">
                                @if ($data->photoStatus == 2)
                                    <div class="badge bg-danger text-white position-absolute"
                                        style="top: 0.5rem; right: 0.5rem">
                                        已評分</div>
                                @else
                                    <div class="badge bg-dark text-white position-absolute"
                                        style="top: 0.5rem; right: 0.5rem">
                                        未評分</div>
                                @endif
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

                @endif


            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center ">
                    {!! $groupItems->render('vendor.pagination.bootstrap-4') !!}
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
                window.location.href = `{{ url('/items/photoItem/${id}') }}`
            }
        }
    </script>
@endsection
