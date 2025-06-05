<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMCTI CLINIC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="../../img/logo sa smc.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="./stats.css">
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

<body class="bg-gray-100 min-h-screen">

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
    
    <div class="container mx-auto px-4 py-8 mt-24">
   
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-center text-blue-900">Clinic Statistics</h1>
            <p class="text-center text-gray-600">School Clinic Visitor Analysis Dashboard</p>
        </header>
        
    
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="dateRange" class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                    <select id="dateRange" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                        <option value="semester">By Semester</option>
                        <option value="yearly">Yearly</option>
                    </select>
                </div>
                
                <div id="dateSelector">
                
                </div>
                
                <div>
                    <label for="filterDepartment" class="block text-sm font-medium text-gray-700 mb-1">Filter by Department</label>
                    <select id="filterDepartment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="all" selected>All Departments</option>
                        <option value="basic-education">Basic Education</option>
                        <option value="tertiary">Tertiary</option>
                        <option value="personnel">Personnel</option>
                    </select>
                </div>
            </div>
            
            <div class="flex justify-center mt-6 gap-4">
                <button id="generateReport" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Generate Report
                </button>
                <button id="exportStats" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Export to Excel
                </button>
            </div>
        </div>
        
  
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Visits</h3>
                <p id="totalVisits" class="text-3xl font-bold text-blue-900">0</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Common Complaint</h3>
                <p id="commonComplaint" class="text-xl font-medium text-blue-900">-</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Department Breakdown</h3>
                <div id="deptBreakdown" class="text-sm text-gray-700">
                    <div>Basic Education: <span class="font-bold">0</span></div>
                    <div>Tertiary: <span class="font-bold">0</span></div>
                    <div>Personnel: <span class="font-bold">0</span></div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Avg. Daily Visits</h3>
                <p id="avgDailyVisits" class="text-3xl font-bold text-blue-900">0</p>
            </div>
        </div>
        

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Visits by Day of Week</h3>
                <div class="chart-container">
                    <canvas id="visitsByDayChart"></canvas>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Department Distribution</h3>
                <div class="chart-container">
                    <canvas id="deptDistChart"></canvas>
                </div>
            </div>
        </div>
        

        <div class="bg-white rounded-lg shadow-md p-4 mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Detailed Statistics by Classification</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Classification</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visits</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Common Complaint</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">% of Total</th>
                        </tr>
                    </thead>
                    <tbody id="statsTableBody" class="bg-white divide-y divide-gray-200">
   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="./stats2.js"></script>
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

        document.addEventListener('DOMContentLoaded', () => {
            fetch('../../pages/Stats/get_stats.php') // adjust this path if needed
                .then(res => res.json())
                .then(data => {
                    // Update simple text stats if you have these elements
                    const totalVisitsElem = document.getElementById('totalVisits');
                    if (totalVisitsElem) totalVisitsElem.textContent = data.totalVisits;

                    const commonComplaintElem = document.getElementById('commonComplaint');
                    if (commonComplaintElem) commonComplaintElem.textContent = data.commonComplaint;

                    const avgDailyVisitsElem = document.getElementById('avgDailyVisits');
                    if (avgDailyVisitsElem) avgDailyVisitsElem.textContent = data.avgDailyVisits;

                    // Update department breakdown if element exists
                    const deptBreakdownElem = document.querySelector('#deptBreakdown');
                    if (deptBreakdownElem) {
                        const breakdown = data.departments;
                        deptBreakdownElem.innerHTML = `
                            <div>Basic Education: <span class="font-bold">${breakdown['basic-education']}</span></div>
                            <div>Tertiary: <span class="font-bold">${breakdown['tertiary']}</span></div>
                            <div>Personnel: <span class="font-bold">${breakdown['personnel']}</span></div>
                        `;
                    }

                    // Render charts and tables
                    renderDeptDistChart(data.departments);
                    renderVisitsByDayChart(data.visitsByDay);
                    renderComplaintsChart(data.complaints);
                    renderClassificationTable(data.classificationStats);
                })
                .catch(error => console.error('Error loading stats:', error));
        });

        function renderDeptDistChart(deptData) {
            const ctx = document.getElementById('deptDistChart')?.getContext('2d');
            if (!ctx) return;

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Basic Education', 'Tertiary', 'Personnel'],
                    datasets: [{
                        label: 'Department Visits',
                        data: [
                            deptData['basic-education'] || 0,
                            deptData['tertiary'] || 0,
                            deptData['personnel'] || 0
                        ],
                        backgroundColor: ['#1E3A8A', '#3B82F6', '#93C5FD']
                    }]
                },
                options: {
                    responsive: true
                }
            });
        }

        function renderVisitsByDayChart(dayData) {
            const ctx = document.getElementById('visitsByDayChart')?.getContext('2d');
            if (!ctx) return;

            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            // Convert array of {day, count} into an object for quick lookup
            const dayCounts = {};
            dayData.forEach(item => {
                dayCounts[item.day] = item.count;
            });

            // Prepare data array matching the days order, defaulting to 0 if missing
            const data = days.map(day => dayCounts[day] || 0);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: days,
                    datasets: [{
                        label: 'Visits',
                        data: data,
                        backgroundColor: '#60A5FA'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });
        }

        function renderComplaintsChart(complaints) {
            const ctx = document.getElementById('complaintsChart')?.getContext('2d');
            if (!ctx) return;

            const labels = complaints.map(c => c.complaint);
            const data = complaints.map(c => c.count);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Frequency',
                        data: data,
                        backgroundColor: '#34D399'
                    }]
                },
                options: {
                    responsive: true,
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetch('../../pages/Stats/get_stats.php')
                .then(res => res.json())
                .then(data => {
                    const tbody = document.getElementById('statsTableBody');
                    tbody.innerHTML = ''; // clear table body

                    data.classificationStats.forEach(stat => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td class="px-4 py-3 whitespace-nowrap">${stat.classification}</td>
                            <td class="px-4 py-3 whitespace-nowrap">${stat.visits}</td>
                            <td class="px-4 py-3 whitespace-nowrap">${stat.commonComplaint || 'None'}</td>
                            <td class="px-4 py-3 whitespace-nowrap">${stat.percent.toFixed(2)}%</td>
                        `;
                        tbody.appendChild(tr);
                    });
                })
                .catch(error => console.error('Error loading stats:', error));
        });


        // Generate Report
        document.getElementById('generateReport').addEventListener('click', () => {
            window.print();
        });

        // Excel Report
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('exportStats').addEventListener('click', () => {
                const table = document.querySelector('table'); // Adjust if needed
                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.table_to_sheet(table);
                XLSX.utils.book_append_sheet(wb, ws, "Statistics");
                XLSX.writeFile(wb, "statistics_report.xlsx");
            });
        });


    </script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

</body>
</html>
