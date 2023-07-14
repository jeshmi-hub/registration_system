<?php
$error = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $error = "Enter name";
    } else if (empty($_POST["email"])) {
        $error = "Enter email";
    } else if (empty($_POST["password"])) {
        $error = "Enter password";
    } else if (empty($_POST["confirmPassword"])) {
        $error = "Enter confirmPassword";
    }

    if (empty($error)) {
        if (file_exists('users.json')) {
            $final_data = fileWriteAppend();
            if (file_put_contents('users.json', $final_data)) {
                $message = "Data added successfully";
            }
        } else {
            $final_data = fileCreateWrite();
            if (file_put_contents('users.json', $final_data)) {
                $message = "File created and data added successfully";
            }
        }
    }
}

function fileWriteAppend() {
    $current_data = file_get_contents('users.json');
    $array_data = json_decode($current_data, true);
    $extra = array(
        'name' => $_POST['name'],
        'email' => $_POST["email"],
        'password' => $_POST["password"],
        'confirmPassword' => $_POST["confirmPassword"]
    );
    $array_data[] = $extra;
    $final_data = json_encode($array_data);
    return $final_data;
}

function fileCreateWrite() {
    $array_data = array();
    $extra = array(
        'name' => $_POST['name'],
        'email' => $_POST["email"],
        'password' => $_POST["password"],
        'confirmPassword' => $_POST["confirmPassword"],
    );
    $array_data[] = $extra;
    $final_data = json_encode($array_data);
    return $final_data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data" autocomplete="off">
    <h1>Register</h1>
    <h4>All the fields are <span>required</span></h4>

    <label>Name</label>
    <input type="text" name="name">
    <br>
    <label>Email Address</label>
    <input type="text" name="email">
    <br>
    <label>Password</label>
    <input type="password" name="password">
    <br>
    <label>Confirm Password</label>
    <input type="password" name="confirmPassword">
    <br>
    <button type="submit">Register</button>   
    <p class="error"><?php echo isset($error) ? htmlspecialchars($error) : ''; ?></p>
    <p class="success"><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></p>
    </form>
</body>
</html>
