<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMCTI CLINIC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="../../img/logo sa smc.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="logbook.css">
    <link rel="stylesheet" href="/WebDa/CLINIC-SYSTEM-3/font/Suisse/stylesheet.css" />
    <style>
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
                        <span id="notificationBadge" class="hidden bg-red-500 text-white text-xs opacity-75 animate-ping rounded-full px-2 py-1 ml-1"></span>
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
                   <a href="../../pages/personal/index2.php" 
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

    <!-- Main Content -->
    <main class="container mx-auto pt-24 px-4">
        <div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
            <h1 class="text-2xl font-bold text-blue-900 mb-6">Clinic Log Book</h1>
            
            <!-- Date and Time Display -->
            <div class="flex flex-wrap justify-between mb-6">
                <div class="bg-gray-100 p-3 rounded-lg mb-3 md:mb-0">
                    <p class="text-gray-700"><i class="far fa-calendar-alt mr-2"></i><span id="currentDate">Date: Loading...</span></p>
                </div>
                <div class="bg-gray-100 p-3 rounded-lg">
                    <p class="text-gray-700"><i class="far fa-clock mr-2"></i><span id="currentTime">Time: Loading...</span></p>
                </div>
            </div>

            <!-- Log Entry Form -->
<!-- Log Entry Form -->
<form id="logEntryForm" class="bg-gray-50 p-6 rounded-lg max-w-screen-xl mx-auto">
    <!-- Row 1: Student Name Search -->
    <div class="mb-6">
        <label for="studentName" class="block text-sm font-medium text-gray-700 mb-1">Student/Personnel Name</label>
        <div class="relative">
            <input type="text" id="studentName" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-900 focus:border-blue-900" placeholder="Search by name...">
            <div id="studentResults" class="hidden absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 max-h-48 overflow-y-auto"></div>
        </div>
    </div>

    <!-- Row 2: Department & Classification -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
            <div class="p-3 bg-gray-100 border border-gray-200 rounded-lg">
                <select id="department" class="w-full bg-gray-100 border-none focus:outline-none cursor-default" disabled>
                    <option value="">Department not selected</option>
                    <option value="basic-education">Basic Education Department</option>
                    <option value="tertiary">Tertiary Education Program</option>
                    <option value="personnel">Personnel</option>
                </select>
            </div>
        </div>

        <div>
            <label for="classification" class="block text-sm font-medium text-gray-700 mb-1">Classification</label>
            <div class="p-3 bg-gray-100 border border-gray-200 rounded-lg">
                <select id="classification" class="w-full bg-gray-100 border-none focus:outline-none cursor-default" disabled>
                    <option value="">Classification not selected</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Row 3: Additional Info -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Additional Info</label>
        <div class="p-3 bg-gray-100 border border-gray-200 rounded-lg">
            <p id="studentInfo">No student/personnel selected</p>
        </div>
    </div>

    <!-- Row 4: Complaints & Intervention (Side-by-side on landscape) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label for="complaints" class="block text-sm font-medium text-gray-700 mb-1">Complaints</label>
            <textarea id="complaints" rows="6" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-900 focus:border-blue-900"></textarea>
        </div>
        <div>
            <label for="intervention" class="block text-sm font-medium text-gray-700 mb-1">Intervention</label>
            <textarea id="intervention" rows="6" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-900 focus:border-blue-900"></textarea>
        </div>
    </div>

    <!-- Row 5: Action Buttons -->
    <div class="flex justify-end gap-3">
        <button type="button" id="clearButton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-lg">
            Clear
        </button>
        <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white font-medium py-2 px-4 rounded-lg">
            Save Entry
        </button>
    </div>
</form>

        </div>
    </main>

    <script src="logbook.js"></script>
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

    </script>
</body>
</html>