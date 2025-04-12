<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMCTI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/WebDa/booking/reserve.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="/WebDa/booking/src/output.css">
    <link rel="stylesheet" href="/WebDa/booking/font/Suisse/stylesheet.css">
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
    <div class="app-container flex justify-center items-end">
    <img 
        class="absolute z-0 bg-no-repeat w-full h-full
           hidden sm:block sm:object-fill sm:h-[100vh] 
           hidden md:block md:object-cover md:h-[100vh] 
           lg:object-cover lg:h-[100vh]"
        src="/WebDa/booking/img/volley.jpg" 
        alt="image1" 
        style="object-fit: fill; opacity: 0.9;">
        <div class="circle rounded-full"></div>
        <div class="absolute top-11 flex flex-col w-full items-center px-4 md:px-0">
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
                <button id="accountButton" class="flex bg-white px-6 py-4 app-shadow rounded-md cursor-pointer items-center">
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
                            <p class="text-xs text-gray-500">Student ID: <span id="student_id_display">-</span></p>
                        </div>
                    </div>
                </div>


                    <div class="py-2">
                            <a href="/WebDa/booking/src/php/Settings/dashboard.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-chart-line mr-3"></i> Dashboard
                            </a>
                            <a href="/WebDa/booking/src/php/Settings/approve_books.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-calendar-xmark mr-3"></i> Unavailable Facilities
                            </a>
                            <a href=" Settings/Profile.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                <i class="fa-solid fa-gear mr-3"></i> Settings
                            </a>
                            <div class="border-t mt-2">
                                <a
                                    href="/WebDa/booking/index.php"
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
            <div class="position-absolute">
                <img src="/WebDa/booking/img/logo.jpg" alt="SMCTI Logo" class="w-24 h-24">
            </div>
            <div class="flex flex-col text-center my-8">
                <span class="font-semibold text-2xl sm:text-4xl mb-4 app-title" style="color: white;">Which facility would you like to reserve?</span>
                <span class="app-color-black font-semibold text-sm sm:text-base" style="color: white;">Book your school facilities here!</span>
            </div>
            <div class=" sm:w-11/12 md:w-10/12 px-4 sm:px-6 pt-8 sm:pt-10 pb-12 sm:pb-16 app-shadow rounded-xl backdrop-blur-[200px]">
            <div class="flex flex-wrap sm:flex-nowrap pr-0 sm:pr-6 rounded-lg">
                    <div style="color: white;" class="flex justify-between items-center w-full">
                        <div class="ml-4 flex space-x-5 sm:space-x-8 bg-gray-100 p-3 rounded-xl ">
                            <a href="./reserve.php" class="option-tab font-semibold text-sm app-color-gray">Academic</a>
                            <a href="sports.php" class="option-tab font-semibold text-sm app-color-gray">Sports</a>
                            <a href="./events.php" class="option-tab font-semibold text-sm app-color-gray">Events</a>
                        </div>
                        <div id="academic-select" style="display: none;"></div>
                        <div id="sports-select" style="display: none;"></div>
                        <div id="events-select" style="display: none;"></div>
                        <div class="flex items-center space-x-6">
                            <button style="background-color: white; color: blue;" class="book-now-btn px-6 py-2 rounded-md font-semibold text-sm; color: white;">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row mt-8 sm:mt-16 space-y-4 sm:space-y-0">
                    <div class="bg-white/80 sm:mx-6 flex flex-col w-full sm:w-1/3 p-6 rounded-xl border-2 border-white">
                        <span class="font-semibold text-xs app-color-lavendar">Select Facility</span>

                        <select class="reservation-input" id="academic-select" style="display: none;">
                            <option value="">Select Academic Facility</option>
                            <option value="comlabs">Computer Laboratories</option>
                            <option value="classrooms">Classrooms</option>
                            <option value="library">Library Study Rooms</option>
                        </select>

                        <select class="reservation-input" id="sports-select">
                            <option value="">Select Sports Facility</option>
                            <option value="Gym">Gymnasium</option>
                            <option value="Volleyball">Volleyball Courts</option>
                        </select>

                        <select class="reservation-input" id="events-select" style="display: none;">
                            <option value="">Select Event Facility</option>
                            <option value="function-halls">Function Halls</option>
                            <option value="marian-hotel">Marian Hotel</option>
                            <option value="hud">HUD Facilities</option>
                        </select>
                    </div>
                    <div class="bg-white/80 sm:mx-6 flex flex-col w-full sm:w-1/3 p-6 rounded-xl border-2 border-white">
                        <span class="font-semibold text-xs app-color-lavendar">Date & Time</span>
                        <div class="flex flex-col space-y-4">
                            <input type="date" class="reservation-input" id="date-select">
                            <select class="reservation-input" id="time-slot">
                                <option value="">Select time slot</option>
                                <option value="Morning (8:00 AM - 12:00 PM)">Morning (8:00 AM - 12:00 PM)</option>
                                <option value="Afternoon (1:00 PM - 5:00 PM)">Afternoon (1:00 PM - 5:00 PM)</option>
                                <option value="Evening (6:00 PM - 9:00 PM)">Evening (6:00 PM - 9:00 PM)</option>
                                <option value="Full-day (8:00 AM - 5:00 PM)">Full Day (8:00 AM - 5:00 PM)</option>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white/80 sm:mx-6 flex flex-col w-full sm:w-1/3 p-6 rounded-xl border-2 border-white">
                        <span class="font-semibold text-xs app-color-lavendar">Purpose & Attendees</span>
                        <div class="reservation-details">
                            <select class="reservation-input mb-1" id="purpose">
                                <option value="">Select purpose</option>
                                <option value="Class">Class Activity</option>
                                <option value="Meeting">Organization Meeting</option>
                                <option value="Event">School Event</option>
                                <option value="Practice">Sports Practice</option>
                                <option value="Other">Other</option>
                            </select>
                            <input type="number" 
                                   class="reservation-input" 
                                   placeholder="Number of Attendees"
                                   min="1" 
                                   max="500" 
                                   id="attendees">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-lg w-96 mx-auto mt-20 p-6">
            <h3 class="text-lg font-semibold mb-4">Edit Profile</h3>
            <form id="profileForm">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm text-gray-600">Name</label>
                        <input type="text" id="userName" class="w-full p-2 border rounded" value="Juan Dela Cruz">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600">Student ID</label>
                        <input type="text" id="studentId" class="w-full p-2 border rounded" value="2021-00123" readonly>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600">Course</label>
                        <input type="text" id="course" class="w-full p-2 border rounded" value="BSIT">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600">Year Level</label>
                        <select id="yearLevel" class="w-full p-2 border rounded">
                            <option value="1">1st Year</option>
                            <option value="2" selected>2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded" onclick="closeModal('editProfileModal')">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div id="cancelBookingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-lg w-96 mx-auto mt-20 p-6">
            <h3 class="text-lg font-semibold mb-4">Cancel Booking</h3>
            <p class="text-gray-600 mb-4">Are you sure you want to cancel your booking for Computer Lab 3?</p>
            <div class="flex justify-end space-x-3">
                <button class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded" onclick="closeModal('cancelBookingModal')">No, Keep it</button>
                <button class="px-4 py-2 text-sm text-white bg-red-600 hover:bg-red-700 rounded" onclick="cancelBooking()">Yes, Cancel</button>
            </div>
        </div>
    </div>

    <div class="dropdown-overlay" id="dropdownOverlay"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const accountButton = document.getElementById("accountButton");
        const accountDropdown = document.getElementById("accountDropdown")

        if (notificationButton) {
            notificationButton.addEventListener("click", (e) => {
                e.stopPropagation();
                accountDropdown.classList.add("hidden");
            });
        }

        if (accountButton) {
            accountButton.addEventListener("click", (e) => {
                e.stopPropagation();
                accountDropdown.classList.toggle("hidden");
            });
        }
        });
        document.addEventListener("click", () => {
    accountDropdown?.classList.add("hidden");
});

        

const tabs = document.querySelectorAll(".option-tab");
const selects = {
    academic: document.getElementById("academic-select"),
    sports: document.getElementById("sports-select"),
    events: document.getElementById("events-select"),
};


document.querySelectorAll(".option-tab").forEach((t) => t.classList.remove("active"));
document.querySelector(".option-tab[data-tab='events']")?.classList.add("active");

Object.values(selects).forEach((select) => (select.style.display = "none"));
selects["events"].style.display = "block";

tabs.forEach((tab) => {
    tab.addEventListener("click", function () {
        tabs.forEach((t) => t.classList.remove("active"));
        this.classList.add("active");

        Object.values(selects).forEach((select) => (select.style.display = "none"));

        activeTab = this.getAttribute("data-tab"); 
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
        let activeTab = document.querySelector(".option-tab.active")?.getAttribute("data-tab") || "sports";
        console.log("Active Tab:", activeTab);

        const facilityDropdown = document.querySelector(`select#${activeTab}-select`);
        console.log("Facility Selected:", facilityDropdown);

        const dateInput = document.getElementById("date-select");
        const DateValue = dateInput?.value.trim() || "";
        console.log("Date Value:", DateValue);

        const timeSlotInput = document.getElementById("time-slot");
        const TimeValue = timeSlotInput?.value.trim() || "";
        console.log("Time Value:", TimeValue);

        const purposeInput = document.getElementById("purpose");
        const PurposeValue = purposeInput?.value.trim() || "";
        console.log("Purpose Value:", PurposeValue);

        const attendeesInput = document.getElementById("attendees");
        const AttendeesValue = parseInt(attendeesInput?.value, 10);
        console.log("Attendees Value:", AttendeesValue);

        if (!facilityDropdown || !DateValue || !TimeValue || !PurposeValue || isNaN(AttendeesValue) || AttendeesValue <= 0) {
            console.error("Invalid booking details!");
            showNotification("Fill in all fields before booking.", "error");
            return;
        }

        if (activeTab === "events") {
            document.getElementById("events-select").focus();
        }

        fetch("/WebDa/booking/src/php/check_availability.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({}) 
        })
        .then(response => response.json())
        .then(data => {
            console.log("Active Reservation Check:", data);

            if (data.active) {
                showNotification("Active reservation is ongoing, cannot book twice.", "error");
                return;
            }

            showNotification("Booking confirmed!", "success");

            fetch("/WebDa/booking/src/php/book.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    facility: facilityDropdown.value,
                    date: DateValue,
                    timeSlot: TimeValue,
                    purpose: PurposeValue,
                    attendees: AttendeesValue,
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log("Response from Server:", data);
                if (data.success) {
                    showNotification("Booking successful!", "success");
                } else {
                    showNotification(data.error || "Error occurred!", "error");
                }
            })
            .catch(error => {
                console.error("Fetch Error:", error);
                showNotification("Error request.", "error");
            });
        })
        .catch(error => {
            console.error("Active Reservation Check Error:", error);
            showNotification("Error checking reservation.", "error");
        });
    });
}


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
    fetchNotifications();
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