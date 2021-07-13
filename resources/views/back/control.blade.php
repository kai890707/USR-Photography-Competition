@extends('template.backend_template')
@section('header_title', '第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫-攝影比賽評審系統')

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
        <div class="container px-4 px-lg-5 mt-5 h-100">
            <div class="row">
                <h2 class="text-center mb-4">組別作品一覽</h2>
                <hr>
            </div>
            <div class="row mt-4" id="group-action">

            </div>

        </div>
    </section>
    <!-- Footer-->

@endsection
@section('scripts')
    <script>
        (function() {
            Response.post('back/getGroup')
                .then(
                    (res) => {
                        console.log(res);
                        let html = ``;
                        let i = 0;
                        let color;
                        res.forEach((element) => {
                            if (i % 2 == 0) {
                                color = "success";
                            } else {
                                color = "primary";
                            }
                            html += `
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-${color} p-5" onclick="control.watchItems(${element.id})"> <span class="h5">${element.name}</span></button>
                        </div>
                        `;
                            i++;
                        })
                        let choose = document.getElementById('group-action');
                        choose.innerHTML = html;
                    }, (err) => {
                        console.log(err);
                    });
        })();
        var control = {
            watchItems: (id) => {
                window.location.href = `{{ url('/items/groupItem/${id}') }}`
            }
        }
    </script>
@endsection
