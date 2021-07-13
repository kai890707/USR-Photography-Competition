@extends('template.login_template')
@section('header_title', '第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫-攝影比賽評審系統')

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
                    <h1 class="display-5 fw-bolder">第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫<br>攝影比賽評審系統</h1>
                    <p class="lead fw-normal text-white-50 mb-0">樹德科技大學</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-6 gx-lg-10 row-cols-12 row-cols-md-12 row-cols-xl-12 justify-content-center">
                    <div class="col border bg-light p-4">
                        <form class="row g-3 needs-validation" id="login-form" method="post">
                            @csrf
                            <h2 class="mt-5 mb-4 text-center">系統登入</h2>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control " id="account" name="account"
                                    placeholder="name@example.com">
                                <label for="floatingInput" class="">Account</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control " id="password" name="password"
                                    placeholder="Password">
                                <label for="floatingPassword" class="">Password</label>
                            </div>

                            <button type="submit" class="btn btn-dark mb-5">登入</button>
                            <form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->

    @endsection
    @section('scripts')
        <script>
            var form = document.getElementById("login-form");
            form.addEventListener("submit", (e) => {
                e.preventDefault();
                let data = new FormData(e.target);
                let newData = Response.package(data);
                Response.post('login/login', newData)
                    .then(
                        (res) => {
                            console.log(res);
                            if (res.status == "LOGIN_1") {
                                let returnErr = res.msg;
                                errTemplate = '';
                                for (var prop in returnErr) {
                                    errTemplate += ` <li>${returnErr[prop]}</li>`
                                }
                                Swal.fire(
                                    "error",
                                    errTemplate,
                                    "error"
                                );
                            } else if (res.status == "LOGIN_0") {
                                Swal.fire("success", res.msg, "success").then(
                                    (result) => {
                                        if (result) {
                                            window.location.reload();
                                        } else {
                                            window.location.reload();
                                        }
                                    }
                                );
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                Swal.fire(
                                    "error",
                                    res.msg,
                                    "error"
                                );
                                return true;
                            }

                        }, (err) => {
                            console.log(err);
                        });
            });
        </script>
    @endsection
