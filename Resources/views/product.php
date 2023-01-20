<div class="row py-4 ">
    <div class="col-sm-12 col-lg-6">
        <img src="../../<?php echo $product->image ?>" style="width: 100%;" alt="">
    </div>
    <div class="col-sm-12 col-lg-6">
        <h2>
            <?php echo $product->name; ?>
        </h2>
        <p>
            <?php echo $product->description; ?>
        </p>
        <p style="font-weight: bold;">
            $ <?php echo $product->price ?>
        </p>
        <div>
            <button class="btn btn-success">Buy</button>
        </div>
    </div>
</div>