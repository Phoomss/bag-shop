<?php
include("./navbar.php");
?>

<!-- Branded Carousel -->
<div class="branded-carousel">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="กระเป๋าทอชิค">
                <div class="carousel-caption d-none d-md-block">
                    <h5>กระเป๋าทอชิค</h5>
                    <p>ค้นพบความสวยงามและฟังก์ชันการใช้งานของกระเป๋าทอ.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="กระเป๋าผ้าอย่างดี">
                <div class="carousel-caption d-none d-md-block">
                    <h5>กระเป๋าผ้าอย่างดี</h5>
                    <p>การออกแบบที่ลงตัวระหว่างสไตล์และความทนทาน.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="กระเป๋าเป้สำหรับการผจญภัย">
                <div class="carousel-caption d-none d-md-block">
                    <h5>กระเป๋าเป้สำหรับการผจญภัย</h5>
                    <p>เตรียมพร้อมสำหรับการผจญภัยกลางแจ้งของคุณ.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">ก่อนหน้า</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">ถัดไป</span>
        </button>
    </div>
</div>

<!-- product recommand -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <img src="https://via.placeholder.com/600x425" class="img-fluid rounded shadow" alt="กระเป๋าทอชิค">
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-6 mb-4">
                    <img src="https://via.placeholder.com/300x200" class="img-fluid rounded shadow" alt="กระเป๋าผ้าอย่างดี">
                </div>
                <div class="col-6 mb-4">
                    <img src="https://via.placeholder.com/300x200" class="img-fluid rounded shadow" alt="กระเป๋าหนังแบบครอสบอดี้">
                </div>
                <div class="col-6 mb-4">
                    <img src="https://via.placeholder.com/300x200" class="img-fluid rounded shadow" alt="กระเป๋าเป้สำหรับการผจญภัย">
                </div>
                <div class="col-6 mb-4">
                    <img src="https://via.placeholder.com/300x200" class="img-fluid rounded shadow" alt="กระเป๋าใหม่">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Bags Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">กระเป๋าที่แนะนำ</h2>
    <div class="row">
        <!-- Loop through products dynamically -->
        <?php
        // Example data for product cards, ideally fetched from a database
        $products = [
            [
                "title" => "กระเป๋าทอชิค",
                "description" => "สวยงามและกว้างขวาง เหมาะสำหรับทุกโอกาส.",
                "price" => "฿1,499",
                "image" => "https://via.placeholder.com/300x200"
            ],
            [
                "title" => "กระเป๋าหนังแบบครอสบอดี้",
                "description" => "หนังทนทานที่มีดีไซน์ชิค.",
                "price" => "฿2,499",
                "image" => "https://via.placeholder.com/300x200"
            ],
            [
                "title" => "กระเป๋าเป้สำหรับการผจญภัย",
                "description" => "เหมาะสำหรับการผจญภัยกลางแจ้งและการใช้งานประจำวัน.",
                "price" => "฿999",
                "image" => "https://via.placeholder.com/300x200"
            ],
            // Repeat or add more products as necessary
        ];

        foreach ($products as $product): ?>
            <article class="col-md-4 mb-4">
                <div class="card shadow-sm border-light">
                    <img src="<?= $product['image'] ?>" class="card-img-top" alt="<?= $product['title'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['title'] ?></h5>
                        <p class="card-text"><?= $product['description'] ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-success fw-bold"><?= $product['price'] ?></span>
                            <a href="#" class="btn btn-primary">เพิ่มลงตะกร้า</a>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <h2 class="text-center mb-4">กระเป๋าเข้าใหม่</h2>
    <div class="row">
        <!-- Similar product cards for new arrivals -->
        <?php foreach ($products as $product): ?>
            <article class="col-md-4 mb-4">
                <div class="card shadow-sm border-light">
                    <img src="<?= $product['image'] ?>" class="card-img-top" alt="<?= $product['title'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['title'] ?></h5>
                        <p class="card-text"><?= $product['description'] ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-success fw-bold"><?= $product['price'] ?></span>
                            <a href="#" class="btn btn-primary">เพิ่มลงตะกร้า</a>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <h2 class="text-center mb-4">รายการสินค้า</h2>
    <div class="row">
        <!-- Similar product cards for all items -->
        <?php foreach ($products as $product): ?>
            <article class="col-md-4 mb-4">
                <div class="card shadow-sm border-light">
                    <img src="<?= $product['image'] ?>" class="card-img-top" alt="<?= $product['title'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['title'] ?></h5>
                        <p class="card-text"><?= $product['description'] ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-success fw-bold"><?= $product['price'] ?></span>
                            <a href="#" class="btn btn-primary">เพิ่มลงตะกร้า</a>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</div>

<?php
include("./footer.php");
?>