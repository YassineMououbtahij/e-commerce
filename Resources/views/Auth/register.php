${./layouts/authLayout}$

<div style="height: 100%">
    <div style="display:flex;justify-content:center;">
        <form action="/register" method="post" class="bg-success rounded p-4 mt-4" style="display:flex;flex-direction:column;max-width:400px;gap:8px;width:100%">
            <input value="<?php echo $_POST['firstname'] ?? ""; ?>" name="firstname" class="form-control" type="text" placeholder="First Name...">
            <?php echo isset($errors["firstname"]) ? "<div class='text-white' >{$errors['firstname']}</div>" : ""; ?>
            <input value="<?php echo $_POST['lastname'] ?? ""; ?>" name="lastname" class="form-control" type="text" placeholder="last Name...">
            <?php echo isset($errors["lastname"]) ? "<div class='text-white' >{$errors['lastname']}</div>" : ""; ?>
            <input value="<?php echo $_POST['email'] ?? ""; ?>" name="email" class="form-control" type="email" placeholder="Email Address...">
            <?php echo isset($errors["email"]) ? "<div class='text-white' >{$errors['email']}</div>" : ""; ?>
            <input value="<?php echo $_POST['password'] ?? ""; ?>" name="password" class="form-control" type="password" placeholder="Password...">
            <?php echo isset($errors["password"]) ? "<div class='text-white' >{$errors['password']}</div>" : ""; ?>
            <input value="<?php echo $_POST['password_confirmation'] ?? ""; ?>" name="password_confirmation" class="form-control" type="password" placeholder="Password Confirmation...">
            <?php echo isset($errors["password_confirmation"]) ? "<div class='text-white' >{$errors['password_confirmation']}</div>" : ""; ?>
            <div class="d-flex justify-content-center">
                <button class="btn btn-light">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>