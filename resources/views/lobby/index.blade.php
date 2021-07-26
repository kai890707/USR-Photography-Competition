<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>樹德科技大學-第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫-攝影比賽</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">



    <!-- Bootstrap core CSS -->
    <!-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }


        #img {
            background-image: url('images/stu.jpeg');
            background-size: cover;
            width: 100%;
            height: 100%;
            z-index: -999;
            position: absolute;
            filter: brightness(0.8);
        }

        #img1::before {
            content: '';
            display: block;
            position: absolute;
            background-color: #000;
            opacity: 0.1;
            z-index: -998;
            width: 100%;
            height: 100%;
        }


        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>


    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">
</head>

<body class=" h-100 text-center text-white ">
    <div id="img"></div>
    {{--  --}}
    <div class="d-flex cover-container w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">城鄉資訊能力深化培育與應用推廣計畫</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link active" aria-current="page" href="#">首頁</a>
                    <a class="nav-link" href="https://forms.gle/4kWvgDmtjQjMsAkMA" target="blank">報名參加</a>
                    <a class="nav-link" href="{{ url('login') }}">評審登入</a>
                    <a class="nav-link" href="{{ url('portfolio') }}">作品集</a>
                    <a class="nav-link" href="{{ url('assets/城鄉資訊能力深化培育與應用推廣計畫線上攝影比賽.pdf') }}">比賽辦法</a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <h1>樹德科技大學</h1>
            <h2 class="fw-bolder">第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫-攝影比賽</h2>
            <p class="lead mt-5">
                <a href="https://forms.gle/4kWvgDmtjQjMsAkMA" target="blank"
                    class="btn btn-lg btn-secondary fw-bold border-white bg-white">前往參加</a>
            </p>
        </main>

        <footer class="mt-auto text-white-50">
            {{-- <p class="m-0 text-center text-white">Copyright &copy; SHU-TE University L0726</p>
            <p class="m-0 text-center text-white">系統問題請聯絡<a class="m-0 p-0"
                    href="mailto:s18113223@stu.edu.tw">s18113223@stu.edu.tw</a></p> --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <h3 class="m-0 mb-4 text-start text-white fw-bolder">上級指導單位</h3>
                        <hr class="mt-4 text-white">
                        <div class="row d-flex justify-content-center align-items-center mb-5">
                            {{-- <div class="col-md-6 col-12 mt-4">
                        <img src="{{ url('images/edu.jpg') }}" alt="" class="img-fluid float-start">
                    </div>
                    <div class="col-md-6 col-12 mt-4">
                        <img src="{{ url('images/stu.jpg') }}" alt="" class="img-fluid float-end">
                    </div> --}}
                            <div class="col-md-6 col-12">
                                <h5 class=" m-0 text-center text-white fw-bolder">活動負責人</h5>
                                <p class="m-0 text-center text-white">樹德科技大學資訊工程系蘇怡仁教授</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">

                        <h3 class="m-0 mb-4 text-start text-white fw-bolder">聯絡我們</h3>
                        <hr class="mt-4 text-white">
                        <div class="row d-flex justify-content-center align-items-center mb-5">
                            <div class="col-md-6 col-12">
                                <h5 class=" m-0 text-center text-white fw-bolder">專任助理</h5>
                                <p class="m-0 text-center text-white">林芊綺 07-6158000分機5106</p>
                            </div>
                            <div class="col-md-6 col-12">
                                <p class=" m-0 text-center text-white fw-bolder">系統問題請聯絡</p>
                                <p class="m-0 text-center text-white"><a class="m-0 p-0"
                                        href="mailto:s18113223@stu.edu.tw">
                                        <span class="text-white">
                                            s18113223@stu.edu.tw</span></a></p>
                            </div>
                        </div>

                    </div>
                    {{-- <div class="col-4">

                        <h3 class="m-0 mb-4 text-start text-white fw-bolder">聯絡我們</h3>
                        <hr class="mt-4 text-white">
                        <div class="row d-flex justify-content-center align-items-center mb-5">
                            <div class="col-6">
                                <p class="m-0 text-center text-white">Copyright &copy; SHU-TE University L0726</p>
                                <p class="m-0 text-center text-white">系統問題請聯絡<a class="m-0 p-0"
                                        href="mailto:s18113223@stu.edu.tw">
                                        <span class="text-white">
                                            s18113223@stu.edu.tw</span></a></p>
                            </div>

                        </div>

                    </div> --}}
                    {{-- <div class="row mt-5">
                        <p class="m-0 text-center text-white">Copyright &copy; SHU-TE University L0726</p>
                        <p class="m-0 text-center text-white">系統問題請聯絡<a class="m-0 p-0"
                                href="mailto:s18113223@stu.edu.tw">
                                <span class="text-white">
                                    s18113223@stu.edu.tw</span></a></p>

                    </div> --}}

                </div>
        </footer>
    </div>

</body>

</html>
