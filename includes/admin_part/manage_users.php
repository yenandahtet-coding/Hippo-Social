<?php
$users = $getFromU->readUser();
if (isset($_POST['ban'])) {
    $id = $_POST['id'];
    $getFromU->banUser($id);
    header("Location: admindashboard.php");
    exit;
} else if (isset($_POST['delete'])) {
    $userId = $_POST['user_id'];
    $getFromU->deleteUser($userId);
    header("Location: manage_users.php"); // Refresh the page after deletion
    exit;
}
?>
<div class="card">
    <div class="card-header">User Management</div>
    <div class="card-body">
        <p>Manage users, view details, and perform actions such as deactivating or deleting users.</p>

        <input type="text" class="search-bar" placeholder="Search by Name or Email" onkeyup="searchUser()"
            style="width: 100%; padding: 10px; margin-bottom: 20px; border-radius: 5px;">

        <table id="users-table" border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($users as $user): ?>
                    <tr>
                        <td><?php htmlspecialchars($user->user_id);
                            echo $count++ ?></td>
                        <td><?php echo htmlspecialchars($user->username); ?></td>
                        <td><?php echo htmlspecialchars($user->email); ?></td>
                        <td><?php echo $user->isAdmin ? 'Admin' : 'User'; ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                                <button class="btn-edit" name="ban"
                                    style="background-color: green; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">Ban</button>
                            </form>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                                <button class="btn-delete" name="delete"
                                    style="background-color: red; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>