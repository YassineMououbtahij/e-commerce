<form class="pt-4 d-flex gap-2">
    <input name="search" value="<?php echo $_GET['search'] ?? ''; ?>" class=" form-control" placeholder="Search..." type="text">
    <button class="btn btn-primary">
        Search
    </button>
</form>

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