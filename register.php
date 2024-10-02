<?php
require_once('./backend/cities.php');

$city = new Cities();
$cities = $city->getCities();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">สมัครเข้าใช้งาน</p>
                                    <form class="mx-1 mx-md-4" id="registerForm" method="POST">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label" for="username">username</label>
                                                <input type="text" id="username" class="form-control" name="username" placeholder="ชื่อผู้ใช้งาน" required />
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="phone">phone</label>
                                                <input type="text" id="phone" class="form-control" name="phone" placeholder="เบอร์โทรศัพท์" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label" for="address">address</label>
                                                <input type="text" id="address" class="form-control" name="address" placeholder="ที่อยู่" required />
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="city">city</label>
                                                <select id="city" class="form-control" name="cityId" required>
                                                    <option value="">เลือกจังหวัด</option>
                                                    <?php if (is_array($cities) && count($cities) > 0): ?>
                                                        <?php foreach ($cities as $city): ?>
                                                            <option value="<?= $city['id'] ?>" data-zipcode="<?= $city['zip_code'] ?>">
                                                                <?= $city['c_name'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label" for="zip_code">zip code</label>
                                                <input type="text" id="zip_code" class="form-control" name="zip_code" placeholder="รหัสไปรษณีย์" readonly />
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="role">role</label>
                                                <select id="role" class="form-control" name="role" required>
                                                    <option value="">เลือกสถานะผู้ใช้งาน</option>
                                                    <option value="user">User</option>
                                                    <option value="owner">Owner</option>
                                                    <option value="admin">Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label" for="email">email</label>
                                                <input type="email" id="email" class="form-control" name="email" placeholder="อีเมลล์" required />
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="password">Password</label>
                                                <input type="password" id="password" class="form-control" name="password" placeholder="รหัสผ่าน" required />
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mx-4 mb-3 mb-lg-4 mt-4">
                                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Register</button>
                                        </div>
                                    </form>


                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $("#city").change(function() {
                var zipCode = $("#city option:selected").data("zipcode");
                $("#zip_code").val(zipCode);
            });

            $("#registerForm").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: './apis/register_action.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: response
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: xhr.responseText
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>