<!-- <div class="card">
            <div class="card-header">Reports</div>
            <div class="card-body">
                <p>View detailed reports on platform activity and performance.</p>
            </div>
        </div> -->
<?php
require_once '../../core/init.php';
require_once '../../core/database/connection.php';
$getFromU->markReportsAsRead();
$data = $getFromU->showToAdmin();
?>
<div class="card shadow-lg border-0 rounded-4">
    <div class="card-header bg-gradient text-white d-flex justify-content-between align-items-center" 
         style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
        <h5 class="mb-0">📊 User Reports</h5>
        <span class="badge bg-light text-dark px-3 py-2">Total: <?= count($data ?? []) ?> Reports</span>
    </div>
    <div class="card-body">
        <p class="text-muted">Below is a comprehensive report of user activity and performance:</p>
        <div class="table-responsive rounded-3 border">
            <table class="table table-striped table-hover align-middle mb-0" border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead class="table-dark" style="background-color:skyblue;">
                    <tr style="text-align: center; justify-content:center;">
                        <th scope="col">#</th>
                        <th scope="col">Reported By ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Reason</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($data)) {
                        $counter = 1;
                        foreach ($data as $row) {
                            echo '<tr>';
                            echo '<th scope="row" style="text-align: center; justify-content:center;">' . $counter++ . '</th>';
                            echo '<td style="text-align: center; justify-content:center;">' . htmlspecialchars($row['reportedByID']) . '</td>';
                            echo '<td style="text-align: center; justify-content:center;">' . htmlspecialchars($row['reportedUsername']) . '</td>';
                            echo '<td style="text-align: center; justify-content:center;">' . htmlspecialchars($row['reportedSurname']) . '</td>';
                            echo '<td style="text-align: center; justify-content:center;">' . htmlspecialchars($row['reportedEmail']) . '</td>';
                            echo '<td style="text-align: center; justify-content:center;">' . htmlspecialchars($row['reportedReason']) . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center text-muted'>No reports found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
        <small class="text-muted">Last updated: <?= date('Y-m-d H:i:s') ?></small>
        <button class="btn btn-sm btn-primary shadow-sm px-3" onclick="exportReports()">📥 Export Reports</button>
    </div>
</div>


<script>
    // Example function to export reports
    function exportReports() {
        alert('Feature coming soon!'); // Replace with actual export logic
    }
</script>