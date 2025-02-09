<div class="card">
    <div class="card-header">Manage Posts</div>
    <div class="card-body">
        <p>Manage user posts, approve or delete content as needed.</p>
    </div>
</div>

<?php
require_once '../../core/init.php';

$tweets = $getFromT->getAllTweets();

// if (isset($_POST['action'])) {
//     $action = $_POST['action'];
//     $tweet_id = $_POST['tweet_id'];
//     $user_id = $_SESSION['user_id'];
//     echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

//     if ($action == 'delete') {
//         $tweet = $getFromT->tweetPopup($tweet_id);
//         $imageLink = '../../' . $tweet->tweetImage;
//         $getFromT->deleteTweets($tweet_id);
//         if (!empty($tweet->tweetImage)) {
//             unlink($imageLink);
//         }
//         if ($getFromT->deleteTweets($tweet_id)) {
//             echo '
//             <script>
//                 Swal.fire({
//                 title: "Delete Post Process!",
//                 text: "You delete this post successfully!",
//                 icon: "success"
//                 });
//             </script>
//         ';
//         }
//     } elseif ($action == 'edit' && isset($_POST['status'])) {
//         $status = $_POST['status'];
//         if ($getFromT->updateTweets('tweets', $tweet_id, array('status' => $status))) {
//             echo '
//             <script>
//                 Swal.fire({
//                 title: "Update Post Process!",
//                 text: "You update this post successfully!",
//                 icon: "success"
//                 });
//             </script>
//         ';
//         }
//     } else {
//         echo '
//             <script>
//                 Swal.fire({
//                 title: "Update Post Process!",
//                 text: "Your post edition is failed!",
//                 icon: "error"
//                 });
//             </script>
//     ';
//     }
// }


if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $tweet_id = $_POST['tweet_id'];
    $user_id = $_SESSION['user_id'];

    if ($action == 'delete') {
        $tweet = $getFromT->tweetPopup($tweet_id);
        $imageLink = '../../' . $tweet->tweetImage;
        // $getFromT->deleteTweets('tweets', array('tweetID' => $tweet_id, 'tweetBy' => $user_id));
        $getFromT->deleteTweets($tweet_id);
        if (!empty($tweet->tweetImage)) {
            unlink($imageLink);
        }
        echo '
            <script>
                Swal.fire({
                title: "Delete Post Process!",
                text: "You delete this post successfully!",
                icon: "success"
                });
            </script>
        ';
        exit;
    } elseif ($action == 'edit' && isset($_POST['status'])) {
        $status = $_POST['status'];
        $getFromT->updateTweets('tweets', $tweet_id, array('status' => $status));
        echo '
            <script>
                Swal.fire({
                title: "Update Post Process!",
                text: "You update this post successfully!",
                icon: "success"
                });
            </script>
        ';
        exit;
    } else {
        echo '
        <script>
            Swal.fire({
            title: "Post Process!",
            text: "Your post action is failed!",
            icon: "error"
            });
        </script>
        ';
        exit;
    }
}

?>
<div class="card">
    <div class="card-header">Manage Posts</div>
    <div class="card-body">
        <p>Manage user posts, approve or delete content as needed.</p>
        <input type="text" class="tweet-search-bar" placeholder="Search by Id or Name" onkeyup="searchTweets()"
            style="width: 100%; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
            
            <table id="tweets-table" border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background-color:skyblue;">
                <tr style="text-align: center; justify-content:center;">
                    <th>Post ID</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Post</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tweets as $tweet): ?>
                    <tr id="tweet-<?php echo $tweet->tweetID; ?>">
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($tweet->tweetID); ?></td>
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($tweet->tweetBy); ?></td>
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($tweet->username); ?></td>
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($tweet->status); ?></td>
                        <td style="text-align: center; justify-content:center;">
                            <?php if (!empty($tweet->tweetImage)): ?>
                                <img src="../../<?php echo htmlspecialchars($tweet->tweetImage); ?>" alt="Tweet Image" style="max-width: 100px; max-height: 100px;">
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center; justify-content:center;">
                            <!-- <button class="btn-edit" onclick="editTweet(<?php echo $tweet->tweetID; ?>)"
                                style="background-color: green; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">Edit</button> -->
                            <input type="hidden" name="user_id" value="<?php echo $tweet->tweetID; ?>">
                            <button class="btn-delete" onclick="deleteTweet(<?php echo $tweet->tweetID; ?>)"
                                style="background-color: red; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Ensure search works after page loads
    document.addEventListener("DOMContentLoaded", function() {
        let searchInput = document.querySelector('.search-bar');
        if (searchInput) {
            searchInput.addEventListener('keyup', searchTweets);
        }
    });


    function deleteTweet(tweetID) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'manage_posts.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            document.getElementById('tweet-' + tweetID).remove();
                            Swal.fire("Deleted!", "Your tweet has been deleted.", "success").then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Error!", "Failed to delete tweet.", "error");
                        }
                    }
                };
                xhr.send('action=delete&tweet_id=' + tweetID);
            }
        });
    }

    function searchTweets() {
        let input = document.querySelector('.tweet-search-bar')?.value.toLowerCase().trim();
        let rows = document.querySelectorAll('#tweets-table tbody tr');

        if (!input || !rows.length) return; // If input is empty or no rows, stop execution.

        rows.forEach(row => {
            let userID = row.cells[1]?.textContent.toLowerCase().trim() || "";
            let username = row.cells[2]?.textContent.toLowerCase().trim() || "";

            if (userID.includes(input) || username.includes(input)) {
                row.style.display = ''; // Show the row if it matches
            } else {
                row.style.display = 'none'; // Hide the row if it doesn't match
            }
        });
    }
</script>