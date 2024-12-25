!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members</title>
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
        $name = $_POST['name'];
        $position = $_POST['position'];
        $district = $_POST['district'];
        $phone_no = $_POST['phn'];

        // Insert the data into the members table
        $query = "INSERT INTO new_members (name, position, district, phone_no) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $name, $position, $district, $phone_no);

        if ($stmt->execute()) {
            echo "<script>alert('Member added successfully!');</script>";
        } else {
            echo "<script>alert('Error: Unable to add member.');</script>";
        }
    }
    ?>
    <div>
        <?php include('../nav.php'); ?>
        <?php if (isset($_SESSION['user_email'])): ?>
            <form action="new_members.php" method="POST">
                <div class="container mt-5 mb-2">
                    <div class="d-flex flex-wrap gap-3">
                        <!-- Name Input -->
                        <div class="flex-fill text-dark">Enter_Name:
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                placeholder="" 
                                class="form-control bg-primary text-light border-dark fs-6 py-2 ps-2" 
                                style="border-radius: 25px;" 
                                required>
                        </div>
                        <!-- Position Input -->
                        <div class="flex-fill text-dark">Enter_Position
                            <input 
                                type="text" 
                                name="position" 
                                id="position" 
                                placeholder="" 
                                class="form-control bg-primary text-light border-dark fs-6 py-2 ps-2" 
                                style="border-radius: 25px;" 
                                required>
                        </div>
                        <!-- District Input -->
                        <div class="flex-fill text-dark">Enter_District
                            <input 
                                type="text" 
                                name="district" 
                                id="district" 
                                placeholder="" 
                                class="form-control  text-dark border-dark fs-6 py-2 ps-2" 
                                style="border-radius: 25px; background-color: darkgray;" 
                                required>
                        </div>
                        <!-- Phone Number Input -->
                        <div class="flex-fill text-dark ml-3px"> Enter_Phone _No
                            <input 
                                type="tel" 
                                name="phn" 
                                id="phn" 
                                placeholder="" 
                                class="form-control  text-dark border-dark fs-6 py-2 ps-2" 
                                style="border-radius: 25px; background-color: darkgray;" 
                                required>
                        </div>
                        <!-- Submit Button -->
                        <div>
                            <button 
                                class="btn btn-primary fs-6 py-2 px-4" 
                                name="submit" 
                                type="submit" 
                                style="border-radius: 5px; ">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
        <div class="container my-5">
        <div class="mb-3">
    <select id="districtFilter" class="form-select text-dark" style="width: 200px; border-radius:10px; background-color:darkgray;">
        <option value="">Filter by District</option>
        <?php
        // Fetch unique districts
        $districts = $conn->query("SELECT DISTINCT district FROM new_members");
        while ($district = $districts->fetch_assoc()) {
            echo "<option value='" . htmlspecialchars($district['district']) . "'>" . htmlspecialchars($district['district']) . "</option>";
        }
        ?>
    </select>
</div>

<table id="new_membersTable" class="table table-bordered table-striped table-hover border-dark" >
    <thead>
        <tr>
            <th class ="bg-primary text-light">S.No.</th>
            <th class ="bg-primary text-light">Name</th>
            <th class ="bg-primary text-light">Position</th>
            <th class ="bg-primary text-light">District</th>
            <th class ="bg-primary text-light">Phone No.</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch all members
        $query = "SELECT * FROM new_members";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $i = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $i++ . "</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['position']) . "</td>
                    <td>" . htmlspecialchars($row['district']) . "</td>
                    <td>" . htmlspecialchars($row['phone_no']) . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>No members found</td></tr>";
        }
        ?>
    </tbody>
</table>

<script class = "bg-primary">
    $(document).ready(function () {
        var table = $('#new_membersTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            responsive: true,
        });

        // Filter table based on district selection
        $('#districtFilter').on('change', function () {
            var selectedDistrict = $(this).val(); // Get selected district value
            table.column(3) // Filter on the district column (index 3)
                .search(selectedDistrict)
                .draw(); // Redraw the table
        });
    });
</script>

          
</body>
</html>