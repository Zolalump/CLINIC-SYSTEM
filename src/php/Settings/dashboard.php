<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SMCTI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="/img/logo.jpg">
    <link rel="stylesheet" href="/WebDa/booking/font/Suisse/stylesheet.css">
    <style>

        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; visibility: hidden; }
        }
        
        body {
            font-family: 'Suisse', sans-serif;
            font-weight: 400 !important;
        }

        @media (max-width: 480px) {
            .no-reservations
            .no-pending
            .no-history {
                font-size: 16px; 
                padding: 10px;
            }
        }

    </style>
  </head>
  <body class=" bg-gray-50" style="margin: 30px;">
  
  <main>
    <div class="min-h-screen p-4 md:p-8">
      <div class="max-w-7xl mx-auto">
      <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Users Registered
                    <div class="text-lg font-light text-gray-600">Approved Bookings Below</div>
                </h1>
            </div>
            
            <nav class="flex-1 flex justify-center">
                <ul class="flex space-x-6 bg-white shadow-md rounded-lg px-6 py-2">
                    <li>
                        <a href="#" class="text-gray-700 font-medium hover:text-blue-600 transition">Dashboard</a>
                    </li>
                    <li>
                        <a href="approve_books.php" class="text-gray-700 font-medium hover:text-blue-600 transition">Unavailable Facilities</a>
                    </li>
                </ul>
            </nav>

            <a href="../dashboard.php" 
            class="ml-auto bg-gradient-to-r from-blue-600 to-blue-400 text-white font-semibold py-2 px-6 rounded-lg shadow-lg hover:from-blue-700 hover:to-blue-500 transition-all duration-300 ease-in-out flex items-center">
                ← Go Back
            </a>
        </div>


          <div style="width: 100%;">
            <div class="w-full bg-blue-800 p-4 rounded-lg shadow-sm">
              <h2 class="text-2xl font-semibold mb-4" style="color: white;">Your Bookings</h2>

              <div class="mb-4" style="width: 100%;">
                <div class="flex w-full rounded-md border border-input p-1">
                  <button
                    class="tab-button flex-1 justify-center rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-background text-foreground shadow-sm"
                    data-tab="active"
                  style="color: white;">
                    Active Bookings
                  </button>
                  <button
                    class="tab-button flex-1 justify-center rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50"
                    data-tab="pending"
                    style="color: white;">
                    Pending Bookings
                  </button>
                  <button
                    class="tab-button flex-1 justify-center rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50"
                    data-tab="history"
                    style="color: white;">
                    Booking History
                  </button>
                </div>
              </div>

              <section>
                <!-- Active Bookings Table -->
                <div class="tab-content w-full block" id="active-tab">
                  <div class="w-full bg-white rounded-md shadow-sm">
                    <div class="rounded-md border"> 
                      <div class="w-full overflow-y-auto" style="height: 53vh;">
                        <table class="w-full caption-bottom text-sm">
                          <tbody class="[&_tr:last-child]:border-0" id="active-booking-list">                              
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Pending Bookings Table -->
                <div class="tab-content w-full hidden" id="pending-tab">
                  <div class="w-full bg-white rounded-md shadow-sm">
                    <div class="rounded-md border"> 
                      <div class="w-full overflow-y-auto" style="height: 53vh;">
                        <table class="w-full caption-bottom text-sm">
                          <tbody class="[&_tr:last-child]:border-0" id="pending-booking-list">                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- History Bookings Table -->
                <div class="tab-content w-full hidden" id="history-tab">
                  <div class="w-full bg-white rounded-md shadow-sm">
                    <div class="rounded-md border">
                      <div class="w-full overflow-auto" style="height: 53vh;">
                        <table class="w-full caption-bottom text-sm">
                          <tbody id="booking-history-list">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".tab-button").forEach(button => {
            button.addEventListener("click", function () {
                const tabId = this.getAttribute("data-tab"); 
                switchTab(tabId);
            });
        });
    });

    function switchTab(tabId) {
        document.querySelectorAll(".tab-content").forEach(tab => {
            tab.classList.add("hidden");
        });

        document.getElementById(`${tabId}-tab`).classList.remove("hidden");

        document.querySelectorAll(".tab-button").forEach(button => {
            button.classList.remove("active");
        });

        document.querySelector(`[data-tab='${tabId}']`).classList.add("active");
        
    }

    // Active booking Table
    document.addEventListener("DOMContentLoaded", function () {
        fetch("/WebDa/booking/src/php/fetch_active_reservations.php")
            .then(response => response.json())
            .then(data => {
                let bookingList = document.getElementById("active-booking-list");
                bookingList.innerHTML = ""; 

                if (data.length === 0) {
                    bookingList.innerHTML = "<div class='no-reservations'>No active reservations.</div>";
                } else {
                    data.forEach(reservation => {
                        let reservationDiv = document.createElement("div");
                        reservationDiv.classList.add("p-4", "border-b", "border-gray-200");

                        reservationDiv.innerHTML = `
                            <p><strong>Reservation ID:</strong> ${reservation.id}</p>
                            <p><strong>User:</strong> ${reservation.firstname} ${reservation.lastname}</p>
                            <p><strong>Facility:</strong> ${reservation.facility}</p>
                            <p><strong>Date:</strong> ${reservation.date}</p>
                            <p><strong>Time:</strong> ${reservation.time_slot}</p>
                        `;

                        bookingList.appendChild(reservationDiv);
                    });
                }
            })
            .catch(() => showToast("Error loading active reservations.", "error"));
    });


    // Pending lists
    document.addEventListener("DOMContentLoaded", function () {
        fetch("/WebDa/booking/src/php/fetch_pending_reservations.php")
            .then(response => response.json())
            .then(data => {
                let bookingList = document.getElementById("pending-booking-list");
                bookingList.innerHTML = ""; 

                if (data.bookings.length === 0) {
                    bookingList.innerHTML = "<div class='no-pending'>No pending reservations.</div>";
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
                          event.preventDefault(); 

                            let reservationId = this.getAttribute("data-id");

                            if (confirm("Are you sure you want to cancel this reservation?")) {
                                fetch(`/WebDa/booking/src/php/cancel.php?id=${reservationId}`)
                                .then(response => response.text()) 
                                .then(text => {
                                    console.log("Raw response:", text);
                                    return JSON.parse(text);
                                })
                                    .then(data => {
                                        if (data.success) {
                                          showToast("Reservation canceled successfully!", "success");
                                           
                                          setTimeout(() => {
                                              location.reload();
                                          }, 4000);

                                        } else {
                                          showToast("Error canceling reservation.", "error");
                                        }
                                    })
                                    .catch(() => showToast("Error canceling reservation.", "error"));
                            }
                        });
                    });
                }
            })
            .catch(() => showToast("Error loading pending reservations.", "error"));
            
    });

    // Booking history table
    document.addEventListener("DOMContentLoaded", function () {
        fetch("/WebDa/booking/src/php/fetch_booking_history.php")
            .then(response => response.json())
            .then(data => { 
                let historyList = document.getElementById("booking-history-list");
                historyList.innerHTML = "";

                if (!data.success || data.bookings.length === 0) {
                    historyList.innerHTML = "<div class='no-history'>No booking History.</div>";
                } else {
                    data.bookings.forEach(reservation => {
                        let reservationDiv = document.createElement("div");
                        reservationDiv.classList.add("p-4", "border-b", "border-gray-200");

                        let statusBadge = "";
                        if (reservation.status === "approved") {
                            statusBadge = `<span class="status-badge approved">Approved</span>`;
                        } else if (reservation.status === "disapproved") {
                            statusBadge = `<span class="status-badge disapproved">Disapproved</span>`;
                        } else if (reservation.status === "canceled") {
                            statusBadge = `<span class="status-badge canceled">Canceled</span>`;
                        } else {
                            statusBadge = `<span class="status-badge pending">Pending</span>`;
                        }


                        reservationDiv.innerHTML = `
                            <p><strong>Facility:</strong> ${reservation.facility}</p>
                            <p><strong>Date:</strong> ${reservation.date}</p>
                            <p><strong>Time:</strong> ${reservation.time_slot}</p>
                            <p><strong>Status:</strong> ${statusBadge}</p>
                            <p><strong>Created At:</strong> ${reservation.created_at}</p>
                        `;

                        historyList.appendChild(reservationDiv);
                    });
                }
            })
            .catch(() => showToast("Error loading booking history.", "error"));
    });

      </script>
    </div>
  </body>
</html>
