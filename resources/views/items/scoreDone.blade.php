@extends('template.items_template')
@section('header_title', '第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫攝影比賽')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
@endsection
@section('main')


<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
        <h1 class="display-5 fw-bolder">第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫<br>攝影比賽評審系統-後台</h1>
            <p class="lead fw-normal text-white-50 mb-0">樹德科技大學</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">



        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        

        </div>
       

    </div>
</section>
<!-- Footer-->

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var control = {
        watchItems: (id) => {
            window.location.href = `{{url('/items/photoItem/${id}')}}`
        }
    }
</script>
@endsection