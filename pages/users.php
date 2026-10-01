<?php

require_once '../config/database.php';
require_once '../includes/header.php';

$sql = "SELECT id, name, email, created_at FROM users";

$stmt = $pdo->query($sql);

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<style>
    .users-table {
        width: 80%;
        margin: 30px auto;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 2px 8px #ddd;
    }

    .users-table th {
        background: #435b74;
        color: white;
        padding: 12px;
        text-align: left;
    }

    .users-table td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        color: #333;
    }

    .no-users {
        text-align: center;
        color: #777;
        margin-top: 30px;
    }
</style>

<h1>Users List</h1>

<?php if (empty($users)): ?>

    <p class="no-users">No users found.</p>

<?php else: ?>

    <table class="users-table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($users as $user): ?>

                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['created_at']; ?></td>
                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

<?php endif; ?>

<?php

require_once '../includes/footer.php';

?>