<!doctype html>
<html lang="en">

<head>
    <title>Nitiya Shop</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
    /* Custom navbar styles */
    .navbar {
        /* background: linear-gradient(90deg, #6ab04c, #badc58) !important; */
        padding: 15px 0;
        background-color: #e3f2fd;
    }

    /* Search input styling */
    .form-control {
        border-radius: 30px;
        padding: 5px 15px;
        height: 50px;
        width: 100%;
        border: 1px solid #ccc;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #6ab04c;
        box-shadow: 0 0 5px rgba(106, 176, 76, 0.5);
    }

    /* Buttons styling */
    .btn-outline-success {
        border-radius: 30px;
        padding: 5px 20px;
        transition: all 0.3s ease;
    }

    .btn-outline-success:hover {
        background-color: #6ab04c;
        color: white;
    }

    /* Icons size and spacing */
    .fa-cart-shopping {
        font-size: 1.5rem;
    }

    .cart a {
        color: #000;
    }

    .cart a:hover {
        color: #6ab04c;
    }

    /* Auth links styling */
    .auths a {
        margin-left: 10px;
        color: black;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .auths a:hover {
        color: #6ab04c;
    }

    /* Sticky navbar */
    .navbar {
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    /* Container for search form */
    .search-container {
        flex: 1;
        display: flex;
    }

    /* Additional styles */
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }
</style>

<body>
    <nav class="navbar navbar-expand-sm shadow-sm sticky">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Nitiya Shop</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">หน้าหลัก</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ประเภทสินค้า
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">กระเป๋าแฟชั่น</a></li>
                            <li><a class="dropdown-item" href="#">กระเป๋าเดินทาง</a></li>
                            <li><a class="dropdown-item" href="#">กระเป๋าเป้</a></li>
                            <li><a class="dropdown-item" href="#">กระเป๋าสตางค์</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ติดต่อเรา</a>
                    </li>
                </ul>
                <div class="search-container me-4">
                    <form class="d-flex w-100">
                        <input class="form-control me-sm-2" type="text" placeholder="Search" />
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="d-flex align-items-center">
                    <div class="cart me-4">
                        <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                    <div class="auths">
                        <a type="button" class="btn" href="register.php">สมัครใหม่</a> |
                        <a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#loginModel">เข้าสู่ระบบ</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- login modal -->
    <div class="modal fade" id="loginModel" tabindex="-1" aria-labelledby="loginModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="loginModelLabel">เข้าสู่ระบบ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm">
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./apis/login_action.php",
                    data: $(this).serialize(),
                    success: function(response) {
                        const res = JSON.parse(response)
                        console.log("Response:", response); 
                        if (res.status === 'success') {
                            // Ensure you are accessing the correct key
                            if (res.role === 'admin') {
                                window.location.href = "./frontend/admin/admin_dashboard.php";
                            } else if (res.role === 'owner') {
                                window.location.href = "./frontend/owner/owner_dashboard.php";
                            } else if (res.role === 'customer') {
                                window.location.href = "./frontend/customer/customer_dashboard.php";
                            } else {
                                window.location.href = "index.php";
                            }
                        } else {
                            alert(res.message);
                        }
                    },

                    error: function() {
                        alert("An error occurred while processing your request.");
                    }
                });

            })
        });
    </script>