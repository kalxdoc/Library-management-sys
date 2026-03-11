<?php
// public/admin_dashboard.php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - LMS</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Admin Dashboard</h1>
            <div class="user-info">
                Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> | 
                <a href="logout.php">Logout</a>
            </div>
        </header>

        <section class="book-management">
            <h2>Book Management</h2>
            
            <form id="bookForm" class="horizontal-form">
                <input type="hidden" id="bookId" name="id">
                <input type="text" id="title" placeholder="Book Title" required>
                <input type="text" id="author" placeholder="Author" required>
                <input type="text" id="isbn" placeholder="ISBN" required>
                <input type="text" id="category" placeholder="Category">
                <input type="number" id="quantity" placeholder="Qty" min="1" required>
                <button type="submit" id="submitBtn">Add Book</button>
                <button type="button" id="cancelBtn" style="display:none;">Cancel</button>
            </form>

            <table id="booksTable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Category</th>
                        <th>Qty</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="booksBody">
                    <!-- Data loaded via JS -->
                </tbody>
            </table>
        </section>
    </div>

    <script src="assets/js/admin.js"></script>
</body>
</html>
