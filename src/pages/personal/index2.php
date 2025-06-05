<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMCTI Clinic</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="info.css">
    <link rel="stylesheet" href="complaint.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="/WebDa/CLINIC-SYSTEM-3/font/Suisse/stylesheet.css" />
    <style>
        .complaints-list {
            max-height: 300px; /* Adjust height as needed */
            overflow-y: auto;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; visibility: hidden; }
        }

        
        .container2 {
            background: white;
            width: 95vw;
            height: 100vh;
            border-radius: 10px;
            transform: scale(0.90);
            transform-origin: top center;
            position: relative;
        }

        
        body {
            font-family: 'Suisse', sans-serif;
            font-weight: 400 !important;
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

        .search-section {
            left: -30px;
        }

        .chief-complaints {
        height: 50vh;
        display: flex;
        flex-direction: column;
        }

        .complaints-list {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        }

        .complaints-content {
        flex: 1;
        overflow-y: auto;
        padding: 8px;
        margin-top: 0.5rem;
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
                                <i class="fa-solid fa-chart-line mr-3"></i> Logbook Dashboard
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
            
        <main class="main-content mt-24">
            <div class="search-section mb-5">
                <div class="search-bar">
                    <input type="text" placeholder="Search students by ID Number..." id="searchInput">
                    <button id="searchBtn"><i class="fas fa-search"></i></button>
                </div>
                <div class="search-results" id="searchResults" style="display: none;"></div>
            </div>

            <div id="dashboard" class="tab-content">
                <div class="dashboard-content">
                    <h2>Dashboard</h2>
                    <p>Dashboard content will be displayed here.</p>
                </div>
            </div>
            <div id="student" class="tab-content active">
                <div class="student-layout">
                    <div class="student-profile" id="studentProfile">
                        <div class="profile-header">
                            <div class="profile-image">
                                <i class="fas fa-user"></i>
                                <button class="edit-profile-btn" title="Edit Profile" data-edit="profile">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
                            <h3 id="student-name">Student, User</h3>
                            <p id="student-email">studentuser@gmail.com</p>
                        </div>
                        <div class="student-details">
                            <div class="detail-row"><span class="label">Course and Year</span><span class="value" id="student-course">Computer Science - 4th Year</span></div>
                            <div class="detail-row"><span class="label">ID number</span><span class="value" id="student-id">2020-12345</span></div>
                            <div class="detail-row"><span class="label">Gender</span><span class="value" id="student-gender">Female</span></div>
                            <div class="detail-row"><span class="label">Birthdate</span><span class="value" id="student-birthdate">Oct 25, 1992</span></div>
                            <div class="detail-row"><span class="label">Phone number</span><span class="value" id="student-phone">0912-345-6789</span></div>
                            <div class="detail-row"><span class="label">Address</span><span class="value" id="student-address">123 Main St., City</span></div>
                            <div class="detail-row"><span class="label">BP</span><span class="value" id="student-bp">120/80 mmHg</span></div>
                            <div class="detail-row"><span class="label">Weight</span><span class="value" id="student-weight">65 kg</span></div>
                            <div class="detail-row"><span class="label">Temp</span><span class="value" id="student-temp">36.5°C</span></div>
                        </div>
                    </div>
                    <div class="student-main">
                        <div class="student-tabs-and-edit">
                            <div class="student-tabs">
                                <button class="student-tab active" data-student-tab="records">Records</button>
                                <button class="student-tab" data-student-tab="medical-records">Medical Records</button>
                            </div>
                            <button class="edit-btn" id="editRecordsBtn" data-edit="records">
                                <i class="fas fa-pen"></i> Edit Records
                            </button>
                        </div>
                        <div id="records" class="student-tab-content active">
                            <div class="records-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Assigned Nurse</th>
                                            <th>Date</th>
                                            <th>Disease</th>
                                        </tr>
                                    </thead>
                                    <tbody id="recordsTableBody">
                                        <tr><td colspan="4" style="text-align:center; color:#aaa; font-style:italic;">No records yet</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="medications-section">
                                <div class="section-header">
                                    <h3><i class="fas fa-pills"></i> Medications</h3>
                                </div>
                                <div class="medications-table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Medicine Name</th>
                                                <th>Dosage</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="medicationsTableBody">
                                            <tr><td colspan="3" style="text-align:center; color:#aaa; font-style:italic;">No medications yet</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="medical-records" class="student-tab-content">
                            <p>Medical records content will be displayed here.</p>
                        </div>
                    </div>
                    <div class="right-sidebar">
                        <div class="chief-complaints">
                        <div class="section-header">
                            <h3><i class="fas fa-stethoscope"></i> Chief Complaints</h3>
                            <button class="edit-btn" data-edit="complaints">
                            <i class="fas fa-pen"></i> Edit
                            </button>
                        </div>
                        <div class="complaints-list" id="complaintsList">
                            <div class="complaints-empty" id="complaintsEmpty">
                            <i class="fas fa-clipboard-list"></i>
                            <div>No complaints yet</div>
                            </div>
                            <div class="complaints-content" id="complaintsContent" style="display: none;">
                            <div id="complaints-container"></div>
                            </div>
                        </div>
                        </div>

                <!-- Trigger Button -->
                <button id="openNotesModalBtn"
                class="bg-indigo-600 hover:bg-indigo-700 text-white text-xl font-bold px-8 py-5 rounded-2xl shadow-lg transition-all duration-300 flex items-center gap-3 w-full max-w-md mx-auto">
                <i class="fas fa-sticky-note text-1xl"></i>
                <span>Manage Notes</span>
                </button>

                <!-- Notes Modal -->
                <div id="notesModal" class="fixed inset-0 z-50 hidden bg-black/50 flex items-center justify-center">
                <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md space-y-4">
                    <h2 class="text-xl font-semibold text-indigo-700 flex items-center gap-2">
                    <i class="fas fa-sticky-note"></i> Notes
                    </h2>

                    <!-- Tabs -->
                    <div class="flex gap-2">
                    <button id="tabAddNote" class="w-full py-2 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 rounded-md">➕ Add Note</button>
                    <button id="tabViewNotes" class="w-full py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md">📄 View Notes</button>
                    </div>

                    <!-- Add Note -->
                    <div id="addNoteSection" class="space-y-3">
                    <textarea id="notesInput" class="w-full h-28 border rounded-md p-2 resize-none" placeholder="Write your note..."></textarea>
                    <div class="flex justify-end gap-2">
                        <button id="cancelNotesBtn" class="text-gray-600 hover:text-gray-800 px-4 py-1">Cancel</button>
                        <button id="saveNotesBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-1 rounded-md">Save</button>
                    </div>
                    </div>

                    <!-- View Notes -->
                    <div id="viewNotesSection" class="hidden">
                    <ul id="notesList" class="max-h-64 overflow-y-auto space-y-2">
                        <!-- Notes will be listed here -->
                    </ul>
                    <div class="flex justify-end">
                        <button id="closeNotesBtn" class="text-gray-500 hover:text-gray-700 px-4 py-1">Close</button>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Delete Confirmation Modal for Notes -->
                <div id="deleteModal" class="fixed inset-0 z-50 hidden bg-black/40 backdrop-blur-sm flex items-center justify-center transition-all">
                <div class="bg-white p-6 rounded-xl shadow-xl w-[95%] max-w-sm animate-fadeIn">
                    <h3 class="text-xl font-semibold text-red-600 flex items-center gap-2 mb-2">
                    <i data-lucide="alert-triangle" class="w-5 h-5"></i> Confirm Deletion
                    </h3>
                    <p class="text-gray-600 text-sm mb-4">
                    Are you sure you want to delete this note?
                    </p>
                    <div class="flex justify-end gap-3">
                    <button id="cancelDeleteBtn" type="button" class="cancel-btn px-4 py-2 text-gray-600 hover:text-gray-900">Cancel</button>
                    <button id="confirmDeleteBtn" type="button" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">Yes, Delete</button>
                    </div>
                </div>
                </div>

            <!-- Enhanced Modal Structure -->
            <div id="editModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 id="modalTitle">Edit</h3>
                        <span class="close">&times;</span>
                    </div>
                    <div class="modal-body" id="modalBody">
                        <!-- Dynamic content will be inserted here -->
                    </div>
                    <div class="modal-footer">
                        <button class="btn-cancel" id="cancelBtn">Cancel</button>
                        <button class="btn-save" id="saveBtn">Save Changes</button>
                    </div>
                </div>
            </div>

            <!-- Success/Error Notification -->
            <div id="notification" class="notification">
                <div class="notification-content">
                    <i class="notification-icon"></i>
                    <span class="notification-message"></span>
                </div>
            </div>

        </main>

        <!-- Edit Profile Modal -->
        <div class="modal-overlay hidden" id="edit-modal">
        <div class="modal">
            <h2>Edit Student Profile</h2>
                <form id="edit-form">
                <input type="hidden" name="user_id" value="<!--?php echo $user_id; ?-->"> <!-- If available via PHP -->
                
                <div class="modal-grid">
                    <div class="modal-field"><label>Name: <input type="text" name="name" id="edit-name" /></label></div>
                    <div class="modal-field"><label>Email: <input type="email" name="email" id="edit-email" /></label></div>
                    <div class="modal-field"><label>Course and Year: <input type="text" name="course" id="edit-student-course" /></label></div>
                    <div class="modal-field"><label>ID Number: <input type="text" name="id_number" id="edit-student-id" /></label></div>
                    <div class="modal-field"><label>Gender: <input type="text" name="gender" id="edit-student-gender" /></label></div>
                    <div class="modal-field"><label>Birthdate: <input type="date" name="birthdate" id="edit-student-birthdate" /></label></div>
                    <div class="modal-field"><label>Phone: <input type="text" name="phone" id="edit-student-phone" /></label></div>
                    <div class="modal-field"><label>Address: <input type="text" name="address" id="edit-student-address" /></label></div>
                    <div class="modal-field"><label>BP: <input type="text" name="blood_pressure" id="edit-student-bp" /></label></div>
                    <div class="modal-field"><label>Weight: <input type="text" name="weight" id="edit-student-weight" /></label></div>
                    <div class="modal-field"><label>Temp: <input type="text" name="temperature" id="edit-student-temp" /></label></div>
                </div>
                
                <div class="modal-actions">
                    <button type="submit" class="save-btn">Save Changes</button>
                    <button type="button" class="cancel-btn">Cancel</button>
                </div>
                </form>
        </div>
        </div>

        <!-- Complaint Modal -->
        <div id="complaintModalOverlay" class="modal-overlay hidden">
        <div class="modal complaint-modal">
            <h2>Edit Chief Complaints</h2>
            <form id="complaintForm" class="complaint-form">
            <div class="form-row">
                <label for="nurse">Assigned Nurse</label>
                <input type="text" id="nurse" name="nurse" placeholder="Enter nurse name" autocomplete="off" />
            </div>

            <div class="form-row">
                <label for="complaint-date">Date</label>
                <input type="date" id="complaint-date" name="complaint-date" />
            </div>

            <div class="form-row">
                <label for="disease">Disease / Condition</label>
                <input type="text" id="disease" name="disease" placeholder="Enter disease or condition" autocomplete="off" />
            </div>

            <div class="form-row">
                <label for="severity">Severity</label>
                <select id="severity" name="severity">
                <option value="" disabled selected>Select severity</option>
                <option value="mild">Mild</option>
                <option value="severe">Severe</option>
                </select>
            </div>

            <div class="form-row">
                <label for="medicine-name">Medicine Name</label>
                <input type="text" id="medicine-name" name="medicine-name" placeholder="Enter medicine name" autocomplete="off" />
            </div>

            <div class="form-row">
                <label for="dosage">Dosage</label>
                <input type="text" id="dosage" name="dosage" placeholder="e.g., 2 pills daily" autocomplete="off" />
            </div>

            <div class="form-row form-actions">
                <button type="button" id="addComplaintBtn" class="btn btn-primary">Add Complaint</button>
                <button type="submit" class="btn btn-success">Save Changes</button>
                <button type="button" class="btn btn-cancel cancel-btn">Cancel</button>
            </div>

            <ul id="complaintList" class="complaint-list"></ul>
            </form>
        </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 z-50 hidden bg-black/40 backdrop-blur-sm flex items-center justify-center transition-all">
        <div class="bg-white p-6 rounded-xl shadow-xl w-[95%] max-w-sm animate-fadeIn">
            <h3 class="text-xl font-semibold text-red-600 flex items-center gap-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01" />
            </svg>
            Confirm Deletion
            </h3>
            <p class="text-gray-600 text-sm mb-4">
            Are you sure you want to delete this complaint?
            </p>
            <div class="flex justify-end gap-3">
            <button id="deleteCancelBtn" type="button" class="cancel-btn px-4 py-2 text-gray-600 hover:text-gray-900 rounded-md">Cancel</button>
            <button id="deleteConfirmBtn" type="button" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">Yes, Delete</button>
            </div>
        </div>
        </div>

        <!-- Toast Message -->
        <div id="toast" class="fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-lg shadow-lg hidden transition duration-300 z-50">
             <span id="toast-message">Profile saved successfully!</span>
        </div>

        <input type="hidden" id="studentIdNumber" value="<?= htmlspecialchars($student['id_number']) ?>">

    </div>

    <script>
    window.loggedInUserIdNumber = "<?= htmlspecialchars($student['id_number']) ?>";
    </script>

    <script src="info.js"></script>
    <script src="complaint.js"></script>
    <script src="note.js"></script>
    
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

        document.getElementById("edit-form").addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('save_profile.php', {
            method: 'POST',
            body: formData
            })
            .then(res => res.json())
            .then(data => {
            if (data.success) {
                showToast('✅ Profile saved successfully!', 'success');
                document.getElementById("edit-modal").classList.add("hidden");
            } else {
                showToast('⚠️ Failed to save profile: ' + data.error, 'error');
            }
            })
            .catch(err => {
            showToast('❌ An error occurred: ' + err.message, 'error');
            });
        });

        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastMsg = document.getElementById('toast-message');
            
            toastMsg.textContent = message;
            toast.className = `fixed bottom-6 right-6 px-6 py-4 rounded-lg shadow-lg z-50 transition duration-300 ${
                type === 'success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'
            }`;

            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
            }
    </script>
</body>
</html>