@extends('template.backend_template')
@section('header_title', '第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫-攝影比賽評審系統')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('main')


    <!-- Header-->
    <header class="bg-Custom-blue py-5">
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
            <h5 class=" fw-bolder text-dark-50 mr-5">組別</h5>
            <div class="mb-4">

                @foreach ($group as $group)
                    @if ($group->id % 2 == 0)
                        <button type="button" class="btn btn-outline-primary"
                            onclick="getTable({{ $group->id }})">{{ $group->name }}</button>
                    @else
                        <button type="button" class="btn btn-outline-success"
                            onclick="getTable({{ $group->id }})">{{ $group->name }}</button>
                    @endif
                @endforeach
            </div>
            <hr>
            {{-- <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"> --}}
            <table id="userDatatable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>組別名稱</th>
                        <th>評分表編號</th>
                        <th>圖片編號</th>
                        <th>投稿人姓名</th>
                        {{-- <th>評審</th> --}}
                        <th>構圖技巧平均分數</th>
                        <th>攝影技巧平均分數</th>
                        <th>主題內容平均分數</th>
                        <th>總分</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>
            {{-- </div> --}}
        </div>
    </section>
    <!-- Footer-->

@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        function getTable(groupID = 1) {
            $('#userDatatable').DataTable({
                "language": {
                    "lengthMenu": "顯示 _MENU_ 筆消息",
                    "emptyTable": "沒有資料",
                    "info": "目前顯示 _START_ 至 _END_ 筆的資料，共 _TOTAL_ 筆資料",
                    "infoFiltered": "，從 _MAX_ 筆資料中過濾",
                    "infoEmpty": "沒有資料能夠顯示",
                    "zeroRecords": "沒有資料，可以鍵入其他內容進行搜索",
                    "search": "搜尋資料：",
                    "paginate": {
                        "next": "下一頁",
                        "previous": "上一頁"
                    },
                },
                destroy: true,
                autoWidth: true,
                searching: true,
                autoWidth: false,

                columns: [{
                        width: '10%',
                        data: 'groupName'
                    },
                    {
                        width: '10%',
                        data: 'scoreId'
                    },
                    {
                        width: '10%',
                        data: 'photoId'
                    },
                    {
                        width: '10%',
                        data: 'applicantName'
                    },
                    // {
                    //     width: '10%',
                    //     data: 'userName'
                    // },
                    {
                        width: '10%',
                        data: 'scoreA'
                    },
                    {
                        width: '10%',
                        data: 'scoreB'
                    },
                    {
                        width: '10%',
                        data: 'scoreC'
                    },
                    {
                        width: '10%',
                        data: 'total'
                    },
                ],
                "order": [],
                "ajax": {
                    url: `{{ url('items/getAllItemsRankDataTable/ ${groupID} ') }}`,
                }
            })
        }
        getTable();
    </script>
@endsection
