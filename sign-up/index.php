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
    <title>Page Title</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body class="bg-dark h-100">
    <?php include "../header.php"; ?>
    <div class="wrapper">
    <main class="">
        <section>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Select Account Type
                </button>
                <ul class="dropdown-menu">
                    <li class="ms-3"><a class="dropdown-item" onclick="selectRole('reporter')" href="#">Reporter</a>
                    </li>
                    <li class="ms-3"><a class="dropdown-item" onclick="selectRole('officer')" href="#">Officer</a></li>
                </ul>
            </div>
        </section>
        <section class="vh-100" style="background-color: #eee;">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-11">
                        <div class="card text-black" style="border-radius: 25px;">
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                        <form class="mx-1 mx-md-4" id="signUpForm" method="POST" action="">
                                            <input type="hidden" name="role" id="role" value="reporter">
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input type="text" id="name" class="form-control" name="name"
                                                        required />
                                                    <label class="form-label" for="name">Your Name</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input type="email" id="email" class="form-control" name="email"
                                                        required />
                                                    <label class="form-label" for="email">Your Email</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input type="password" id="password" class="form-control"
                                                        name="password" required />
                                                    <label class="form-label" for="password">Password</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-phone fa-lg me-3 fa-fw"></i>
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input type="text" id="phone" class="form-control" name="phone" />
                                                    <label class="form-label" for="phone">Phone Number</label>
                                                </div>
                                            </div>

                                            <div id="additionalFields">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" class="form-control"
                                                        name="additionalFields[address]" id="address">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="occupation" class="form-label">Occupation</label>
                                                    <input type="text" class="form-control"
                                                        name="additionalFields[occupation]" id="occupation">
                                                </div>
                                            </div>

                                            <div class="form-check d-flex justify-content-center mb-5">
                                                <input class="form-check-input me-2" type="checkbox" value=""
                                                    id="form2Example3c" />
                                                <label class="form-check-label" for="form2Example3">
                                                    I agree all statements in <a href="#!">Terms of service</a>
                                                </label>
                                            </div>

                                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-primary btn-lg">Register</button>
                                            </div>
                                        </form>

                                    </div>
                                    <div
                                        class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                        <img src="../assets/img/draw1.webp" class="img-fluid" alt="Sample image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
    </div>
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
                        <input type="text" class="form-control" name="additionalFields[address]" id="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="occupation" class="form-label">Occupation</label>
                        <input type="text" class="form-control" name="additionalFields[occupation]" id="occupation" required>
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
                        <input type="text" class="form-control" name="additionalFields[rank]" id="rank" required>
                    </div>`;
            }
        }
    </script>
</body>
</html>