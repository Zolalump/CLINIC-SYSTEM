<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center min-h-screen py-10">
    <div class="space-y-6">
        <!-- Notification Bell -->
        <div class="relative">
            <button id="notificationButton" class="flex items-center justify-center w-10 h-10 bg-white rounded-full shadow">
                <i class="fa-regular fa-bell text-gray-600"></i>
            </button>
            <!-- Notification Dropdown -->
            <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg z-50">
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

        <!-- Account Menu -->
        <div class="relative">
            <button id="accountButton" class="flex bg-white px-6 py-4 shadow rounded-md items-center cursor-pointer">
                <span class="font-bold text-gray-600 text-xs">Account</span>
                <div class="w-px bg-gray-300 mx-4"></div>
                <i class="fa-regular fa-user mr-2 text-gray-600"></i>
                <i id="accountArrow" class="fa-solid fa-angle-down text-xs text-gray-600"></i>
            </button>
            <!-- Account Dropdown -->
            <div id="accountDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg z-50">
                <div class="p-4 border-b">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                            <i class="fa-regular fa-user text-xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-sm">Juan Dela Cruz</p>
                            <p class="text-xs text-gray-500">Student ID: 2021-00123</p>
                            <p class="text-xs text-gray-500">BSIT - 2nd Year</p>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <a href="#" data-section="bookingHistory" class="block px-4 py-2 text-sm hover:bg-gray-100">
                        <i class="fa-solid fa-clock-rotate-left mr-3"></i> Booking History
                    </a>
                    <a href="#" data-section="pendingBookings" class="block px-4 py-2 text-sm hover:bg-gray-100">
                        <i class="fa-solid fa-hourglass-half mr-3"></i> Pending Bookings
                    </a>
                    <a href="#" data-section="activeReservations" class="block px-4 py-2 text-sm hover:bg-gray-100">
                        <i class="fa-solid fa-calendar-check mr-3"></i> Active Reservations
                    </a>
                    <a href="#" data-section="settings" class="block px-4 py-2 text-sm hover:bg-gray-100">
                        <i class="fa-solid fa-gear mr-3"></i> Settings
                    </a>
                    <div class="border-t mt-2">
                        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                            <i class="fa-solid fa-right-from-bracket mr-3"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div id="contentArea" class="mt-10 w-full max-w-4xl bg-white rounded-lg shadow p-6 hidden">
        <!-- Sections -->
        <div id="bookingHistory" class="hidden">
            <h2 class="text-xl font-semibold mb-4">Booking History</h2>
            <p>No bookings yet.</p>
        </div>
        <div id="pendingBookings" class="hidden">
            <h2 class="text-xl font-semibold mb-4">Pending Bookings</h2>
            <p>Here are your pending bookings.</p>
        </div>
        <div id="activeReservations" class="hidden">
            <h2 class="text-xl font-semibold mb-4">Active Reservations</h2>
            <p>You have 2 active reservations.</p>
        </div>
        <div id="settings" class="hidden">
            <h2 class="text-xl font-semibold mb-4">Settings</h2>
            <p>Configure your account settings here.</p>
        </div>
    </div>

    <script>
        // Dropdown toggles
        const notificationButton = document.getElementById("notificationButton");
        const notificationDropdown = document.getElementById("notificationDropdown");
        const accountButton = document.getElementById("accountButton");
        const accountDropdown = document.getElementById("accountDropdown");

        // Content Area
        const contentArea = document.getElementById("contentArea");
        const sections = document.querySelectorAll("#contentArea > div");

        // Toggle notification dropdown
        notificationButton.addEventListener("click", (e) => {
            e.stopPropagation(); // Prevent click bubbling
            notificationDropdown.classList.toggle("hidden");
            accountDropdown.classList.add("hidden"); // Close account dropdown
        });

        // Toggle account dropdown
        accountButton.addEventListener("click", (e) => {
            e.stopPropagation(); // Prevent click bubbling
            accountDropdown.classList.toggle("hidden");
            notificationDropdown.classList.add("hidden"); // Close notification dropdown
        });

        // Close dropdowns when clicking outside
        document.addEventListener("click", () => {
            notificationDropdown.classList.add("hidden");
            accountDropdown.classList.add("hidden");
        });

        // Handle menu clicks
        accountDropdown.addEventListener("click", (e) => {
            if (e.target.dataset.section) {
                e.preventDefault();
                const targetSection = e.target.dataset.section;

                // Show content area and the selected section
                contentArea.classList.remove("hidden");
                sections.forEach((section) => {
                    section.id === targetSection
                        ? section.classList.remove("hidden")
                        : section.classList.add("hidden");
                });
                accountDropdown.classList.add("hidden"); // Close dropdown
            }
        });
    </script>
</body>
</html>
