@extends('template.login_template')
@section('header_title', 'USR評審系統')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
@endsection
@section('main')

<body>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">USR評審系統</h1>
                <p class="lead fw-normal text-white-50 mb-0">樹德科技大學</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-6 gx-lg-10 row-cols-12 row-cols-md-12 row-cols-xl-12 justify-content-center">
                <div class="col border bg-light p-4 text-center">
                    <p class="display-5 fw-bolder ">404 ERROR!</p>
                    <h1 class="display-3 fw-bolder mb-5">很抱歉 查無此圖片</h1>
                    <button class="btn btn-outline-success " onclick="reload.pre()">回上頁</button>
                    <button class="btn btn-outline-primary " onclick="reload.index()">回首頁</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->

    @endsection
    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var reload = {
            pre:()=>{
                window.history.back();
            },
            index:()=>{
                window.location.href = "{{url('/')}}";
            }
        }

    </script>
    @endsection