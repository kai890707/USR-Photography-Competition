<!-- <script src="{{ asset('assets/js/bootstrap.min.js') }}" crossorigin="anonymous"></script> -->
<script src="{{ asset('assets/js/sweetalert2.js') }}" crossorigin="anonymous"></script>
<script>
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    Response = {
        package: (formData) => {
            let plainFormData = Object.fromEntries(formData.entries());
            return plainFormData;
        },
        post: (requireURL, data = null) => {
            return new Promise((reslove, reject) => {
                fetch(`{{url('${requireURL}')}}`, {
                        headers: {
                            'Content-Type': 'application/json',
                            "X-CSRF-Token": csrfToken
                        },
                        method: 'post',
                        body: JSON.stringify(data)
                    }).then((res) => reslove(res.json()))
                    .catch((err) => reslove(err))
            });
        },
        get: (requireURL) => {
            return new Promise((reslove, reject) => {
                fetch(`{{url('${requireURL}')}}`, {
                        headers: {
                            'Content-Type': 'application/json',
                            "X-CSRF-Token": csrfToken
                        },
                        method: 'get',
                    }).then((res) => reslove(res.json()))
                    .catch((err) => reslove(err))
            });
        },
        file: (requireURL,file) => {
            return new Promise((reslove, reject) => {
                fetch(`{{url('${requireURL}')}}`, {
                        headers: {
                            "X-CSRF-Token": csrfToken
                        },
                        method: 'post',
                        body: file
                    }).then((res) => reslove(res.json()))
                    .catch((err) => reslove(err))
            });
        }

    }
    var logout = document.getElementById("logout");
    logout.addEventListener('click', () => {
        Swal.fire({
            title: "登出確認?",
            text: "您想登出嗎?",
            showCancelButton: true
        }).then(function(result) {
            if (result.value) {
                Response.post('login/logout')
                    .then((res) => {
                        if (res.status == "success") {
                            Swal.fire("success", res.msg, "success").then(
                                (result) => {
                                    if (result) {
                                        window.location.reload();
                                    } else {
                                        window.location.reload();
                                    }
                                }
                            );
                        }
                    })
            } else {
                Swal.fire("取消操作");
            }
        });



    })
</script>