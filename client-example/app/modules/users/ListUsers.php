<table>
    <tr>
        <td>User email</td>
        <td>Password</td>
        <td>actions</td>
    </tr>
    <?php foreach($this->users as $user): ?>
    <tr>
        <td>
            <?php echo $user->getEmail() ?>
        </td>
        <td>
            <?php echo $user->getPassword(); ?>
        </td>
        <td>
            <a href="users/delete?id=<?php echo $user->getId(); ?>">delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>