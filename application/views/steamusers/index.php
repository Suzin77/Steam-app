<div class = "container">
	<h2>Jestem widokiem games, bede pokazywal zapisanych graczy</h2>

	<p>LIczba znalezionych graczy to: <span><?php echo $amount_of_users?></span></p>
	<h3>List of users (data from first model)</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>Artist</td>
                <td>Track</td>
                <td>Link</td>
                <td>DELETE</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php if (isset($user->user_id)) echo $user->user_id; ?></td>
                    <td><?php if (isset($user->personal_name)) echo $user->personal_name; ?></td>
                    <td><?php if (isset($user->track)) echo $user->track; ?></td>
                    <td>
                        <?php if (isset($user->link)) { ?>
                            <a href="<?php echo $user->link; ?>"><?php echo $user->link; ?></a>
                        <?php } ?>
                    </td>
                    <td><a href="<?php echo URL . 'steamusers/deleteuser/' . $user->user_id; ?>">x</a></td>
                </tr>
            <?php } ?>
            <!-- end of foreach -->
            </tbody>
        </table>
</div>	
