<h1>Welcome to akaPHP - DEMO</h1>
<p>
    To start using the demo type admin@akaphp.org:admin or
    user user to log in.
</p>
<div class="form_container">
    <div class="form_error">
        <?php echo $this->errMsg ?>
    </div>
    <form method="post" action="login">
        <div class="form_row">
            <label for="email">Email address</label>
            <input type="text" name="email" />
        </div>
        <div class="form_row">
            <label for="password">Password</label>
            <input type="text" name="password" />
        </div>
        <div class="form_row">
            <input class="button" type="submit" name="validate" value="validate" />
        </div>
    </form>
    <a href="login/create">Create a new account</a>
</div>