@extends('template.items_template')
@section('header_title', '第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫攝影比賽')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
@endsection
@section('main')

    <body>
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        {{-- <img class="card-img-top"
                                src="https://drive.google.com/uc?export=view&id=1wmuADUn2sqCHBXryWipG1SowByzTQXeh" alt="..."
                                width="268px" height="179px" /> --}}
                        <img class="card-img-top"
                            src="https://drive.google.com/uc?export=view&id={{ $photoInfos[0]->photoPath }}" alt="..." />

                        <!-- <img class="card-img-top mb-5 mb-md-0" src="" alt="..." />  -->
                    </div>
                    <div class="col-md-6">
                        <div class="large mb-1">{{ $photoInfos[0]->groupName }}</div>
                        <h1 class="display-5 fw-bolder">{{ $photoInfos[0]->photoName }}</h1>
                        <p class="fw-bolder large">意境說明</p>
                        <p class="lead">{{ $photoInfos[0]->photoIllustrate }}</p>
                        <div class="fs-5 mt-4 mb-4 align-items-center">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">所屬社區</th>
                                        <th scope="col">拍攝者姓名</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $photoInfos[0]->applicantCommunity }}</td>
                                        <td> {{ $photoInfos[0]->applicantName }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @if (Session::get('permission') == 1)
                            @if (count($chairScore) != 0)
                                <div class="fs-5 mt-4 mb-4 align-items-center">
                                    <table class="table">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">評審</th>
                                                <th scope="col">分數A</th>
                                                <th scope="col">分數B</th>
                                                <th scope="col">分數C</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($chairScore as $item)
                                                <tr>
                                                    <td>{{ $item->userName }}</td>
                                                    <td>{{ $item->scoreA }}</td>
                                                    <td>{{ $item->scoreB }}</td>
                                                    <td>{{ $item->scoreC }}</td>
                                                </tr>
                                                <tr class="table-dark">
                                                    <td colspan="4">評語</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="form-floating">
                                                            <textarea class="form-control"
                                                                placeholder="Leave a comment here" id="comments"
                                                                style="height: 100px"
                                                                disabled>{{ $item->comments }}</textarea>
                                                            <label for="comments">評語</label>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="fs-5 mt-4 mb-4 align-items-center">
                                    <h3 class=" fw-bolder text-danger">尚未評分</h3>
                                </div>
                            @endif
                            <div class="d-flex">
                                <button class="btn btn-outline-dark flex-shrink-0" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    <i class="bi bi-pen me-1"></i>
                                    進行評分
                                </button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <form id="scoreSheet_form">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">評分表</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-danger">*每項評分標準最高100分</p>
                                                <div class="fs-5 mt-4 mb-4 align-items-center">
                                                    <table class="table">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th scope="col">評審</th>
                                                                <th scope="col">構圖技巧</th>
                                                                <th scope="col">攝影技巧</th>
                                                                <th scope="col">主題內容</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @if (count($chairScore) != 0)
                                                                @foreach ($chairScore as $item)
                                                                    <tr>
                                                                        <td>{{ Session::get('name') }}</td>
                                                                        <input type="text" class="form-control"
                                                                            name="photoId" id="photoId"
                                                                            value="{{ $photoID }}" hidden>
                                                                        <td>
                                                                            <input type="text" class="form-control"
                                                                                name="scoreA" id="scoreA"
                                                                                value="{{ $item->scoreA }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control"
                                                                                name="scoreB" id="scoreB"
                                                                                value="{{ $item->scoreB }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control"
                                                                                name="scoreC" id="scoreC"
                                                                                value="{{ $item->scoreC }}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="table-dark">
                                                                        <td colspan="4">評語</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4">
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    placeholder="Leave a comment here"
                                                                                    name="comments" id="comments"
                                                                                    style="height: 100px">{{ $item->comments }}</textarea>
                                                                                <label for="comments">評語</label>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td>{{ Session::get('name') }}</td>
                                                                    <input type="text" class="form-control" name="photoId"
                                                                        id="photoId" value="{{ $photoID }}" hidden>
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                            name="scoreA" id="scoreA" value="">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                            name="scoreB" id="scoreB" value="">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                            name="scoreC" id="scoreC" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="table-dark">
                                                                    <td colspan="4">評語</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <div class="form-floating">
                                                                            <textarea class="form-control"
                                                                                placeholder="Leave a comment here"
                                                                                name="comments" id="comments"
                                                                                style="height: 100px"></textarea>
                                                                            <label for="comments">評語</label>
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                            @endif

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">關閉</button>
                                                <button type="submit" class="btn btn-primary">送出</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                    </div>
                @else
                    <div class="fs-5 mt-4 mb-4 align-items-center">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">評審</th>
                                    <th scope="col">構圖技巧</th>
                                    <th scope="col">攝影技巧</th>
                                    <th scope="col">主題內容</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($photoScoreArray as $item)
                                    <tr>
                                        <td>{{ $item->userName }}</td>
                                        <td>{{ $item->scoreA }}</td>
                                        <td>{{ $item->scoreB }}</td>
                                        <td>{{ $item->scoreC }}</td>
                                    </tr>
                                    <tr class="table-dark">
                                        <td colspan="4">評語</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a comment here"
                                                    id="comments" style="height: 100px"
                                                    value="{{ $item->comments }}"></textarea>
                                                <label for="comments">評語</label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (!empty($totalScore))
                        <div class="fs-5 mt-4 mb-4 align-items-center">
                            <h3 class=" fw-bolder">總分<span class="display-6 fw-bolder text-danger">&nbsp;
                                    {{ $totalScore }}</span></h3>
                            <h3 class=" fw-bolder text-danger"></h3>
                        </div>
                    @else
                        <div class="fs-5 mt-4 mb-4 align-items-center">
                            <h3 class=" fw-bolder text-danger">尚未評分</h3>
                        </div>
                    @endif
                    @endif
                </div>
            </div>
            </div>
        </section>
        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">未評分作品</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach ($getItemOfNexts as $getItemOfNext)
                        <div class="col mb-5">
                            <div class="card h-100">

                                @if ($getItemOfNext->photoStatus == 2)
                                    <div class="badge bg-danger text-white position-absolute"
                                        style="top: 0.5rem; right: 0.5rem">已評分</div>
                                @else
                                    <div class="badge bg-dark text-white position-absolute"
                                        style="top: 0.5rem; right: 0.5rem">未評分</div>
                                @endif
                                <!-- Product image-->
                                {{-- <img class="card-img-top"
                                src="https://drive.google.com/uc?export=view&id=1wmuADUn2sqCHBXryWipG1SowByzTQXeh" alt="..."
                                width="268px" height="179px" />
                            <img class="card-img-top" src="{{ url('images') }}/" alt="..."
                                width="268px" height="179px" /> --}}
                                <img class="card-img-top"
                                    src="https://drive.google.com/uc?export=view&id={{ $getItemOfNext->photoPath }}"
                                    alt="..." width="268px" height="179px" />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">

                                        <h5 class="fw-bolder">{{ $getItemOfNext->photoName }}</h5>

                                        <span>{{ $getItemOfNext->applicantCommunity }}</span>
                                        <span>{{ $getItemOfNext->applicantName }}</span>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><button class="btn btn-outline-dark mt-auto"
                                            onclick="control.watchItems(`{{ $getItemOfNext->photoId }}`)">前往評分</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </section>
    @endsection
    @section('scripts')

        <script>
            var control = {
                watchItems: (id) => {
                    window.location.href = `{{ url('/items/photoItem/${id}') }}`
                }
            }
            var form = document.getElementById("scoreSheet_form");
            form.addEventListener("submit", (e) => {
                e.preventDefault();
                let data = new FormData(e.target);
                let newData = Response.package(data);
                Response.post('items/scoreSheet', newData)
                    .then(
                        (res) => {
                            console.log(res);
                            if (res.status == "API_1") {
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
                            } else if (res.status == "API_0") {
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
