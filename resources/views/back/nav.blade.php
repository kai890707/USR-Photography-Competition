<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ url('/') }}">USR評審系統</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">作品評分狀況</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('back/') }}">所有作品</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="{{ url('back/chairScore') }}">各評審評分</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('back/statistics') }}">分數統計</a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ url('back/setting') }}">設置</a></li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="button" id="logout">
                        <i class="bi bi-box-arrow-in-right  "></i>
                        登出
                    </button>
                </form>
            </div>
        </div>
    </nav>
