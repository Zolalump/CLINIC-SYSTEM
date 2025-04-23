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
    </head>

    <style>
        #pending-booking-list {
            max-height: 170px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #a5a5a5 #f5f5f5;
        }
        #pending-booking-list::-webkit-scrollbar {
            width: 6px;
        }
        #pending-booking-list::-webkit-scrollbar-track {
            background: #f5f5f5;
        }
        #pending-booking-list::-webkit-scrollbar-thumb {
            background-color: #a5a5a5;
            border-radius: 4px;
        }

    </style>

    <body>
        <div class="app-container flex justify-center items-end">
        <img 
            class="absolute z-0 bg-no-repeat w-full h-full
            hidden sm:block sm:object-fill sm:h-[100vh] 
            hidden md:block md:object-cover md:h-[100vh] 
            lg:object-cover lg:h-[100vh]"
            src="/WebDa/booking/img/bg.jpg" 
            alt="image1" 
            style="object-fit: fill; opacity: 0.9;">
            <div class="circle rounded-full"></div>
            <div class="absolute top-11 flex flex-col w-full items-center px-4 md:px-0">
                <div class="flex items-center w-full justify-end pr-8">
                    <div class="relative flex items-center space-x-4">
                    <div class="relative">
                        <button id="notificationButton" class="flex items-center justify-center w-10 h-10 bg-white rounded-full app-shadow">
                            <i class="fa-regular fa-bell app-color-black"></i>
                        </button>
                        <div
                            id="notificationDropdown"
                            class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg z-50"
                        >
                            <div class="p-4 border-b">
                                <p class="font-semibold text-sm">Notifications</p>
                            </div>
                            <div class="py-2">
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">New message from Admin</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Booking Approved</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">System Maintenance Notice</a>
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
                                        <p class="font-semibold text-sm">John Ellemeleck P. Austria</p>
                                        <p class="text-xs text-gray-500">Student ID: C230117</p>
                                        <p class="text-xs text-gray-500">BSCS    - 2nd Year</p>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2">
                                <a href="/WebDa/booking/src/php/history.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                    <i class="fa-solid fa-clock-rotate-left mr-3"></i> Booking History
                                </a>
                                <a href="/WebDa/booking/src/php/Pending_book.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                    <i class="fa-solid fa-hourglass-half mr-3"></i> Pending Bookings
                                </a>
                                <a href="/WebDa/booking/src/php/Active_reserve.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                    <i class="fa-solid fa-calendar-check mr-3"></i> Active Reservations
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                    <i class="fa-solid fa-gear mr-3"></i> Settings
                                </a>
                                <div class="border-t mt-2">
                                    <a
                                        href="/Webda/booking/index.php"
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
                <div class=" sm:w-11/12 md:w-10/12 px-4 sm:px-6 pt-8 sm:pt-10 pb-9 sm:pb-16 app-shadow rounded-xl backdrop-blur-[200px]">
                <a href="reserve.php" style="color: white; margin-left: 12px;">Back</a>
                <div class="flex flex-wrap sm:flex-nowrap pr-0 sm:pr-6 rounded-lg justify-center w-full">
                <div class="flex flex-col sm:flex-row mt-8 sm:mt-12 space-y-4 sm:space-y-0 mb-10">    
                    <div class="bg-white flex flex-col lg:w-[900px] lg:h-[130%] sm:w-[500px] md:w-[200px] p-6 rounded-xl border-2 border-white mb-4">
                        <span style="text-align: center; " class="font-semibold text-l app-color-lavendar mb-5">Pending Reservations</span>
                        <div class="reservation-details">
                            <div id="pending-booking-list" style="opacity: 1;">
                                <p>Empty</p> 
                            </div>  
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
            const notificationButton = document.getElementById("notificationButton");
            const notificationDropdown = document.getElementById("notificationDropdown");
            const accountButton = document.getElementById("accountButton");
            const accountDropdown = document.getElementById("accountDropdown");

            notificationButton.addEventListener("click", (e) => {
                e.stopPropagation(); 
                notificationDropdown.classList.toggle("hidden");
                accountDropdown.classList.add("hidden"); 
            });

            accountButton.addEventListener("click", (e) => {
                e.stopPropagation(); 
                accountDropdown.classList.toggle("hidden");
                notificationDropdown.classList.add("hidden"); 
            });

            document.addEventListener("click", () => {
                notificationDropdown.classList.add("hidden");
                accountDropdown.classList.add("hidden");
            });

            document.addEventListener("DOMContentLoaded", function () {
            });


        function approveReservation(reservationId) {
                fetch(`/WebDa/booking/src/php/approve.php?id=${reservationId}`)
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert("Reservation approved!");

                            document.querySelector(`.approve-btn[data-id="${reservationId}"]`).closest("div").remove();
                            
                            loadPendingReservations();
                        } else {
                            alert("Error: " + result.error);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }

        function loadPendingReservations() {
        let pendingList = document.getElementById("pending-booking-list");

        if (!pendingList) {
            console.error("Error: Element #pending-booking-list not found!");
            return; 
        }

        }

        document.addEventListener("DOMContentLoaded", function () {
    fetch("/WebDa/booking/src/php/fetch_pending_reservations.php")
        .then(response => response.json())
        .then(data => {
            let bookingList = document.getElementById("pending-booking-list");
            bookingList.innerHTML = ""; 

            if (data.bookings.length === 0) {
                bookingList.innerHTML = "<p>No pending reservations.</p>";
            } else {
                data.bookings.forEach(reservation => {
                    let reservationDiv = document.createElement("div");
                    reservationDiv.classList.add(
                        "p-4", "border-b", "border-gray-200", 
                        "flex", "justify-between", "items-center", "gap-4"
                    );

                    reservationDiv.innerHTML = `
                        <div class="flex-1">
                            <p><strong>Reservation ID:</strong> ${reservation.id}</p>
                            <p><strong>Facility:</strong> ${reservation.facility}</p>
                            <p><strong>Date:</strong> ${reservation.date}</p>
                            <p><strong>Time:</strong> ${reservation.time_slot}</p>
                            <p><strong>Purpose:</strong> ${reservation.purpose}</p>
                            <p><strong>Attendees:</strong> ${reservation.attendees}</p>
                        </div>
                        <div class="ml-auto">
                            <button class="cancel-btn bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700" data-id="${reservation.id}">
                                Cancel
                            </button>
                        </div>
                    `;

                    bookingList.appendChild(reservationDiv);
                });

                document.querySelectorAll(".cancel-btn").forEach(button => {
                    button.addEventListener("click", function () {
                        let reservationId = this.getAttribute("data-id");
                        if (confirm("Are you sure you want to cancel this reservation?")) {
                            fetch(`/WebDa/booking/src/php/cancel.php?id=${reservationId}`)
                            .then(response => response.text())  // Log raw response first
                            .then(text => {
                                console.log("Raw response:", text);
                                return JSON.parse(text);
                            })
                                .then(data => {
                                    if (data.success) {
                                        alert("Reservation canceled successfully.");
                                        location.reload(); 
                                    } else {
                                        alert("Error canceling reservation.");
                                    }
                                })
                                .catch(error => console.error("Cancel error:", error));
                        }
                    });
                });
            }
        })
        .catch(error => {
            console.error("Error fetching pending reservations:", error);
            document.getElementById("pending-booking-list").innerHTML = "<p>Error loading reservations.</p>";
        });
});



    document.addEventListener("DOMContentLoaded", loadPendingReservations);
        </script>
    </body>

    </html>