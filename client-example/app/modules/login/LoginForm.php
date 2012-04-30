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
            <input id="sButton" type="submit" name="validate" value="validate" />
        </div>
    </form>
</div>   