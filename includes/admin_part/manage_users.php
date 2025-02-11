<?php
<<<<<<< HEAD
require_once '../../core/init.php';
// header('Content-Type: application/json');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $userId = $_POST['user_id'];

    if ($action == 'delete') {
        if ($getFromU->deleteUser($userId)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
        exit;
    } elseif ($action == 'ban') {
        if ($getFromU->banUser($userId)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
        exit;
    } elseif ($action == 'unban') {
        if ($getFromU->unbanUser($userId)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
        exit;
    }
}

$users = $getFromU->readUser();
=======
// require_once '../../core/init.php';

// $users = $getFromU->readUser();
// echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

// if (isset($_POST['ban'])) {
//     $id = $_POST['user_id'];
//     if ($getFromU->banUser($id)) {
//         echo '
//             <script>
//                 Swal.fire({
//                 title: "Ban Process!",
//                 text: "You ban this user successfully!",
//                 icon: "success"
//                 });
//             </script>
//         ';
//     } else {
//         echo '
//             <script>
//                 Swal.fire({
//                 title: "Ban Process!",
//                 text: "Banning Process is failed!",
//                 icon: "error"
//                 });
//             </script>
//     ';
//     }
// }

// if (isset($_POST['unban'])) {
//     $id = $_POST['user_id'];
//     if ($getFromU->unbanUser($id)) {
//         echo '
//             <script>
//                 Swal.fire({
//                 title: "Unban Process!",
//                 text: "You unbanded this user successfully!",
//                 icon: "success"
//                 });
//             </script>
//         ';
//     } else {
//         echo '
//             <script>
//                 Swal.fire({
//                 title: "Unban Process!",
//                 text: "Your action is rejected!",
//                 icon: "error"
//                 });
//             </script>
//         ';
//     }
// }


// if (isset($_POST['delete'])) {
//     $userId = $_POST['user_id'];
//     if ($getFromU->deleteUser($userId)) {
//         echo '
//                 <script>
//                     Swal.fire({
//                     title: "Are you sure?",
//                     text: "You will not be able to revert this!",
//                     icon: "warning",
//                     showCancelButton: true,
//                     confirmButtonColor: "#3085d6",
//                     cancelButtonColor: "#d33",
//                     confirmButtonText: "Yes, delete it!"
//                 }).then((result) => {
//                     if (result.isConfirmed) {
//                     Swal.fire({
//                         title: "Deleted!",
//                         text: "Your file has been deleted.",
//                         icon: "success"
//                     });
//                     }
//                 });
//                 </script>
//             ';
//     } else {
//         echo '
//                 <script>
//                     Swal.fire({
//                     title: "Delete Process!",
//                     text: "Your deletion is failed!",
//                     icon: "success"
//                     });
//                 </script>
//             ';
//     }
// }

>>>>>>> 81fc449ef99aedb37fa546fe30de780262737670
?>
<!-- <div class="card">
    <div class="card-header">User Management</div>
    <div class="card-body">
        <p>Manage users, view details, and perform actions such as deactivating or deleting users.</p>

        <input type="text" class="search-bar" placeholder="Search by Name or Email" onkeyup="searchUser()"
            style="width: 100%; padding: 10px; margin-bottom: 20px; border-radius: 5px;">

        <table id="users-table" border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background-color:skyblue;">
                <tr style="text-align: center; justify-content:center;">
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
<<<<<<< HEAD
                    <tr id="user-<?php echo $user->user_id; ?>">
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($user->user_id); ?></td>
=======
                    <tr>
                        <td style="text-align: center; justify-content:center;"><?php htmlspecialchars($user->user_id);
                                                                                echo $count++ ?></td>
>>>>>>> 81fc449ef99aedb37fa546fe30de780262737670
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($user->username); ?></td>
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($user->email); ?></td>
                        <td style="text-align: center; justify-content:center;"><?php echo $user->isAdmin ? 'Admin' : 'User'; ?></td>
                        <td style="text-align: center; justify-content:center;">
<<<<<<< HEAD
                            <button onclick="banUser(<?php echo $user->user_id; ?>, 'ban')" style="background-color: green; color: white; padding: 8px 15px; border-radius: 5px; cursor: pointer;">Ban</button>
                            <button onclick="banUser(<?php echo $user->user_id; ?>, 'unban')" style="background-color: green; color: white; padding: 8px 15px; border-radius: 5px; cursor: pointer;">Unban</button>
                            <button onclick="deleteUser(<?php echo $user->user_id; ?>)" style="background-color: red; color: white; padding: 8px 15px; border-radius: 5px; cursor: pointer;">Delete</button>
=======
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                                <button class="btn-edit" name="ban" onclick="banUser(<?php echo $tweet->tweetID; ?>)"
                                    style="background-color: green; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">Ban</button>
                            </form>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                                <button class="btn-edit" name="unban" onclick="unbanUser(<?php echo $tweet->tweetID; ?>)"
                                    style="background-color: green; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">Unban</button>
                            </form>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                                <button class="btn-delete" name="delete" onclick="deleteUser(<?php echo $users->user_id; ?>)"
                                    style="background-color: red; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;"
                                    onclick="deleteUser(<?php echo $user->user_id; ?>, this)">Delete</button>
                            </form>
>>>>>>> 81fc449ef99aedb37fa546fe30de780262737670
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<<<<<<< HEAD

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
=======
<script>
    function banUser(userId, action) {
        $.post('user_action.php', {
            user_id: userId,
            action: action
        }, function(response) {
            Swal.fire(action.charAt(0).toUpperCase() + action.slice(1) + ' Process!', response, 'success');
        }).fail(() => Swal.fire('Error', 'Action failed!', 'error'));
    }

    function deleteUser(userId) {
        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('user_action.php', {
                    user_id: userId,
                    action: 'delete'
                }, function(response) {
                    Swal.fire("Deleted!", "User has been deleted.", "success");
                    $("#user-" + userId).fadeOut(500, function() {
                        $(this).remove();
                    });
                }).fail(() => Swal.fire("Error", "Deletion failed!", "error"));
            }
        });
    }
</script>
 -->



 <?php
require_once '../../core/init.php';

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $userId = $_POST['user_id'];

    if ($action == 'delete') {
        if ($getFromU->deleteUser($userId)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
        exit;
    } elseif ($action == 'ban') {
        if ($getFromU->banUser($userId)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
        exit;
    } elseif ($action == 'unban') {
        if ($getFromU->unbanUser($userId)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
        exit;
    }
}

$users = $getFromU->readUser();
?>
<div class="card">
    <div class="card-header">User Management</div>
    <div class="card-body">
        <p>Manage users, view details, and perform actions such as deactivating or deleting users.</p>

        <input type="text" class="search-bar" placeholder="Search by Name or Email" onkeyup="searchUser()"
            style="width: 100%; padding: 10px; margin-bottom: 20px; border-radius: 5px;">

        <table id="users-table" border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background-color:skyblue;">
                <tr style="text-align: center; justify-content:center;">
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
                    <tr id="user-<?php echo $user->user_id; ?>">
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($user->user_id); ?></td>
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($user->username); ?></td>
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($user->email); ?></td>
                        <td style="text-align: center; justify-content:center;"><?php echo $user->isAdmin ? 'Admin' : 'User'; ?></td>
                        <td style="text-align: center; justify-content:center;">
                            <button onclick="banUser(<?php echo $user->user_id; ?>, 'ban')" style="background-color: green; color: white; padding: 8px 15px; border-radius: 5px; cursor: pointer;">Ban</button>
                            <button onclick="banUser(<?php echo $user->user_id; ?>, 'unban')" style="background-color: green; color: white; padding: 8px 15px; border-radius: 5px; cursor: pointer;">Unban</button>
                            <button onclick="deleteUser(<?php echo $user->user_id; ?>)" style="background-color: red; color: white; padding: 8px 15px; border-radius: 5px; cursor: pointer;">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

>>>>>>> 81fc449ef99aedb37fa546fe30de780262737670
<script>
function banUser(userId, action) {
    Swal.fire({
        title: `Are you sure?`,
        text: `You want to ${action} this user?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: `Yes, ${action} user`
    }).then((result) => {
        if (result.isConfirmed) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'manage_users.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    try {
<<<<<<< HEAD
                        const responseText = xhr.responseText;
=======
>>>>>>> 81fc449ef99aedb37fa546fe30de780262737670
                        const response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            Swal.fire("Success!", `User has been ${action}ned successfully!`, "success");
                        } else {
                            Swal.fire("Error!", `Failed to ${action} user.`, "error");
                        }
                    } catch (e) {
                        console.error('Failed to parse JSON response:', e);
<<<<<<< HEAD
                        console.error('Response received:', xhr.responseText);
                        Swal.fire("Error!", "An error occurred while processing the request.", "error");
                    }
                } else {
                    console.error('Request failed with status:', xhr.status);
                    Swal.fire("Error!", "An error occurred while processing the request.", "error");
=======
                        Swal.fire("Error!", "An error occurred while processing the request.", "error");
                    }
>>>>>>> 81fc449ef99aedb37fa546fe30de780262737670
                }
            };
            xhr.send(`action=${action}&user_id=${userId}`);
        }
    });
}

function deleteUser(userId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'manage_users.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            document.getElementById('user-' + userId).remove();
                            Swal.fire("Deleted!", "User has been deleted.", "success");
                        } else {
                            Swal.fire("Error!", "Failed to delete user.", "error");
                        }
                    } catch (e) {
                        console.error('Failed to parse JSON response:', e);
                        Swal.fire("Error!", "An error occurred while processing the request.", "error");
                    }
                }
            };
            xhr.send(`action=delete&user_id=${userId}`);
        }
    });
}


function searchUser() {
    let input = document.querySelector('.search-bar').value.toLowerCase();
    let rows = document.querySelectorAll('#users-table tbody tr');
    rows.forEach(row => {
        let name = row.cells[1].textContent.toLowerCase();
        let email = row.cells[2].textContent.toLowerCase();
        if (name.includes(input) || email.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>
