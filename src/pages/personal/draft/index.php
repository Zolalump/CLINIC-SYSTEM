<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMCTI CLINIC</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="../../img/logo sa smc.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  />    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        #notificationBadge {
            position: absolute;
            top: -5px;  
            right: -5px; 
            background-color: red;
            color: white;
            font-size: 12px;
            font-weight: bold;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custom-notification {
            position: fixed;
            top: 20px;
            left: 40%;
            padding: 15px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
            z-index: 1000;
            width: 90%; 
            max-width: 300px; 
            text-align: center;
            }

        .custom-notification.success {
            background-color: #1E3A8A; 
        }

        .custom-notification.error {
            background-color: #f44336;
        }

        .fade-out {
            opacity: 0;
        }
    </style>
</head>
<body>
<nav class="bg-white fixed w-full z-20 top-0 start-0 border-b">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="../../img/logo.jpg" class="h-12" alt="Logo">
                <p style="color: rgb(4, 4, 155); font-size: larger; font-weight: bold; line-height: 1.2;">
                    SMCTI <br>
                    CLINIC
                </p>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
              <div class="flex items-center w-full justify-end pr-8">
                <div class="relative flex items-center space-x-4">
                <div class="relative">
                <button id="notificationButton" class="flex items-center justify-center w-10 h-10 bg-white rounded-full app-shadow">
                        <i class="fa-regular fa-bell app-color-black"></i>
                        <span id="notificationBadge" class="hidden bg-red-500 text-white text-xs rounded-full px-2 py-1 ml-1"></span>
                    </button>
                    <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg z-50">
                        <div class="p-4 border-b">
                            <p class="font-semibold text-sm">Notifications</p>
                        </div>
                        <div id="notificationList" class="py-2">
                            <p class="text-gray-500 px-4 py-2 text-sm">No new notifications</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                <button id="accountButton" class="flex bg-blue-900 px-6 py-4 app-shadow rounded-md cursor-pointer items-center" style="color: white;">
                    <span class="font-bold app-color-black text-xs">Account</span>
                    <div class="w-px app-bg-light-white-2 mx-4"></div>
                    <i class="fa-regular fa-user mr-2 app-color-black"></i>
                    <i id="accountArrow" class="fa-solid fa-angle-down text-xs app-color-black"></i>
                </button>
                    <div
                        id="accountDropdown"
                        class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg z-50"
                    >

                <div class="p-4 border-b">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                            <i class="fa-regular fa-user text-xl"></i>
                        </div>
                        <div>
                            <p id="user-name" class="font-semibold text-sm">Loading...</p>
                            <p class="text-xs text-gray-500">Admin ID: <span id="student_id_display">-</span></p>
                        </div>
                    </div>
                </div>
                    <div class="py-2">
                            <a href="/WebDa/CLINIC-SYSTEM-3/src/php/Settings/dashboard.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-chart-line mr-3"></i> Users
                            </a>
                            <a href=" /WebDa/CLINIC-SYSTEM-3/src/php/Settings/Profile.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-gear mr-3"></i> Settings
                            </a>
                            <div class="border-t mt-2">
                                <a
                                    href="/WebDa/CLINIC-SYSTEM-3/index.php"
                                    class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
                                >
                                    <i class="fa-solid fa-right-from-bracket mr-3"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" 
            id="navbar-sticky" 
            style="background-color: #13398C; padding: 7px; border-radius: 15px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); margin-left: 70px;">
           <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border rounded-lg md:space-x-8 rtl:space-x-reverse 
                      md:flex-row md:mt-0 md:border-0">
               <li>
                   <a href="../../php/dashboard.php" 
                      class="block py-2 px-4 text-white rounded-lg transition-all duration-300 hover:bg-white hover:text-blue-600 hover:shadow-md hover:scale-105">
                      Dashboard
                   </a>
               </li>
               <li>
                   <a href="../../pages/personal/index.php" 
                      class="block py-2 px-4 text-white rounded-lg transition-all duration-300 hover:bg-white hover:text-blue-600 hover:shadow-md hover:scale-105">
                      Student Info
                   </a>
               </li>
               <li>
                   <a href="../../pages/Stats/stats2.php" 
                      class="block py-2 px-4 text-white rounded-lg transition-all duration-300 hover:bg-white hover:text-blue-600 hover:shadow-md hover:scale-105">
                      Statistics
                   </a>
               </li>
               <li>
                   <a href="../../pages/History/logbook.php" 
                      class="block py-2 px-4 text-white rounded-lg transition-all duration-300 hover:bg-white hover:text-blue-600 hover:shadow-md hover:scale-105">
                      Log Book
                   </a>
               </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="https://via.placeholder.com/120" alt="Profile Picture">
            <h3 id="profile-name">Student, User</h3>
            <div class="menu">
                <a href="#"><i class='bx bx-user'></i> My Profile</a>
                <a href="#"><i class='bx bx-calendar'></i> Appointments</a>
                <a href="#"><i class='bx bx-capsule'></i> Medications</a>
                <a href="#" id="settings-btn"><i class='bx bx-cog'></i> Settings</a>
            </div>
        </div>

        
        <main>
            <div class="section">
                <div class="tabs">
                    <button class="tab active" data-target="walk-ins">Walk Ins</button>
                    <button class="tab" data-target="past">Past Appointments</button>
                    <button class="tab" data-target="records">Medical Records</button>
                </div>
                <div id="walk-ins" class="slider-content active">
                    <h3>Upcoming Walk-Ins</h3>
                    <button onclick="showAddWalkInPopup()"><i class='bx bx-plus'></i> Add Walk-In</button>
                    <table>
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="walk-ins-body">
                            <!-- Walk-ins will be added here -->
                        </tbody>
                    </table>
                </div>
                <div id="past" class="slider-content">
                    <h3>Past Appointments</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="past-body">
                            <!-- Past appointments will be added here -->
                        </tbody>
                    </table>
                </div>
                <div id="records" class="slider-content">
                    <h3>Medical Records</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="records-body">
                            <!-- Medical records will be added here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Right: Chief Complaints -->
            <div class="chief-complaints">
                <h4>Chief Complaints <button id="edit-complaints"><i class='bx bx-edit'></i> Edit</button></h4>
                <ul class="complaints-list">
                    <!-- Chief complaints will be added here -->
                </ul>
            </div>

            <!-- Bottom Left: Medications -->
            <div class="section">
                <h4>Medications <button id="edit-medications"><i class='bx bx-edit'></i> Edit</button></h4>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>Assigned by</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="medications-body">
                        <!-- Medications will be added here -->
                    </tbody>
                </table>
            </div>

            <!-- Bottom Right: Notes -->
            <div class="section">
                <h4>Notes</h4>
                <input type="text" id="title-input" placeholder="Title" style=" margin-top: 5px;"/>
                <textarea id="note-input" rows="4" placeholder="Type your note here..." style="width: 370px;"></textarea>
                <button id="add-note"><i class='bx bx-plus'></i> Add Note</button>
                <button id="view-notes"><i class='bx bx-note'></i> View Notes</button>
            </div>
        </main>
    </div>

    <!-- Popup for Adding Walk-Ins -->
    <div id="add-walkin-popup" class="overlay">
        <div class="popup-form">
            <span id="close-add-walkin" onclick="closeAddWalkInPopup()">&times;</span>
            <h4>Add Walk-In</h4>
            <form id="add-walkin-form">
                <input type="text" id="patient-name" placeholder="Patient Name" required>
                <input type="date" id="walkin-date" required>
                <input type="time" id="walkin-time" required>
                <select id="walkin-reason" required>
                    <option value="">Select Reason</option>
                    <option value="Other">Other (Specify)</option>
                </select>
                <input type="text" id="other-reason" placeholder="Specify Reason" style="display: none;">
                <select id="walkin-status" required>
                    <option value="Scheduled">Scheduled</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
                <button type="submit"><i class='bx bx-save'></i> Save</button>
            </form>
        </div>
    </div>

    <!-- Popup for Editing Medications -->
    <div id="medication-popup-overlay" class="overlay">
        <div class="popup-form">
            <span id="close-medication-popup">&times;</span>
            <h4>Edit Medication</h4>
            <div id="medication-form-content">
                <label for="med-name">Name:</label>
                <input type="text" id="med-name" placeholder="Medication Name" required>
                <label for="med-date">Start Date:</label>
                <input type="date" id="med-date" required>
                <label for="med-status">Status:</label>
                <select id="med-status" required>
                    <option value="Process">Process</option>
                    <option value="Complete">Complete</option>
                </select>
            </div>
            <button id="submit-medication">Submit</button>
        </div>
    </div>

    <!-- Popup for Editing Complaints -->
    <div id="complaint-popup-overlay" class="overlay">
        <div class="popup-form">
            <span id="close-complaint-popup">&times;</span>
            <h4>Edit Complaint</h4>
            <div id="complaint-form-content">
                <label for="complaint-name">Name:</label>
                <input type="text" id="complaint-name" placeholder="Complaint Name" required>
                <label for="complaint-severity">Severity:</label>
                <select id="complaint-severity" required>
                    <option value="Mild">Mild</option>
                    <option value="Moderate">Moderate</option>
                    <option value="Severe">Severe</option>
                </select>
            </div>
            <button id="submit-complaint">Submit</button>
        </div>
    </div>

    <!-- Popup for Notes -->
    <div id="notes-popup" class="overlay">
        <div class="popup-form notes-popup">
            <span id="close-notes-popup">&times;</span>
            <h4>Notes</h4>
            <div id="notes-list"></div>
            <div class="note-content" id="note-content">Select a note to view details</div>
            <div class="bottom-buttons">
                <button id="prev-note"><i class='bx bx-chevron-left'></i> Previous</button>
                <button id="next-note">Next <i class='bx bx-chevron-right'></i></button>
                <button id="delete-note"><i class='bx bx-trash'></i> Delete</button>
                <button id="restore-note"><i class='bx bx-undo'></i> Restore</button>
            </div>
        </div>
    </div>

    <!-- Popup for Settings -->
    <div id="settings-popup" class="overlay">
        <div class="popup-form">
            <span id="close-settings-popup">&times;</span>
            <h4>Settings</h4>
            <div class="settings-content">
                <label for="dark-mode-toggle">Dark Mode:</label>
                <label class="switch">
                    <input type="checkbox" id="dark-mode-toggle">
                    <span class="slider round"></span>
                </label>
                <label for="profile-name-input">Change Name:</label>
                <input type="text" id="profile-name-input" placeholder="Enter new name">
                <button id="save-profile-name"><i class='bx bx-save'></i> Save</button>
            </div>
        </div>
    </div>

    <!-- Popup for Walk-In Details -->
    <div id="detail-popup" class="overlay">
        <div class="popup-form">
            <span id="close-detail-popup">&times;</span>
            <h4>Walk-In Details</h4>
            <div class="detail-content">
                <p><strong>Patient Name:</strong> <span id="detail-patient-name"></span></p>
                <p><strong>Date:</strong> <span id="detail-date"></span></p>
                <p><strong>Time:</strong> <span id="detail-time"></span></p>
                <p><strong>Reason:</strong> <span id="detail-reason"></span></p>
                <p><strong>Status:</strong> <span id="detail-status"></span></p>
                <h5>Chief Complaints</h5>
                <ul id="detail-complaints"></ul>
                <h5>Medications</h5>
                <ul id="detail-medications"></ul>
                <h5>Notes</h5>
                <div id="detail-notes"></div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
          document.addEventListener("DOMContentLoaded", function () {
    const accountButton = document.getElementById("accountButton");
    const accountDropdown = document.getElementById("accountDropdown")

    if (accountButton) {
        accountButton.addEventListener("click", (e) => {
            e.stopPropagation();
            accountDropdown.classList.toggle("hidden");
            notificationDropdown.classList.add("hidden");
        });
    }

    document.addEventListener("click", () => {
        accountDropdown?.classList.add("hidden");
    });

        const tabs = document.querySelectorAll(".option-tab");
        const selects = {
        academic: document.getElementById("academic-select"),
        sports: document.getElementById("sports-select"),
        events: document.getElementById("events-select"),
    };

    let activeTab = "academic";

tabs.forEach((tab) => {
    tab.addEventListener("click", function () {
        tabs.forEach((t) => t.classList.remove("active"));
        this.classList.add("active");

        Object.values(selects).forEach((select) => (select.style.display = "none"));

        activeTab = this.textContent.toLowerCase();
        if (selects[activeTab]) {
            selects[activeTab].style.display = "block";
        }
    });
});

function showNotification(message, type = "success") {
    const notification = document.createElement("div");
    notification.className = `custom-notification ${type}`;
    notification.innerText = message;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.classList.add("fade-out");
        setTimeout(() => notification.remove(), 500);
    }, 3000);
}

const bookButton = document.querySelector(".book-now-btn");

if (bookButton) {
    bookButton.addEventListener("click", function () {
        let activeTab = document.querySelector(".option-tab.font-semibold")?.innerText.toLowerCase() || "academic";

        const facilityDropdown = document.querySelector(`select#${activeTab}-select`);
        const dateInput = document.getElementById("date-select");
        const timeSlotInput = document.getElementById("time-slot");
        const purposeInput = document.getElementById("purpose");
        const attendeesInput = document.getElementById("attendees");

        if (!facilityDropdown || !dateInput.value || !timeSlotInput.value || !purposeInput.value || isNaN(parseInt(attendeesInput.value))) {
            showNotification("Fill in all fields before CLINIC-SYSTEM-3.", "error");
            return;
        }

        const requestData = {
            facility: facilityDropdown.value,
            date: dateInput.value,
            timeSlot: timeSlotInput.options[timeSlotInput.selectedIndex].text.trim()
        };

        console.log("Checking availability...", requestData);

        fetch("/WebDa/CLINIC-SYSTEM-3/src/php/check_availability.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams(requestData).toString()
        })
        .then(response => response.json())
        .then(data => {
            console.log("Availability Response:", data);
            if (data.status === "error") {
                showNotification(data.message, "error");
                return Promise.reject("Facility already booked.");
            } else {
                return fetch("/WebDa/CLINIC-SYSTEM-3/src/php/book.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        facility: requestData.facility,
                        date: requestData.date,
                        timeSlot: requestData.timeSlot,
                        purpose: purposeInput.value.trim(),
                        attendees: parseInt(attendeesInput.value, 10),
                    })
                });
            }
        })
        .then(response => response ? response.json() : null)
        .then(data => {
            if (data && data.success) {
                showNotification("CLINIC-SYSTEM-3 successful!", "success");
            } else if (data) {
                showNotification(data.error || "Error occurred!", "error");
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
        });
    });
}


    });
    document.addEventListener("DOMContentLoaded", function () {
    const notificationButton = document.getElementById("notificationButton");
    const notificationDropdown = document.getElementById("notificationDropdown");
    const notificationBadge = document.getElementById("notificationBadge"); 
    const notificationList = document.getElementById("notificationList"); 

    function fetchNotifications() {
        fetch("/WebDa/CLINIC-SYSTEM-3/src/php/send-msg/get_messages.php")
            .then(response => {
                console.log("Response Status:", response.status);
                return response.json();
            })
            .then(data => {
                console.log("Fetched notifications data:", data); 

                if (!notificationBadge || !notificationList) {
                    console.error("Error: Notification elements not found in the DOM.");
                    return;
                }

                if (data.success && data.messages.length > 0) {
                    notificationBadge.textContent = data.messages.length;
                    notificationBadge.classList.remove("hidden");

                    notificationList.innerHTML = data.messages.map(msg => 
                        `<a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                            <strong>Admin:</strong> ${msg.message}
                            <small class="block text-gray-500">${msg.sent_at}</small>
                        </a>`
                    ).join("");
                } else {
                    notificationBadge.classList.add("hidden");
                    notificationList.innerHTML = `<p class="text-gray-500 px-4 py-2 text-sm">No new notifications</p>`;
                }
            })
            .catch(error => console.error("Error fetching notifications:", error));
            }

            if (notificationButton) {
                notificationButton.addEventListener("click", function (e) {
                    e.stopPropagation();
                    notificationDropdown.classList.toggle("hidden");
                    fetchNotifications();
                });
            }

            document.addEventListener("click", function (e) {
                if (!notificationDropdown.contains(e.target) && !notificationButton.contains(e.target)) {
                    notificationDropdown.classList.add("hidden");
                }
            });

            setInterval(fetchNotifications, 30000);
            fetchNotifications
        });

    document.querySelector("#notificationBadge").addEventListener("click", () => {
            fetch("/WebDa/CLINIC-SYSTEM-3/src/php/send-msg/mark_notif.php", { method: "POST" })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Notifications marked as read");
                        notificationBadge.classList.add("hidden"); 
                    } else {
                        console.error("Error marking notifications as read:", data.error);
                    }
                })
                .catch(error => console.error("Error:", error));
        });

        document.addEventListener("DOMContentLoaded", function () {
            fetch("/WebDa/CLINIC-SYSTEM-3/src/php/Settings/fetch_user.php")
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById("user-name").innerText = `${data.firstname} ${data.lastname}`;
                        
                        document.getElementById("student_id_display").innerText = data.student_id ? data.student_id : "Not Set";
                    }
                })
                .catch(error => console.error("Error fetching user data:", error));
        });
    </script>
    
</body>
</html>
