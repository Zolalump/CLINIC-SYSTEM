<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMCTI CLINIC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="./img/logo.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/WebDa/booking/reserve.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.mins"></script>
    <link rel="stylesheet" href="/WebDa/CLINIC-SYSTEM-3/font/Suisse/stylesheet.css">

    <style>

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

    </style>
</head>
<body class="bg-gray-100">

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
                            <a href=" Settings/Profile.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
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
                   <a href=".././php/dashboard.php" 
                      class="block py-2 px-4 text-white rounded-lg transition-all duration-300 hover:bg-white hover:text-blue-600 hover:shadow-md hover:scale-105">
                      Dashboard
                   </a>
               </li>
               <li>
                   <a href=".././pages/personal/index.php" 
                      class="block py-2 px-4 text-white rounded-lg transition-all duration-300 hover:bg-white hover:text-blue-600 hover:shadow-md hover:scale-105">
                      Student Info
                   </a>
               </li>
               <li>
                   <a href=".././pages/Stats/stats2.php" 
                      class="block py-2 px-4 text-white rounded-lg transition-all duration-300 hover:bg-white hover:text-blue-600 hover:shadow-md hover:scale-105">
                      Statistics
                   </a>
               </li>
               <li>
                   <a href=".././pages/History/logbook.php" 
                      class="block py-2 px-4 text-white rounded-lg transition-all duration-300 hover:bg-white hover:text-blue-600 hover:shadow-md hover:scale-105">
                      Log Book
                   </a>
               </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container2 mt-28">
        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-4 md:p-6 ">
          <div class="max-w-7xl mx-auto space-y-6">
            <div class="flex items-center justify-between">
              <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
              <div class="flex space-x-2">
              </div>
            </div>

            <!-- Metrics Overview Section -->
            <div class="w-full p-4 rounded-lg">
              <h2 class="text-lg font-semibold mb-4 text-gray-800">
                Clinic Brief Reports
              </h2>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Metric Card 1 -->
                <div class="bg-white rounded-lg shadow-lg">
                  <div
                    class="flex flex-row items-center justify-between p-4 pb-2"
                  >
                    <p class="text-sm font-medium text-gray-500">
                      Total Patients
                    </p>
                    <div
                      class="h-8 w-8 rounded-full bg-blue-100 p-1.5 text-blue-600 flex items-center justify-center"
                    >
                      <i class="fas fa-users"></i>
                    </div>
                  </div>
                  <div class="p-4 pt-0">
                    <div class="text-2xl font-bold">1,248</div>
                    <div class="flex items-center mt-1">
                      <span class="text-xs text-blue-800">↑ 12%</span>
                      <span class="text-xs text-gray-500 ml-1"
                        >All registered patients</span
                      >
                    </div>
                  </div>
                </div>

                <!-- Metric Card 2 -->
                <div class="bg-white rounded-lg shadow-lg">
                  <div
                    class="flex flex-row items-center justify-between p-4 pb-2"
                  >
                    <p class="text-sm font-medium text-gray-500">
                      Today's Walk-ins
                    </p>
                    <div
                      class="h-8 w-8 rounded-full bg-blue-100 p-1.5 text-blue-600 flex items-center justify-center"
                    >
                      <i class="fas fa-user-plus"></i>
                    </div>
                  </div>
                  <div class="p-4 pt-0">
                    <div class="text-2xl font-bold">42</div>
                    <div class="flex items-center mt-1">
                      <span class="text-xs text-blue-800">↑ 8%</span>
                      <span class="text-xs text-gray-500 ml-1"
                        >Unscheduled visits today</span
                      >
                    </div>
                  </div>
                </div>

                <!-- Metric Card 3 -->
                <div class="bg-white rounded-lg shadow-lg">
                  <div
                    class="flex flex-row items-center justify-between p-4 pb-2"
                  >
                    <p class="text-sm font-medium text-gray-500">
                      Daily Average
                    </p>
                    <div
                      class="h-8 w-8 rounded-full bg-blue-100 p-1.5 text-blue-600 flex items-center justify-center"
                    >
                      <i class="fas fa-chart-line"></i>
                    </div>
                  </div>
                  <div class="p-4 pt-0">
                    <div class="text-2xl font-bold">18.3</div>
                    <div class="flex items-center mt-1">
                      <span class="text-xs text-red-500">↓ 3%</span>
                      <span class="text-xs text-gray-500 ml-1"
                        >Patients per day</span
                      >
                    </div>
                  </div>
                </div>

                <!-- Metric Card 4 -->
                <div class="bg-white rounded-lg shadow-lg">
                  <div
                    class="flex flex-row items-center justify-between p-4 pb-2"
                  >
                    <p class="text-sm font-medium text-gray-500">
                      Monthly Visits
                    </p>
                    <div
                      class="h-8 w-8 rounded-full bg-blue-100 p-1.5 text-blue-600 flex items-center justify-center"
                    >
                      <i class="fas fa-calendar"></i>
                    </div>
                  </div>
                  <div class="p-4 pt-0">
                    <div class="text-2xl font-bold">356</div>
                    <div class="flex items-center mt-1">
                      <span class="text-xs text-blue-800">↑ 15%</span>
                      <span class="text-xs text-gray-500 ml-1"
                        >Total visits this month</span
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>

          

              <!-- Upcoming Appointments -->
              <div
                class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm mt-10"
              >
                <!-- Recent Entries Section -->
                <div class="mt-8">
                  <h2 class="text-xl font-semibold text-blue-900 mb-4">Recent Entries</h2>
                  <div class="overflow-x-auto">
                      <table class="min-w-full bg-white rounded-lg overflow-hidden">
                          <thead class="bg-blue-900 text-white">
                              <tr>
                                  <th class="py-3 px-4 text-left">Name</th>
                                  <th class="py-3 px-4 text-left">Department</th>
                                  <th class="py-3 px-4 text-left">Classification</th>
                                  <th class="py-3 px-4 text-left">Date & Time</th>
                                  <th class="py-3 px-4 text-left">Complaints</th>
                                  <th class="py-3 px-4 text-left">Intervention</th>
                              </tr>
                          </thead>
                          <tbody id="recentEntries">
                              <!-- Entries will be populated by JavaScript -->
                              <tr class="border-b">
                                  <td colspan="6" class="py-4 px-4 text-center text-gray-500">No recent entries</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>
            
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
            showNotification("Fill in all fields before booking.", "error");
            return;
        }

        const requestData = {
            facility: facilityDropdown.value,
            date: dateInput.value,
            timeSlot: timeSlotInput.options[timeSlotInput.selectedIndex].text.trim()
        };

        console.log("Checking availability...", requestData);

        fetch("/WebDa/booking/src/php/check_availability.php", {
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
                return fetch("/WebDa/booking/src/php/book.php", {
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
                showNotification("Booking successful!", "success");
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
        fetch("/WebDa/booking/src/php/send-msg/get_messages.php")
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
            fetch("/WebDa/booking/src/php/send-msg/mark_notif.php", { method: "POST" })
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
            fetch("/WebDa/booking/src/php/Settings/fetch_user.php")
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