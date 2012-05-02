<h1>Account creation</h1>
<div class="form_container">
    <div class="form_error">
        <?php echo $this->errMsg ?>
    </div>
    <form method="post" action="create">
        <div class="form_row">
            <label for="email">Email address</label>
            <input type="text" name="email" />
        </div>
        <div class="form_row">
            <label for="password">Password</label>
            <input type="password" name="password" />
        </div>
        <div class="form_row">
            <label for="password">Retype password</label>
            <input type="password" name="password" />
        </div>
        <div class="form_row">
            <input class="button" type="submit" name="validate" value="validate" />
        </div>
    </form>
    <a href="/welcome">Cancel</a>
</div>