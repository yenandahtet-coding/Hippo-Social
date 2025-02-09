<div class="card">
    <div class="card-header">Manage Reposts</div>
    <div class="card-body">
        <p>Handle reposts and platform activities effectively.</p>
    </div>
</div>

<?php
require_once '../../core/init.php';
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $tweet_id = $_POST['tweet_id'];

    if ($action == 'delete') {
        if ($getFromT->deleteTweets($tweet_id)) {
            echo json_encode(['status' => 'success']);
            echo 'console.log("Succes")';
        } else {
            echo json_encode(['status' => 'error']);
            echo 'console.log("Succes")';
        }
        exit;
    }
}

$retweets = $getFromT->getAllRetweets();
?>
<div class="card">
    <div class="card-header">Manage Reposts</div>
    <div class="card-body">
        <p>Handle reposts and platform activities effectively.</p>

        <input type="text" class="retweet-search-bar" placeholder="Search by Username or Tweet ID" onkeyup="searchRetweets()"
            style="width: 100%; padding: 10px; margin-bottom: 20px; border-radius: 5px;">

        <table id="retweets-table" border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background-color:skyblue;">
                <tr style="text-align: center; justify-content:center;">
                    <th>Repost ID</th>
                    <th>Original Post ID</th>
                    <th>Username</th>
                    <th>Repost Message</th>
                    <th>Repost Inage</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($retweets as $retweet): ?>
                    <tr id="retweet-<?php echo $retweet->tweetID; ?>">
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($retweet->tweetID); ?></td>
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($retweet->retweetID); ?></td>
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($retweet->username); ?></td>
                        <td style="text-align: center; justify-content:center;"><?php echo htmlspecialchars($retweet->retweetMsg); ?></td>
                        <td style="text-align: center; justify-content:center;">
                            <?php if (!empty($retweet->tweetImage)): ?>
                                <img src="../../<?php echo htmlspecialchars($retweet->tweetImage); ?>" alt="Tweet Image" style="max-width: 100px; max-height: 100px;">
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center; justify-content:center;">
                            <button class="btn-delete" onclick="deleteRetweet(<?php echo $retweet->tweetID; ?>)"
                                style="background-color: red; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let searchInput = document.querySelector('.search-bar');
        if (searchInput) {
            searchInput.addEventListener('keyup', searchTweets);
        }
    });

    function searchRetweets() {
        let input = document.querySelector('.retweet-search-bar').value.toLowerCase();
        let rows = document.querySelectorAll('#retweets-table tbody tr');
        rows.forEach(row => {
            let retweetID = row.cells[0].textContent.toLowerCase();
            let originalTweetID = row.cells[1].textContent.toLowerCase();
            let username = row.cells[2].textContent.toLowerCase();
            if (retweetID.includes(input) || originalTweetID.includes(input) || username.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function deleteRetweet(retweetID) {
        Swal.fire({
            title: "Are you sure?",
            text: "You are about to delete this retweet!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'manage_reposts.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if (response.status === 'success') {
                                document.getElementById('retweet-' + retweetID).remove();
                                Swal.fire("Deleted!", "The retweet has been deleted.", "success");
                            } else {
                                Swal.fire("Error!", "Failed to delete the retweet.", "error");
                            }
                        } catch (e) {
                            console.error('Failed to parse JSON response:', e);
                            Swal.fire("Error!", "An error occurred while processing the request.", "error");
                        }
                    }
                };
                // xhr.send(`action=delete&tweet_id=${retweetID}`);
                xhr.send('action=delete&tweet_id=' + retweetID);
            }
        });
    }
</script>