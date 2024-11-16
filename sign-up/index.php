<?php
session_start();
include_once '../_connection.php'; // Ensure this points to your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debugging: Check if the form is being submitted
    echo "Form submitted.<br>";

    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $additionalFields = $_POST['additionalFields'];

    // Debugging: Check the received role
    echo "Role: " . $role . "<br>";

    try {
        // Start transaction
        $conn->begin_transaction();

        // Insert user into Users table
        $stmt = $conn->prepare("INSERT INTO Users (name, email, password, phone, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $password, $phone, $role);
        $stmt->execute();

        // Debugging: Check if the user is inserted
        echo "User inserted.<br>";

        // Get the user_id of the newly created user
        $user_id = $conn->insert_id;

        // Insert into the corresponding table based on the role
        if ($role == 'reporter') {
            $address = $additionalFields['address'];
            $occupation = $additionalFields['occupation'];
            $stmt = $conn->prepare("INSERT INTO Reporters (user_id, address, occupation) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $user_id, $address, $occupation);
            $stmt->execute();

            // Debugging: Check if the reporter is inserted
            echo "Reporter inserted.<br>";
        } elseif ($role == 'officer') {
            $badgeNumber = $additionalFields['badgeNumber'];
            $station_id = $additionalFields['station_id'];
            $rank = $additionalFields['rank'];
            $stmt = $conn->prepare("INSERT INTO PoliceOfficers (user_id, badge_number, station_id, rank) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isis", $user_id, $badgeNumber, $station_id, $rank);
            $stmt->execute();

            // Debugging: Check if the officer is inserted
            echo "Officer inserted.<br>";
        }

        // Commit transaction
        $conn->commit();
        $_SESSION['success'] = "User registered successfully!";
        header('Location: ../login'); // Redirect to a success page
        exit();
    } catch (Exception $e) {
        // Rollback transaction if something goes wrong
        $conn->rollback();
        $_SESSION['error'] = "There was an error registering the user: " . $e->getMessage();
        header('Location: ./'); // Redirect back to the form with an error message
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body, html {
            height: 100%;
        }
        main {
            height: 100% !important;
        }
    </style>
</head>

<body class="bg-dark h-100">
    <?php include "../header.php"; ?>

    <main class="d-flex flex-column gap-3 justify-content-center align-items-center">
        <section>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Select Account Type
                </button>
                <ul class="dropdown-menu">
                    <li class="ms-3"><a class="dropdown-item" onclick="selectRole('reporter')" href="#">Reporter</a></li>
                    <li class="ms-3"><a class="dropdown-item" onclick="selectRole('officer')" href="#">Officer</a></li>
                </ul>
            </div>
        </section>
        <section>
            <div class="container">
                <form class="border p-3 rounded bg-light" id="signUpForm" method="POST" action="">
                    <input type="hidden" name="role" id="role">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                    </div>
                    <div id="additionalFields"></div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </main>
    <section>
        <?php include "../footer.php"; ?>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const selectRole = (role) => {
            document.getElementById("role").value = role;
            const additionalFields = document.getElementById("additionalFields");
            additionalFields.innerHTML = ""; // Clear any existing fields

            if (role === 'reporter') { // Reporter
                additionalFields.innerHTML = `
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="additionalFields[address]" id="address">
                    </div>
                    <div class="mb-3">
                        <label for="occupation" class="form-label">Occupation</label>
                        <input type="text" class="form-control" name="additionalFields[occupation]" id="occupation">
                    </div>`;
            } else if (role === 'officer') { // Officer
                additionalFields.innerHTML = `
                    <div class="mb-3">
                        <label for="badgeNumber" class="form-label">Badge Number</label>
                        <input type="text" class="form-control" name="additionalFields[badgeNumber]" id="badgeNumber" required>
                    </div>
                    <div class="mb-3">
                        <label for="stationSelect" class="form-label">Station</label>
                        <select class="form-control" name="additionalFields[station_id]" id="stationSelect" required>
                            <option value="">Select Station</option>
                            <option value="1">Station 1</option>
                            <option value="2">Station 2</option>
                            <option value="3">Station 3</option>
                            <!-- Add more station options here -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rank" class="form-label">Rank</label>
                        <input type="text" class="form-control" name="additionalFields[rank]" id="rank">
                    </div>`;
            }
        }
    </script>
</body>

</html>