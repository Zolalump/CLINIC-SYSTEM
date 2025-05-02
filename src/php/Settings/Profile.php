<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SMCTI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="../../img/logo sa smc.png">
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

        .no-reservations {
        text-align: center;
        font-size: 18px;
        color: #555; 
        padding: 15px;
        margin-top: 20px;
        }

        .no-pending {
          text-align: center;
          font-size: 18px;
          color: #555; 
          padding: 15px;
          margin-top: 20px;
        }

        .no-history {
          text-align: center;
          font-size: 18px;
          color: #555; 
          padding: 15px;
          margin-top: 20px;
        }
        
        @media (max-width: 480px) {
            .no-reservations
            .no-pending
            .no-history {
                font-size: 16px; 
                padding: 10px;
            }
        }

        .custom-notification {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 15px;
        color: white;
        font-size: 16px;
        opacity: 0; 
        transition: opacity 0.5s ease-in-out;
        z-index: 1000;
        width: 90%;
        max-width: 300px;
        text-align: center;
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
        <div class="flex items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">
                Admin Settings
            </h1>
            <a href="../dashboard.php" 
              class="ml-auto bg-gradient-to-r from-blue-600 to-blue-400 text-white font-semibold py-2 px-6 rounded-lg shadow-lg hover:from-blue-700 hover:to-blue-500 transition-all duration-300 ease-in-out flex items-center">
                ← Go Back
            </a>
        </div>


        <div>
          <div class="lg:col-span-1">
            <div
              class="w-full max-w-md mx-auto p-6 bg-white rounded-lg shadow-md"
            >
              <h2 class="text-2xl font-bold mb-6 text-center">
                Account Settings
              </h2>
              <form id="settingsForm" class="space-y-6">

              <div class="p-4 border-b hidden">
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
                
            <div class="space-y-2">
                <label for="studentId" class="text-sm font-medium leading-none">
                    Admin ID
                </label>
                <input
                    type="text"
                    id="studentId"
                    name="studentId"
                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm"
                    placeholder="Enter your Admin ID"
                />
                <p class="text-sm text-muted-foreground">
                    Your unique Admin identification number.
                </p>
            </div>

            <form id="userForm">
                <div class="space-y-2">
                    <label for="firstname" class="text-sm font-medium leading-none">
                        First Name
                    </label>
                    <input
                        type="text"
                        id="firstname"
                        name="firstname"
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm"
                        placeholder="Enter your first name"
                    />
                </div>

                <div class="space-y-2 mt-4">
                    <label for="lastname" class="text-sm font-medium leading-none">
                        Last Name
                    </label>
                    <input
                        type="text"
                        id="lastname"
                        name="lastname"
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm"
                        placeholder="Enter your last name"
                    />
                </div>

                <div>
                    <a href="../forgot-pass2.php">
                        <p style="color: rgb(1, 1, 170); font-size: medium;">Reset Password?</p>
                    </a>
                </div>

                <button
                  type="submit"
                  id="submit"
                  class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 
                  disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full"
                style="background-color: rgb(1, 1, 170); color: white; font-weight: bold;">
                  Save Changes
                </button>
              </form>
            </div>
          </div>
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

    document.addEventListener("DOMContentLoaded", function () {
    let studentIdInput = document.getElementById("studentId");
    
        if (studentIdInput) {  
            studentIdInput.addEventListener("change", function () {
                let studentId = this.value.trim();

                fetch("update_id.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ student_id: studentId })
                })
                .then(response => response.text())
                .then(data => {

                })
                .catch(() => showToast("Error updating Student ID.", "error"));
            });
        } else {
          showToast("Failed to update Student ID.", "error");
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
    fetch("fetch_user.php")
        .then(response => response.json())
        .then(data => {
            console.log("Fetched user data:", data); 

            let userNameElement = document.getElementById("user-name");
            let studentIdElement = document.getElementById("student_id_display");

            if (!userNameElement) {
                console.error("Element with ID 'user-name' not found.");
                return;
            }

            if (!studentIdElement) {
                console.error("Element with ID 'student-id-display' not found.");
                return;
            }

            userNameElement.innerText = `${data.firstname} ${data.lastname}`;
            studentIdElement.innerText = data.student_id ? data.student_id : "Not Set";
        })
        .catch(() => showToast("Error loading user data.", "error"));
    });

    document.addEventListener("DOMContentLoaded", function () {
        let saveButton = document.getElementById("submit");

        if (saveButton) {
            saveButton.addEventListener("click", function (event) {
                event.preventDefault(); 

                let studentId = document.getElementById("studentId").value.trim();
                let firstName = document.getElementById("firstname").value.trim();
                let lastName = document.getElementById("lastname").value.trim();

                console.log("Submitting update:", { studentId, firstName, lastName });

                fetch("update_user.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        student_id: studentId,
                        firstname: firstName,
                        lastname: lastName
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Update successful:", data);
                        showToast("Profile updated successfully!", "success");

                        document.getElementById("user-name").innerText = `${firstName} ${lastName}`;
                        document.getElementById("student_id_display").innerText = studentId ? studentId : "Not Set";
                    } else {
                        console.error("Update failed:", data);
                        showToast("Update failed. Please try again.", "error");
                    }
                })
                .catch(error => {
                    console.error("Error updating profile:", error);
                    showToast("Something went wrong.", "error");
                });
            });
        } else {
            console.error("Error");
        }
    });

    function showToast(message, type) {
        let toastContainer = document.getElementById("toast-container");
        let toastMessage = document.getElementById("toast-message");

        toastMessage.innerText = message;

        toastMessage.classList.remove("bg-blue-900", "bg-red-500");

        if (type === "success") {
            toastMessage.classList.add("bg-blue-900");
            toastMessage.classList.remove("bg-red-500");
        } else {
            toastMessage.classList.add("bg-red-500");
            toastMessage.classList.remove("bg-blue-900");
        }

        toastContainer.classList.remove("hidden", "opacity-0");
        toastContainer.classList.add("opacity-100");

        setTimeout(() => {
            toastContainer.classList.remove("opacity-100");
            toastContainer.classList.add("opacity-0");

            setTimeout(() => {
                toastContainer.classList.add("hidden");
            }, 500); 
        }, 4000); 
    }

      </script>
    </div>
  </body>
</html>
