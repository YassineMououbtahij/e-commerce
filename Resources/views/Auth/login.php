${./layouts/authLayout}$

<div style="height: 100%">
    <div style="display:flex;justify-content:center;">
        <form action="/login" method="post" class="bg-success rounded p-4 mt-4" style="display:flex;flex-direction:column;max-width:400px;gap:8px;width:100%">
            <input name="email" class="form-control" type="email" placeholder="Email Address...">
            <?php echo isset($errors["email"]) ? "<div class='text-white' >{$errors['email']}</div>" : ""; ?>
            <input name="password" class="form-control" type="password" placeholder="Password...">
            <?php echo isset($errors["password"]) ? "<div class='text-white' >{$errors['password']}</div>" : ""; ?>
            <div class="d-flex justify-content-center">
                <button class="btn btn-light">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>