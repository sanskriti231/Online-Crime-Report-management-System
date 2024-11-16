<?php
session_start();
include_once '../_connection.php'; // Ensure this points to your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debugging: Check if the form is being submitted
    echo "Form submitted.<br>";

    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Debugging: Check the received email and password
    echo "Email: " . $email . "<br>";
    echo "Password: " . $password . "<br>";

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT user_id, password, role FROM Users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // User found
            $row = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Password is correct, start a session
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['role'] = $row['role'];

                // Redirect to different pages based on role
                if ($row['role'] == 'reporter') {
                    header('Location: ../dashboard');
                } elseif ($row['role'] == 'officer') {
                    header('Location: ../dashboard');
                } else {
                    // Redirect to a general dashboard or home page
                    header('Location: ../home');
                }
                exit();
            } else {
                // Password is incorrect
                $_SESSION['error'] = "Invalid email or password.";
                header('Location: ./');
                exit();
            }
        } else {
            // User not found
            $_SESSION['error'] = "Invalid email or password.";
            header('Location: ./');
            exit();
        }
    } catch (Exception $e) {
        // Handle any other errors
        $_SESSION['error'] = "There was an error logging in: " . $e->getMessage();
        header('Location: ./');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">

    <style>
        main {
            height: 67vh !important;
        }
    </style>
</head>

<body class="bg-dark h-100">
    <?php include "../header.php"; ?>

    <main class="d-flex justify-content-center align-items-center">
        <section>
            <div class="">
                <form class="border p-3 rounded text-bg-light" method="POST" action="">
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                        unset($_SESSION['error']);
                    }
                    ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </main>
    <section>
        <?php include "../footer.php"; ?>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>