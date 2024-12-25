const express = require("express");
const fs = require("fs");
const path = require("path");

const app = express();
const PORT = 3000;

// Define the path to the visitors.json file in XAMPP's htdocs folder
const filePath = "C:/xampp/htdocs/mp_ajjaks/visitors.json";

// Middleware to serve static files like HTML, CSS, etc.
app.use(express.static("public"));

// Get visitor count from visitors.json and increment it
app.get("/visits", (req, res) => {
    let visitors = { count: 0 };

    // Check if the file exists
    if (fs.existsSync(filePath)) {
        visitors = JSON.parse(fs.readFileSync(filePath, "utf8"));
    }

    // Increment visitor count
    visitors.count += 1;

    // Save updated count back to the file
    fs.writeFileSync(filePath, JSON.stringify(visitors, null, 2));

    // Send the updated visitor count
    res.json(visitors);
});

// Start the server
app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});
