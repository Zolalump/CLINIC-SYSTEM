<?php
include 'db.php'; 

$sql_pending = "SELECT * FROM reservations WHERE status = 'pending'";
$result_pending = $conn->query($sql_pending);

$sql_history = "SELECT * FROM reservations ORDER BY created_at DESC";
$result_history = $conn->query($sql_history);

$sql_active = "SELECT id, user_id, facility, date, time_slot, purpose, attendees, created_at FROM reservations WHERE status = 'approved' ORDER BY date DESC";
$result_active = $conn->query($sql_active);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.mins"></script>
    <link rel="stylesheet" href="/WebDa/booking/font/Suisse/stylesheet.css">
    <style>
        #user-name span {
            display: block;
        }

        .table-container {
            overflow-x: auto;
            max-height: 300px; 
            overflow-y: auto;
        }

        table {
            min-width: 100%;
            border-collapse: collapse;
        }

        th, td {
            white-space: nowrap;
        }

    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
<header class="flex justify-between items-center bg-white text-black p-4 shadow-md">
    <div class="flex items-center space-x-3 ml-12">
        <img src="/WebDa/booking/img/logo.jpg" class="w-10">
        <h1 class="text-2xl font-semibold">Admin Panel</h1>
    </div>

    <div class="flex items-center space-x-6 mr-12">
        <div class="relative">
            <button id="accountButton" class="flex items-center bg-white px-6 py-3 shadow rounded-md cursor-pointer text-black">
                <span class="font-bold text-xs">Account</span>
                <div class="w-px bg-gray-300 mx-4"></div>
                <i class="fa-regular fa-user mr-2"></i>
                <i id="accountArrow" class="fa-solid fa-angle-down text-xs"></i>
            </button>
            <div id="accountDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg z-50">
                <div class="p-4 border-b">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                            <i class="fa-regular fa-user text-xl"></i>
                        </div>
                        <div class="text-xs">
                            <p id="user-name" class="font-semibold text-sm">Loading...</p>
                        </div>
                    </div>
                </div>
                <div class="py-2 text-xs text-gray-500">
                    <a href="/WebDa/booking/src/php/admin/Profile.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                        <i class="fa-solid fa-gear mr-3"></i> Settings
                    </a>
                    <div class="border-t mt-2">
                        <a href="/WebDa/booking/admin_reg.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                            <i class="fa-solid fa-right-from-bracket mr-3"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


    

    <main class="p-6 flex-grow" style="margin-left: 50px; margin-right: 50px;">
        <div class="p-4 bg-gray-100 rounded-lg w-80">
            <form id="messageForm" class="space-y-3">
                <label for="send_to_all" class="flex items-center space-x-2">
                    <input type="checkbox" id="send_to_all" class="w-4 h-4">
                    <span class="text-sm">Send to All Users</span>
                </label>

                <label for="user_id" class="text-sm font-medium">Select User:</label>
                    <select id="user_id" class="w-full p-1 text-sm border rounded-md focus:ring focus:ring-blue-300">
                </select>

                <label for="message" class="text-sm font-medium">Message:</label>
                <textarea id="message" class="w-full p-1 text-sm border rounded-md focus:ring focus:ring-blue-300 h-16"></textarea>

                <button type="submit" class="bg-blue-500 text-white text-xs py-1 px-2 rounded hover:bg-blue-600 transition">
                    Send Message
                </button>
            </form>
        </div>

        <section class="mb-8 mt-8">
            <h2 class="text-xl font-semibold text-blue-900 mb-4">Active Reservations</h2>
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg table-container">
                <table class="w-full table-auto text-left">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">User ID</th>
                            <th class="px-4 py-2">Facility</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Time</th>
                            <th class="px-4 py-2">Purpose</th>
                            <th class="px-4 py-2">Attendees</th>
                            <th class="px-4 py-2">Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_active->fetch_assoc()) { ?>
                            <tr class="border-t">
                                <td class="px-4 py-2"><?= $row['id'] ?></td>
                                <td class="px-4 py-2"><?= $row['user_id'] ?></td>
                                <td class="px-4 py-2"><?= $row['facility'] ?></td>
                                <td class="px-4 py-2"><?= $row['date'] ?></td>
                                <td class="px-4 py-2"><?= $row['time_slot'] ?></td>
                                <td class="px-4 py-2"><?= $row['purpose'] ?></td>
                                <td class="px-4 py-2"><?= $row['attendees'] ?></td>
                                <td class="px-4 py-2"><?= $row['created_at'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="mb-8 mt-8">
            <h2 class="text-xl font-semibold text-blue-900 mb-4">Pending Reservations</h2>
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg table-container">
                <table class="w-full table-auto text-left">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Facility</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Time Slot</th>
                            <th class="px-4 py-2">Purpose</th>
                            <th class="px-4 py-2">Attendees</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_pending->fetch_assoc()) { ?>
                            <tr class="border-t">
                                <td class="px-4 py-2"><?= $row['id'] ?></td>
                                <td class="px-4 py-2"><?= $row['facility'] ?></td>
                                <td class="px-4 py-2"><?= $row['date'] ?></td>
                                <td class="px-4 py-2"><?= $row['time_slot'] ?></td>
                                <td class="px-4 py-2"><?= $row['purpose'] ?></td>
                                <td class="px-4 py-2"><?= $row['attendees'] ?></td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <a href="approve.php?id=<?= $row['id'] ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition no-underline">Approve</a>
                                    <a href="cancel-book-admin.php?id=<?= $row['id'] ?>" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition no-underline">Disapprove</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section>
            <h2 class="text-xl font-semibold text-blue-900 mb-4">Booking History</h2>
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg table-container">
                <table class="w-full table-auto text-left ">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Facility</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Time Slot</th>
                            <th class="px-4 py-2">Purpose</th>
                            <th class="px-4 py-2">Attendees</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_history->fetch_assoc()) { ?>
                            <tr class="border-t">
                                <td class="px-4 py-2"><?= $row['id'] ?></td>
                                <td class="px-4 py-2"><?= $row['facility'] ?></td>
                                <td class="px-4 py-2"><?= $row['date'] ?></td>
                                <td class="px-4 py-2"><?= $row['time_slot'] ?></td>
                                <td class="px-4 py-2"><?= $row['purpose'] ?></td>
                                <td class="px-4 py-2"><?= $row['attendees'] ?></td>
                                <td class="px-4 py-2">
                                    <?php 
                                    if ($row['status'] == 'approved') {
                                        echo "<span class='bg-blue-900 text-white px-2 py-1 rounded'>Approved</span>";
                                    } elseif ($row['status'] == 'disapproved') {
                                        echo "<span class='bg-red-500 text-white px-2 py-1 rounded'>Disapproved</span>";
                                    } elseif ($row['status'] == 'canceled') {
                                        echo "<span class='bg-gray-500 text-white px-2 py-1 rounded'>Canceled</span>";
                                    } else {
                                        echo "<span class='bg-yellow-500 text-white px-2 py-1 rounded'>Pending</span>";
                                    }
                                    ?>
                                </td>
                                <td class="px-4 py-2"><?= $row['created_at'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>

       <!-- Table for deletion of users -->                             
        <section class="mt-8">
            <h2 class="text-xl font-semibold text-blue-900 mb-4">User List</h2>
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="w-full table-auto text-left">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="usersTable">

                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
    const notificationButton = document.getElementById("notificationButton");
    const notificationDropdown = document.getElementById("notificationDropdown");
    const accountButton = document.getElementById("accountButton");
    const accountDropdown = document.getElementById("accountDropdown")

    if (notificationButton) {
        notificationButton.addEventListener("click", (e) => {
            e.stopPropagation();
            notificationDropdown.classList.toggle("hidden");
            accountDropdown.classList.add("hidden");
        });
    }

    if (accountButton) {
        accountButton.addEventListener("click", (e) => {
            e.stopPropagation();
            accountDropdown.classList.toggle("hidden");
            notificationDropdown.classList.add("hidden");
        });
    }

    document.addEventListener("click", () => {
        notificationDropdown?.classList.add("hidden");
        accountDropdown?.classList.add("hidden");
    });

        const tabs = document.querySelectorAll(".option-tab");
        const selects = {
        academic: document.getElementById("academic-select"),
        sports: document.getElementById("sports-select"),
        events: document.getElementById("events-select"),
    };

    let activeTab = "academic";
        });

    document.getElementById("messageForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    const sendToAll = document.getElementById("send_to_all").checked;
    const user_id = document.getElementById("user_id").value;
    const message = document.getElementById("message").value;

    fetch("/WebDa/Booking/src/php/send-msg/send_message.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ 
            user_id: sendToAll ? null : user_id, 
            message, 
            send_to_all: sendToAll 
        })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message || data.error);
    })
    .catch(error => console.error("Error:", error));
    });

    document.getElementById("send_to_all").addEventListener("change", function() {
        document.getElementById("user_id").disabled = this.checked;
    });

    document.addEventListener("DOMContentLoaded", function () {
    const messageForm = document.getElementById("messageForm");
    if (!messageForm) {
        console.error("Error: #messageForm not found in the DOM!");
        return;
    }
}); 

    document.addEventListener("DOMContentLoaded", function () {
        const userSelect = document.getElementById("user_id");

        function fetchUsers() {
            fetch("/WebDa/booking/src/php/send-msg/get_user.php")
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.users.length > 0) {
                        userSelect.innerHTML = `<option value="">Select User</option>`; 
                        
                        data.users.forEach(user => {
                            let option = document.createElement("option");
                            option.value = user.id;
                            option.textContent = user.email; 
                            userSelect.appendChild(option);
                        });
                    } else {
                        userSelect.innerHTML = `<option value="">No users found</option>`;
                    }
                })
                .catch(error => console.error("Error fetching users:", error));
        }

        fetchUsers(); 
    });

    document.addEventListener("DOMContentLoaded", function () {
    const usersTableBody = document.querySelector("#usersTable");

    function fetchUsers() {
        fetch("/WebDa/booking/src/php/send-msg/get_user.php")
            .then(response => response.json())
            .then(data => {
                if (data.success && data.users.length > 0) {
                    usersTableBody.innerHTML = ""; 

                    data.users.forEach(user => {
                        let row = document.createElement("tr");
                        row.classList.add("border-t");

                        row.innerHTML = `
                            <td class="px-4 py-2">${user.id}</td>
                            <td class="px-4 py-2">${user.email}</td>
                            <td class="px-4 py-2">
                                <button class="delete-btn bg-red-500 text-white px-2 py-1 rounded" data-id="${user.id}">
                                    Delete
                                </button>
                            </td>
                        `;
                        usersTableBody.appendChild(row);
                    });

                    document.querySelectorAll(".delete-btn").forEach(button => {
                        button.addEventListener("click", function () {
                            let userId = this.getAttribute("data-id");
                            deleteUser(userId);
                        });
                    });
                } else {
                    usersTableBody.innerHTML = "<tr><td class='px-4 py-2' colspan='3'>No users found</td></tr>";
                }
            })
            .catch(error => console.error("Error fetching users:", error));
         }

    });

        // Deletion of users is yet to function.
        function deleteUser(userId) {
            if (!confirm("Are you sure you want to delete this user?")) return;

            fetch("/WebDa/booking/src/php/admin/delete_user.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: new URLSearchParams({ id: userId }) 
            })
            .then(response => response.json())
            .then(data => {
                console.log("Server response:", data); 
                if (data.success) {
                    alert(data.message);
                    fetchUsers(); 
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error deleting user:", error);
                alert("An error occurred. Check console for details.");
            });
        }
        document.addEventListener("DOMContentLoaded", function () {
            fetch("/WebDa/booking/src/php/admin/fetch_user.php")
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById("user-name").innerHTML = `<span>${data.firstname}</span> <span>${data.lastname}</span>`;
                    }
                })
                .catch(error => console.error("Error fetching user data:", error));
        });
    </script>


</body>
</html>
