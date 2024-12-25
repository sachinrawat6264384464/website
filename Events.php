<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body>
    <?php
    // Include database connection
    include('../_conn.php');

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $name = $_POST['event']; // Get event name
        $date = $_POST['date'];  // Get event date

        // Validate inputs to avoid null values
        if (empty($name) || empty($date)) {
            echo "<script>alert('Event name and date are required!');</script>";
        } else {
            // Insert the data into the events table
            $query = "INSERT INTO events (event_name, event_date) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $name, $date);

            if ($stmt->execute()) {
                echo "<script>alert('Event added successfully!');</script>";
            } else {
                echo "<script>alert('Error: Unable to add event. " . $stmt->error . "');</script>";
            }
        }
    }
    ?>









    <div>
        <?php include('../nav.php'); ?>
        <!-- <div class="mt-5 mb-2 d-flex mx-5 justify-content-center">
            <input type="text" name="event" id="event" placeholder="Enter Event" class="bg-transparent text-dark border-dark fs-5 ps-3" style="border-radius: 25px;" required>
            <input type="date" name="date" id="date" placeholder="Enter Date" class="bg-transparent text-dark border-dark fs-5 ps-3 ms-5" style="border-radius: 25px;" required>
            <button class="btn btn-primary fs-5 ms-5 px-5" name="submit" type="submit" style="border-radius: 25px;">Add</button>
        </div> -->
        
        <?php if (isset($_SESSION['user_email'])): ?>
            <form action="Events.php" method="POST">
                <div class="mt-5 mb-2 mx-5">
                    <div class="row gy-3">
                        <!-- Event Input -->
                        <div class="col-12 col-md-4">
                            <input 
                                type="text" 
                                name="event" 
                                id="event" 
                                placeholder="Enter Event" 
                                class="form-control bg-primary text-light border-dark fs-5 ps-3" 
                                style="border-radius: 25px;" 
                                required>
                        </div>
                        
                        <!-- Date Input -->
                        <div class="col-12 col-md-4">
                            <input 
                                type="date" 
                                name="date" 
                                id="date" 
                                class="form-control bg-primary text-light border-dark fs-5 px-3" 
                                style="border-radius: 25px;" 
                                required>
                        </div>
                        
                        <!-- Button -->
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <button 
                                class="btn btn-primary fs-5 px-5 w-100" 
                                name="submit" 
                                type="submit" 
                                style="border-radius: 25px;">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>

        <div class="my-5 mx-5">
            <table id="membersTable" class="table table-bordered table-striped table-hover border-dark">
                <thead>
                    <tr>
                        <th class ="bg-primary text-light">S.No.</th>
                        <th class ="bg-primary text-light">Event</th>
                        <th class ="bg-primary text-light">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Fetch all events from the database, ordered by date in descending order
                        $query = "SELECT * FROM events ORDER BY event_date DESC";
                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                                $formattedDate = date("d/m/Y", strtotime($row['event_date'])); // Convert to dd/mm/yyyy
                                echo "<tr>
                                    <td>" . $i++ . "</td> <!-- S.No. -->
                                    <td>" . htmlspecialchars($row['event_name']) . "</td> <!-- Event Name -->
                                    <td>" . htmlspecialchars($formattedDate) . "</td> <!-- Event Date -->
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No events found</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>

        // // Dynamically set default date in YYYY-MM-DD format
        // const dateInput = document.getElementById('date');
        // const today = new Date().toISOString().split('T')[0]; // Get current date in YYYY-MM-DD
        // dateInput.value = today; // Set default value

        // document.getElementById('date').addEventListener('change', function () {
        //     console.log(this.value); // Logs date as YYYY-MM-DD regardless of browser display
        // });

        $(document).ready(function () {
            $('#membersTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                // order: [[0, 'desc']],
            });
        });
    </script>
</body>
</html>
