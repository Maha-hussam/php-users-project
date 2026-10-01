<?php

require_once '../config/database.php';
require_once '../includes/functions.php';

$message = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    $errors = validateUser($name, $email);

    if (empty($errors)) {

        $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':name' => $name,
            ':email' => $email
        ]);

        $message = 'User added successfully.';
        $name = '';
        $email = '';
    }
}

require_once '../includes/header.php';

?>

<style>
    form {
        width: 400px;
        margin: 30px auto;
        padding: 25px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px #ddd;
    }

    form label {
        display: block;
        margin-bottom: 6px;
        color: #333;
    }

    form input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    form button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 6px;
        background: #435b74;
        color: white;
        cursor: pointer;
    }

    form button:hover {
        background: #486581;
    }

    .error-message {
        width: 400px;
        margin: 20px auto 0;
        text-align: center;
        color: #e03737;
    }

    .success-message {
        width: 400px;
        margin: 20px auto 0;
        text-align: center;
        color: #28a745;
    }
</style>

<h1>Add User</h1>

<?php if (!empty($errors)): ?>

    <?php foreach ($errors as $error): ?>

        <p class="error-message"><?php echo htmlspecialchars($error); ?></p>

    <?php endforeach; ?>

<?php endif; ?>

<?php if ($message !== ''): ?>

    <p class="success-message"><?php echo htmlspecialchars($message); ?></p>

<?php endif; ?>

<form method="POST" action="add-user.php">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>">

    <button type="submit">Add User</button>

</form>

<?php

require_once '../includes/footer.php';