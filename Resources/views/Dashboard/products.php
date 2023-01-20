${./layouts/dashboardLayout}$


<div class="py-4">
    <div>
        <h2>Products</h2>
        <a href="/dashboard/create" class="btn btn-success">
            Add Product
        </a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        id
                    </th>
                    <th>
                        name
                    </th>
                    <th>
                        price
                    </th>
                    <!-- <th>
                        available
                    </th> -->
                    <th>
                        description
                    </th>
                    <th>
                        options
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td>
                            <?php echo $product->id; ?>
                        </td>
                        <td>
                            <?php echo $product->name; ?>
                        </td>
                        <td>
                            <?php echo $product->price; ?>
                        </td>
                        <!-- <td>
                            <?php echo $product->available; ?>
                        </td> -->
                        <td>
                            <?php echo substr($product->description, 0, 100) . "..."; ?>
                        </td>
                        <td class="d-flex gap-2">
                            <a href='/dashboard/<?php echo $product->id; ?>/edit' class="btn btn-success">
                                Edit
                            </a>
                            <form method="post" action="/dashboard/<?php echo $product->id; ?>/delete">
                                <button class="btn btn-danger">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>