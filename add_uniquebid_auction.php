<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Unique Bid Auction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h2>Add Auction</h2>

    <!-- Item Selection Dropdown -->
    <div class="mb-3">
        <label for="itemSelect" class="form-label">Select Item</label>
        <select id="itemSelect" class="form-select">
            <option value="">Select an item</option>
            <?php
            include 'db.php';
            $query = mysqli_query($conn, "SELECT * FROM items");
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            ?>
        </select>
    </div>

    <!-- Add New Item Button -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">Add New Item</button>
</div>

<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Add New Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addItemForm">
                    <div class="mb-3">
                        <label for="itemName" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="itemName" name="item_name" required>
                    </div>
                    <button type="submit" class="btn btn-success">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $("#addItemForm").submit(function (e) {
        e.preventDefault(); // Prevent form submission
        
        $.ajax({
            url: "add_item.php",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                let data = JSON.parse(response);
                if (data.success) {
                    // Append new item to the dropdown
                    $("#itemSelect").append(`<option value="${data.id}">${data.name}</option>`);

                    // Reset form & close modal
                    $("#addItemForm")[0].reset();
                    $("#addItemModal").modal('hide');
                } else {
                    alert("Failed to add item!");
                }
            }
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
