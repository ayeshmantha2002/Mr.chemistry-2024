<?php
// Database connection
include("../../includes/connection.php");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
        // Edit existing video
        $id = $_POST['edit_id'];
        $title = $_POST['title'];
        $class = $_POST['class'];
        $video_link = $_POST['video_link'];
        $notes = "";

        if ($_FILES['notes']['name']) {
            $target_dir = "../../download/documents/";
            $target_file = $target_dir . basename($_FILES["notes"]["name"]);
            if (move_uploaded_file($_FILES["notes"]["tmp_name"], $target_file)) {
                $notes = basename($_FILES["notes"]["name"]);
            }
        } else {
            $notes = $_POST['existing_notes'];
        }

        $stmt = $connection->prepare("UPDATE `recordings` SET Title = ?, Video = ?, Note = ?, Class = ? WHERE ID = ?");
        $stmt->bind_param("ssssi", $title, $video_link, $notes, $class, $id);
    } else {
        // Insert new video
        $title = $_POST['title'];
        $class = $_POST['class'];
        $video_link = $_POST['video_link'];
        $notes = "";

        if ($_FILES['notes']['name']) {
            $target_dir = "../../download/documents/";
            $target_file = $target_dir . basename($_FILES["notes"]["name"]);
            if (move_uploaded_file($_FILES["notes"]["tmp_name"], $target_file)) {
                $notes = basename($_FILES["notes"]["name"]);
            }
        }

        $status = 1; // Assuming status is a constant value
        $stmt = $connection->prepare("INSERT INTO `recordings` (`Title`, `Video`, `Class`, `Note`, `Status`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $title, $video_link, $class, $notes, $status);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Record successfully saved.'); window.location.href='video-note.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

// Handle delete
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    // Get the notes file name to delete
    $stmt = $connection->prepare("SELECT Note FROM `recordings` WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($notes);
    $stmt->fetch();
    $stmt->close();

    // Delete the record
    $stmt = $connection->prepare("DELETE FROM `recordings` WHERE ID = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Delete the associated file
        if ($notes && file_exists("../../download/documents/" . $notes)) {
            unlink("../../download/documents/" . $notes);
        }
        echo "<script>alert('Record successfully deleted.'); window.location.href='video-note.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

// Fetch uploaded videos
$sql = "SELECT * FROM `recordings`";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Upload</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
        }

        h1,
        h2 {
            color: #4CAF50;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="url"],
        form input[type="file"],
        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            background: #fff;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        ul li strong {
            display: block;
            margin-bottom: 5px;
        }

        ul li a {
            color: #4CAF50;
            text-decoration: none;
            word-break: break-word;
            /* Ensure long URLs break properly */
        }

        ul li button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        ul li button:hover {
            background-color: #45a049;
        }

        ul li button.delete {
            background-color: #f44336;
        }

        ul li button.delete:hover {
            background-color: #e53935;
        }

        /* Media Queries for Mobile Responsiveness */
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 10px;
            }

            form {
                padding: 15px;
            }

            form input[type="text"],
            form input[type="number"],
            form input[type="url"],
            form input[type="file"],
            form input[type="submit"] {
                padding: 8px;
                margin-bottom: 10px;
            }

            ul li {
                padding: 10px;
            }

            ul li button {
                padding: 8px 10px;
            }
        }
    </style>
</head>

<body>
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a href="../admin.php" onclick='loadinEffect()'> <i class="fa-solid fa-angle-left"></i> </a>
                    <h2> Video / Notes </h2>
                </nav>
            </header>
            <br><br><br><br>
            <div class="container">
                <h3 style="text-align: center;"> Recordings Video & Notes </h3>
                <br>
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id" name="edit_id">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required><br><br>

                    <label for="class">Class:</label>
                    <input type="number" id="class" name="class" min="2023" required><br><br>

                    <label for="video_link">Video Link:</label>
                    <input type="url" id="video_link" name="video_link" required><br><br>

                    <label for="notes">Notes:</label>
                    <input type="file" id="notes" name="notes"><br><br>
                    <input type="hidden" id="existing_notes" name="existing_notes">

                    <input type="submit" value="Save">
                </form>

                <h2>Uploaded Videos</h2>
                <ul>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<li>";
                            echo "<strong>Title:</strong> " . $row["Title"] . "<br>";
                            echo "<strong>Video Link:</strong> <a href='" . $row["Video"] . "' target='_blank'>" . $row["Video"] . "</a><br>";
                            echo "<strong>Notes:</strong> <a href='../../download/documents/" . $row["Note"] . "' target='_blank'>" . $row["Note"] . "</a><br>";
                            echo "<button onclick='editVideo(" . $row["ID"] . ", \"" . $row["Title"] . "\", \"" . $row["Video"] . "\", \"" . $row["Note"] . "\", \"" . $row["Class"] . "\")'>Edit</button>";
                            echo "<button class='delete' onclick='deleteVideo(" . $row["ID"] . ")'>Delete</button>";
                            echo "</li><br>";
                        }
                    } else {
                        echo "No videos found.";
                    }

                    $connection->close();
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- loader image -->
    <div class="loading" id="loader">
        <img src="../../assect/img/icon/New-file.gif" alt="loading">
    </div>
    <script>
        function loadinEffect() {
            document.getElementById('loader').style.display = "flex";
        }
    </script>
    <script>
        function editVideo(id, title, video_link, notes, className) {
            document.getElementById('edit_id').value = id;
            document.getElementById('title').value = title;
            document.getElementById('video_link').value = video_link;
            document.getElementById('existing_notes').value = notes;
            document.getElementById('class').value = className;
        }

        function deleteVideo(id) {
            if (confirm("Are you sure you want to delete this video?")) {
                window.location.href = "video-note.php?delete_id=" + id;
            }
        }
    </script>
</body>

</html>