<div style="height: 100%">

    <?php

    if (isset($errors['issue'])) {
        echo "<div class='alert alert-danger' >{$errors['issue']}</div>";
    }

    ?>

    <div style="display:flex;align-items:center;flex-direction:column">
        <h2 class="mt-4">
            Update
        </h2>
        <form enctype="multipart/form-data" action="/dashboard/<?php echo $product->id; ?>/edit" method="post" class="bg-success rounded p-4 mt-4" style="display:flex;flex-direction:column;max-width:400px;gap:8px;width:100%">
            <input value="<?php echo isset($product) ?  $product->name : "" ?>" class="form-control" type="text" name="name" placeholder="name" />
            <?php echo isset($errors['name']) ? $errors['name'] : "" ?>
            <input value="<?php echo isset($product) ?  $product->price : "" ?>" class="form-control" type="number" name="price" placeholder="price" />
            <?php echo isset($errors['price']) ? $errors['price'] : "" ?>
            <input class="form-control" type="file" name="image" />
            <!-- <select class="form-control" name="available">
                <option <?php echo isset($product) && $product->available ? "selected" : "" ?> value="true">True</option>
                <option <?php echo isset($product) && !$product->available ? "selected" : "" ?> value="false">False</option>
            </select> -->
            <input value='<?php echo isset($product)  ? $product->description : "" ?>' class="form-control" type="text" name="description" placeholder="description" />
            <?php echo isset($errors['description']) ? $errors['description'] : "" ?>
            <div class="d-flex justify-content-center">
                <button class="btn btn-light">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>