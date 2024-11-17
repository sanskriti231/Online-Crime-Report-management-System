<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="image/profile.jpg" class="avatar img-fluid rounded" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item">Setting</a>
                                <a href="./sign-out.php" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="m-3">
                        <div class="btn btn-danger">Add Report</div>
                    </div>
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Past History
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Report Id</th>
                                        <th scope="col">Report Title</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Report Date</th>
                                        <th scope="col">Officer Name</th>
                                        <th scope="col">Officer Id</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be inserted here dynamically via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            function loadReports() {
                $.ajax({
                    url: './fetch_reports.php', // PHP file to fetch the data
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Clear any previous table data
                        $('table tbody').empty();

                        if (data.length > 0) {
                            // Loop through the data and append rows to the table
                            data.forEach(function (report, index) {
                                var row = 
                            <tr>
                                <th scope="row">${index + 1}</th>
                                <td>${report.report_id}</td>
                                <td>${report.title}</td>
                                <td>${report.location}</td>
                                <td>${report.description}</td>
                                <td>${report.date_of_incident}</td>
                                <td>${report.officer_name}</td>
                                <td>${report.officer_id}</td>
                                <td>${report.status}</td>
                            </tr>
                        ;
                                $('table tbody').append(row);
                            });
                        } else {
                            // No data found
                            $('table tbody').append('<tr><td colspan="9" class="text-center">No reports found</td></tr>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching reports: " + error);
                        $('table tbody').append('<tr><td colspan="9" class="text-center">Error fetching data...</td></tr>');
                    }
                });
            }

            // Load reports when the page is ready
            loadReports();
        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

