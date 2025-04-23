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

      .approved-bookings-section {
          width: 100%;
          margin: auto;
          border: 1px solid #e5e7eb;
          height: 70vh;
      }

      #approved-booking-list {
          max-height: 380px;
          overflow-y: auto;
          padding-right: 10px;
      }

      .custom-scrollbar::-webkit-scrollbar {
          width: 8px;
      }

      .custom-scrollbar::-webkit-scrollbar-thumb {
          background: linear-gradient(135deg, #1E3A8A, #3B82F6); 
          border-radius: 10px;
      }

      .custom-scrollbar::-webkit-scrollbar-track {
          background: #E0E7FF; 
      }

      .custom-scrollbar {
          scrollbar-width: thin;
          scrollbar-color: #1E3A8A #E0E7FF; 
      }


      .booking-item {
          background: white;
          border-left: 5px solid #4CAF50;
          padding: 12px;
          margin-bottom: 8px;
          border-radius: 6px;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .booking-item p {
          margin: 4px 0;
          color: #374151;
      }

      .booking-item strong {
          color: #111827;
      }


    </style>
  </head>
  <body class=" bg-gray-50" style="margin: 30px;">

    <div id="toast-container" class="custom-notification fixed bottom-5 right-5 hidden">
      <div id="toast-message" class="bg-blue-900 text-white px-4 py-2 rounded-md shadow-md">
          Profile updated successfully!
      </div>
    </div>
  
  <main>
    <div class="min-h-screen p-4 md:p-8">
      <div class="max-w-7xl mx-auto">
      <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Dashboard
                    <div class="text-lg font-light text-gray-600">Approved Bookings Below</div>
                </h1>
            </div>
            
            <nav class="flex-1 flex justify-center">
                <ul class="flex space-x-6 bg-white shadow-md rounded-lg px-6 py-2">
                    <li>
                        <a href="dashboard.php" class="text-gray-700 font-medium hover:text-blue-600 transition">Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-700 font-medium hover:text-blue-600 transition">Unavailable Facilities</a>
                    </li>
                </ul>
            </nav>

            <a href="../reserve.php" 
            class="ml-auto bg-gradient-to-r from-blue-600 to-blue-400 text-white font-semibold py-2 px-6 rounded-lg shadow-lg hover:from-blue-700 hover:to-blue-500 transition-all duration-300 ease-in-out flex items-center">
                ← Go Back
            </a>
        </div>

            <section style="margin-top: -30px; margin-right:30px; width: 100%; margin-top: 20px;">
              <div class="approved-bookings-section bg-blue-800 shadow-lg rounded-lg p-5">
                  <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center" style="color:white;">
                      Approved Bookings (Unavailable Facilities)
                  </h2>
                  
                  <div id="approved-booking-list" class="border bg-gray-50 p-4 rounded-lg overflow-y-auto max-h-80 custom-scrollbar">
                      <p class="text-gray-500 text-center">Loading approved bookings...</p>
                  </div>
              </div>
            </section>

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

      document.addEventListener("DOMContentLoaded", function () {
          fetch("fetch_appr_reserve.php")
              .then(response => response.json())
              .then(data => {
                  let approvedList = document.getElementById("approved-booking-list");
                  approvedList.innerHTML = ""; 
                  if (!data.success || data.bookings.length === 0) {
                      approvedList.innerHTML = "<div class='no-approvals'>No approved bookings yet.</div>";
                  } else {
                      data.bookings.forEach(reservation => {
                          let reservationDiv = document.createElement("div");
                          reservationDiv.classList.add("p-4", "border-b", "border-gray-200");

                          reservationDiv.innerHTML = `
                              <p><strong>Facility:</strong> ${reservation.facility}</p>
                              <p><strong>Date:</strong> ${reservation.date}</p>
                              <p><strong>Time:</strong> ${reservation.time_slot}</p>
                          `;

                          approvedList.appendChild(reservationDiv);
                      });
                  }
              })
              .catch(error => {
                  console.error("Error fetching approved bookings:", error);
                  document.getElementById("approved-booking-list").innerHTML = "<p>Error loading approved reservations.</p>";
              });
      });




      </script>
    </div>
  </body>
</html>
