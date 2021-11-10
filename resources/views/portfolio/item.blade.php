@extends('template.portfolio_template')
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
                        <p class="lead" style="word-wrap:break-word; ">{{ $photoInfos[0]->photoIllustrate }}</p>
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

                                    <tr>
                                        <td colspan="2">
                                            <div class="fs-5 mt-4 mb-4 row">
                                                <div class="col-4">
                                                    <h3 class=" fw-bolder m-0  d-flex align-items-center">綜合評價<span
                                                            class="display-6 fw-bolder text-danger">&nbsp;
                                                        </span>
                                                    </h3>
                                                </div>
                                                <div class="col-8 d-flex align-items-center">
                                                    <div class="d-flex justify-content-center   large text-warning">
                                                        @php
                                                            $score = $photoInfos[0]->total;
                                                            if ($score >= 90) {
                                                                $fullStarCount = 5;
                                                                $halfStarCount = 0;
                                                            } else {
                                                                $fullStarCount = intval(intval($score / 9) / 2); //整顆星星
                                                                $halfStarCount = $score % 10 > 0 ? 1 : 0; //半顆星星
                                                            }
                                                            
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
                                            <div class="row" id="template_checkbox1">

                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            id="flexCheck1" disabled>
                                                        <label class="form-check-label lable1" for="flexCheck1">
                                                            構圖技巧佳
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="2"
                                                            id="flexCheck2" disabled>
                                                        <label class="form-check-label lable2" for="flexCheck2">
                                                            拍攝技巧佳
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="3"
                                                            id="flexCheck3" disabled>
                                                        <label class="form-check-label lable3" for="flexCheck3">
                                                            主題敘述佳
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="4"
                                                            id="flexCheck4" disabled>
                                                        <label class="form-check-label lable4" for="flexCheck4">
                                                            光影效果佳
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="5"
                                                            id="flexCheck5" disabled>
                                                        <label class="form-check-label lable5" for="flexCheck5">
                                                            圖片清晰度佳
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="6"
                                                            id="flexCheck6" disabled>
                                                        <label class="form-check-label lable6" for="flexCheck6">
                                                            圖片色彩飽和度佳
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion mt-4" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                            評審 {{ $chair[0]->name }} 評語
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="form-floating">
                                                                <textarea class="form-control"
                                                                    placeholder="Leave a comment here" id="comments"
                                                                    style="height: 100px"
                                                                    disabled>
                                                                     {{ isset($comments[0]) ? $comments[0] : '' }}
                                                                    </textarea>
                                                                <label for="comments">評語</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                            評審 {{ $chair[1]->name }} 評語
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="form-floating">
                                                                <textarea class="form-control"
                                                                    placeholder="Leave a comment here" id="comments"
                                                                    style="height: 100px" disabled>
                                                                            {{ isset($comments[1]) ? $comments[1] : '' }}
                                                                                           </textarea>
                                                                <label for="comments">評語</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingThree">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                            aria-expanded="false" aria-controls="collapseThree">
                                                            評審 {{ $chair[2]->name }} 評語
                                                        </button>
                                                    </h2>
                                                    <div id="collapseThree" class="accordion-collapse collapse"
                                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="form-floating">
                                                                <textarea class="form-control"
                                                                    placeholder="Leave a comment here" id="comments"
                                                                    style="height: 100px" disabled>
                                                                         {{ isset($comments[2]) ? $comments[2] : '' }}
                                                                        </textarea>
                                                                <label for="comments">評語</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
        </section>
        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">其他作品</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach ($getItemOfNext as $getItemOfNext)
                        <div class="col mb-5">
                            <div class="card h-100">
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
                                        <div class="d-flex justify-content-center large text-warning mb-2">
                                            @php
                                                $score = $getItemOfNext->total;
                                                if ($score >= 90) {
                                                    $fullStarCount = 5;
                                                    $halfStarCount = 0;
                                                } else {
                                                    $fullStarCount = intval(intval($score / 9) / 2); //整顆星星
                                                    $halfStarCount = $score % 10 > 0 ? 1 : 0; //半顆星星
                                                }
                                                
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
                                            onclick="control.watchItems(`{{ $getItemOfNext->photoId }}`)">前往觀賞</button>
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
                    window.location.href = `{{ url('/portfolio/items/${id}') }}`;
                }
            }
            var checked = @json($realCheck);
            let template_checkbox1 = document.querySelectorAll(`#template_checkbox1 input[type='checkbox']`);
            let template_checkbox1_label = document.querySelectorAll(`#template_checkbox1 label`);
            if (checked != null) {
                for (let i = 0; i < template_checkbox1.length; i++) {
                    for (let j = 0; j < checked.length; j++) {
                        if (checked[j] == template_checkbox1[i].value) {
                            template_checkbox1[i].checked = true;
                            template_checkbox1[i].style.opacity = 1;
                            template_checkbox1_label[i].style.opacity = 1;
                        }
                    }
                }
            }
        </script>
    @endsection
