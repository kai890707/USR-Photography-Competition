@extends('template.backend_template')
@section('header_title', '第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫攝影比賽評審系統後台設置')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('main')


    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-5 fw-bolder">第一屆資訊學院城鄉資訊能力深化培育與應用推廣計畫<br>攝影比賽評審系統-後台設置</h1>
                <p class="lead fw-normal text-white-50 mb-0">樹德科技大學</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5 ">
        <div class="container px-4 px-lg-5 mt-5 ">
            <!-- <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"> -->

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active h4" id="nav-group-tab" data-bs-toggle="tab" data-bs-target="#nav-group"
                        type="button" role="tab" aria-controls="nav-group" aria-selected="true">組別設置</button>
                    <button class="nav-link h4" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">資料新增</button>
                    <button class="nav-link h4" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                        type="button" role="tab" aria-controls="nav-contact" aria-selected="false">權限設置</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active row" id="nav-group" role="tabpanel" aria-labelledby="nav-group-tab">
                    <p class="text-danger">**設置完畢後，務必保存設置</p>
                    <form action="" id="group-form">
                    </form>
                    <button type="button" class="btn btn-outline-success mt-5" id="addNewGroup"
                        onclick="Group.addNewInput()">新增組別</button>
                    <button type="button" class="btn btn-outline-primary mt-2" id="saveGroup"
                        onclick="Group.saveGroup()">保存設置</button>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <p class="text-danger mt-4">**以EXCEL檔案上傳</p>
                    <form id="csv-form" method='post' enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4 mb-3 text-center">
                            <label for="file" class="form-label h4 text-center">人員資料上傳</label>
                            <input class="form-control" type="file" id="file" name="file">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class=" btn btn-outline-success " onclick="File.uploadFile()"><span
                                    class="h4">上傳</span></button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills me-3 p-2" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <button class="nav-link active h5" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true">所有帳號</button>
                            <button class="nav-link h5" id="v-pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                                aria-selected="false">新增帳號</button>

                        </div>
                        <div class="tab-content w-100 p-2" id="v-pills-tabContent">
                            <div class="tab-pane fade show active mt-4" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <table id="userDatatable" class="table table-bordered table-striped" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>人員編號</th>
                                            <th>人員名稱</th>
                                            <th>人員帳號</th>
                                            <th>人員權限調整</th>
                                            <th>刪除帳號</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <div class="row">
                                    <form id="insertUser-form">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="account">帳號</span>
                                            <input type="text" class="form-control" placeholder="account"
                                                aria-label="account" name="account" aria-describedby="account">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="password">密碼</span>
                                            <input type="password" class="form-control" placeholder="password"
                                                aria-label="password" name="password" aria-describedby="password">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="name">名稱</span>
                                            <input type="text" class="form-control" placeholder="chair1" aria-label="name"
                                                name="name" aria-describedby="name">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="selected">權限</span>
                                            <select class="form-select" aria-label="Default select example" id="permission"
                                                name="permission">
                                                <option value="1">評審</option>
                                                <option value="2">管理員</option>
                                            </select>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button class="btn btn-outline-success w-100" type="submit"
                                                onclick="Group.appendChair()">新增帳號</button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
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
        var addGroup = document.getElementById('addNewGroup');
        var groupForm = document.getElementById('group-form');
        var fileForm = document.getElementById('csv-form');

        var Group = {
            /**
             * 組別
             */
            addNewInput: () => {
                inputCount = groupForm.getElementsByTagName('input').length;
                let element = `
                <div class="input-group mb-3 mt-3" id="inputSection${inputCount+1}">
                    <span class="input-group-text">Group</span>
                    <input type="text" class="form-control" name="groupInput[]">
                    <button type="button" class="input-group-text btn btn-outline-danger"  onclick="Group.removeInput('inputSection${inputCount+1}')"><i class="bi bi-trash"></i></button>
                </div>
            `;
                groupForm.insertAdjacentHTML('beforeend', element);
            },
            removeInput: (tagId) => {
                let input = document.getElementById(tagId);
                input.remove();
            },
            saveGroup: () => {
                let data = new FormData();
                input = groupForm.getElementsByTagName('input');
                names = [].map.call(input, function(input) {
                    return input.value;
                }).join(',');
                data.append("groupName", names);
                // console.log(names);
                let newData = Response.package(data);
                Response.post('back/setGroup', newData)
                    .then(
                        (res) => {
                            if (res.status == "API_0") {
                                Swal.fire("success", "成功保存設定", "success").then(
                                    (result) => {
                                        if (result) {
                                            window.location.reload();
                                        } else {
                                            window.location.reload();
                                        }
                                    });
                            } else {
                                Swal.fire("info", "設定失敗", "error");
                            }
                        }, (err) => {
                            console.log(err);
                        });
            },
            /**
             * 個人
             */
            updatePermission: (id) => {
                let selectVal = document.getElementById('selected-permission').value;
                let data = {
                    "user_id": id,
                    "permission": selectVal
                }
                Response.post('back/updatePermission', data)
                    .then(
                        (res) => {
                            if (res.status == "API_0") {
                                Swal.fire("success", "成功保存設定", "success").then(
                                    (result) => {
                                        if (result) {
                                            window.location.reload();
                                        } else {
                                            window.location.reload();
                                        }
                                    });
                            } else {
                                Swal.fire("info", "設定失敗", "error");
                            }
                        }, (err) => {
                            console.log(err);
                        });
            },
            appendChair: () => {
                var form = document.getElementById("insertUser-form");
                form.addEventListener("submit", (e) => {
                    e.preventDefault();
                    let data = new FormData(e.target);
                    let newData = Response.package(data);
                    Response.post('back/appendChair', newData)
                        .then(
                            (res) => {
                                console.log(res);
                                if (res.status == "REGISTER_1") {
                                    let returnErr = res.msg;
                                    console.log(returnErr);
                                    errTemplate = '';
                                    for (var prop in returnErr) {
                                        errTemplate += ` <li>${prop}:${returnErr[prop]}</li>`
                                    }
                                    Swal.fire(
                                        "error",
                                        errTemplate,
                                        "error"
                                    );
                                } else if (res.status == "REGISTER_0") {
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
            },
            deleteChair: (id) => {
                let data = {
                    id: id
                };
                Swal.fire({
                    title: '確定要刪除此使用者嗎?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '是',
                    cancelButtonText: '否'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Response.post('back/deleteChair', data)
                            .then(
                                (res) => {
                                    if (res.status == "API_0") {
                                        Swal.fire("success", res.msg, "success").then(
                                            (result) => {
                                                if (result) {
                                                    window.location.reload();
                                                } else {
                                                    window.location.reload();
                                                }
                                            });
                                    } else {
                                        Swal.fire("info", res.msg, "error");
                                    }

                                }, (err) => {
                                    console.log(err);
                                });
                    }
                })

            }
        };
        // fileForm.addEventListener('submit', (e) => {
        //     e.preventDefault();
        //     console.log(e.target.files); // get file object
        // })
        var File = {
            uploadFile: () => {
                let data = new FormData();
                let newfile = document.getElementById('file').files[0];
                data.append('file', newfile);
                Response.file('back/uploadCSV', data)
                    .then(
                        (res) => {
                            if (res.status == "API_0") {
                                Swal.fire("success", res.msg, "success").then(
                                    (result) => {
                                        if (result) {
                                            window.location.reload();
                                        } else {
                                            window.location.reload();
                                        }
                                    });
                            } else {
                                Swal.fire("info", res.msg, "error");
                            }

                        }, (err) => {
                            console.log(err);
                        });
            }
        };;
        (function() {
            Response.post('back/getGroup')
                .then(
                    (res) => {
                        let html = ``;
                        let i = 0;
                        res.forEach((element) => {
                            html += `
                        <div class="input-group mb-3 mt-3" id="inputSection${i}">
                            <span class="input-group-text">Group</span>
                            <input type="text" class="form-control" name="groupInput[]" value="${element.name}">
                            <button type="button" class="input-group-text btn btn-outline-danger"  onclick="Group.removeInput('inputSection${i}')"><i class="bi bi-trash"></i></button>
                        </div>
                        `;
                            i++;
                        })
                        let form = document.getElementById('group-form');
                        form.innerHTML = html;
                    }, (err) => {
                        console.log(err);
                    });
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
                        width: '20%',
                        data: 'id'
                    },
                    {
                        width: '20%',
                        data: 'name'
                    },
                    {
                        width: '20%',
                        data: 'account'
                    },
                    {
                        width: '20%',
                        data: 'action'
                    },
                    {
                        width: '20%',
                        data: 'action2'
                    }
                ],
                "order": [],
                "ajax": {
                    url: "{{ url('back/getAllUser') }}",
                }
            })
        })();
    </script>
@endsection
