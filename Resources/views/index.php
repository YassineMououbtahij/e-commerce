<div id="carouselExample" class="carousel slide my-4" style="height: 600px;">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./assets/home_hero.png" style="height: 600px;" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="./assets/home_hero2.png" style="height: 600px;" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="./assets/home_hero3.png" style="height: 600px;" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="row py-4">
    <?php foreach ($products as $product) : ?>
        <div class="col-sm-12 col-lg-4">
            <div class="card w-100" style="width: 18rem;">
                <img src="<?php echo $product->image ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $product->name; ?>
                    </h5>
                    <p class="card-text"><?php echo $product->description; ?></p>
                    <a href="/products/<?php echo $product->id; ?>" class="btn btn-primary">
                        $ <?php echo $product->price; ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<div style="display:flex;justify-content:center;" class="py-4">
    <a class="btn btn-primary" href="products">More Products</a>
</div>