<div style="height: 100%">
    <div style="display:flex;justify-content:center;">
        <form enctype="multipart/form-data" action="/dashboard/create" method="post" class="bg-success rounded p-4 mt-4" style="display:flex;flex-direction:column;max-width:400px;gap:8px;width:100%">
            <input class="form-control" type="text" name="name" placeholder="name" />
            <?php echo isset($errors['name']) ? $errors['name'] : "" ?>
            <input class="form-control" type="number" name="price" placeholder="price" />
            <?php echo isset($errors['price']) ? $errors['price'] : "" ?>
            <input class="form-control" type="file" name="image" />
            <!-- <select class="form-control" name="available">
                <option value="true" selected>True</option>
                <option value="false">False</option> -->
            </select>
            <input class="form-control" type="text" name="description" placeholder="description" />
            <?php echo isset($errors['description']) ? $errors['description'] : "" ?>
            <div class="d-flex justify-content-center">
                <button class="btn btn-light">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>