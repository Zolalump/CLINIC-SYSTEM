
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/SMC.png" type="image/png">
    <title>SMCTI Clinic - Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

  * {
      font-family: 'Inter', sans-serif;
  }
</style>
<body class="justify-center w-dvw flex flex-col md:flex-row overflow-x-hidden">
    <aside class="hidden md:flex p-1 left-0 top-0 bottom-0 w-[25%] h-dvh flex-col bg-white border-r border-black/10 shadow-md">
        <!-- Header -->
        <div class="flex flex-row items-center gap-4 p-4 border-b border-black/10">
            <img class="h-12 w-12" src="../img/SMC.png" alt="SMC">
            <h1 class="text-2xl font-bold text-[#091C98]">SMCTI Clinic</h1>
        </div>
        
        <!-- Navigation Links -->
        <nav class="flex-grow">
          <ul class="space-y-1 px-2 py-4">
            <li>
              <a href="#" class="nav-link flex items-center px-4 py-3 bg-[#091C98] rounded-lg text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
              </a>
            </li>
            <li>
              <a href="#" class="nav-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg ">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 mr-3" data-lov-id="src/components/Layout.tsx:26:58" data-lov-name="Calendar" data-component-path="src/components/Layout.tsx" data-component-line="26" data-component-file="Layout.tsx" data-component-name="Calendar" data-component-content="%7B%22className%22%3A%22w-5%20h-5%22%7D"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path>
                </svg>
                Request Appointment
              </a>
              </li>
            <li>
              <a href="#" class="nav-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                Notifications
              </a>
            </li>
            <li>
              <a href="#" class="nav-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Settings
              </a>
            </li>
          </ul>
        </nav>
        
        <a href="logout.php" class="flex items-center mx-2 px-4 py-3 text-gray-700 hover:text-red-400 hover:bg-red-200 transition-color duration-300 rounded-lg ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
            </svg>
            Sign Out
          </a>
        </div>
    </aside>

    <nav class="md:hidden flex flex-col items-center justify-center">
        <div class="flex flex-row items-center gap-4 p-4">
            <img class="h-12 w-12" src="../img/SMC.png" alt="SMC">
            <h1 class="text-2xl font-bold text-[#091C98]">SMCTI Clinic</h1>
        </div>
        <ul class="md:hidden border text-sm border-black/15 rounded-md p-1 flex flex-row items-center justify-center">
            <li>
              <a href="#" class="nav-link flex items-center justify-center px-2 py-2 bg-[#091C98] text-white rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
              </a>
            </li>
            <li class="fixed">
              <div class="fixed bottom-8 right-8 md:hidden">
                <button class="nav-link flex flex-row items-center justify-center p-4 rounded-full bg-blue-700 text-white!">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8" data-lov-id="src/components/Layout.tsx:26:58" data-lov-name="Calendar" data-component-path="src/components/Layout.tsx" data-component-line="26" data-component-file="Layout.tsx" data-component-name="Calendar" data-component-content="%7B%22className%22%3A%22w-5%20h-5%22%7D"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path>
                  </svg>
                </button>
              </div>
            </li>
            <li>
              <a href="#" class="nav-link flex items-center justify-center px-2 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                Notifications
              </a>
            </li>
            <li>
              <a href="#" class="nav-link flex items-center justify-center px-2 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  Settings
              </a>
            </li>
        </ul>
    </nav>

    <main class="flex w-dvw flex-grow-1 md:flex-shrink p-4 md:p-8">
      
        <!-- Dashboard Page -->
          <div class="hidden w-full">
            <div class="flex flex-col gap-y-4">
              <h1 class="text-2xl font-bold">Dashboard</h1>
              <p class="text-gray-500">Welcome! Here's an overview of your health statistics and upcoming appointments.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-6">
                <div class="bg-white flex flex-row justify-between items-center hover:bg-gray-100 hover:cursor-pointer transition-colors duration-300 p-4 rounded-lg shadow">
                  <div>
                    <h2 class="text-lg font-semibold">Total Visits</h2>
                    <p class="text-3xl font-bold">156</p>
                  </div>
                  <div class="bg-gray-200 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5" data-component-line="29">
                      <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                      <circle cx="9" cy="7" r="4"></circle>
                      <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                      <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                  </div>
                </div>
                <div class="bg-white flex flex-row justify-between items-center hover:bg-gray-100 hover:cursor-pointer transition-colors duration-300 p-4 rounded-lg shadow">
                  <div>
                    <h2 class="text-lg font-semibold">Upcoming Appointments</h2>
                    <p class="text-3xl font-bold">3</p>
                  </div>
                  <div class="bg-gray-200 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5" data-component-line="30">
                      <path d="M8 2v4"></path>
                      <path d="M16 2v4"></path>
                      <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                      <path d="M3 10h18"></path>
                  </svg>
                  </div>
                </div>
            </div>
            
            <div class="bg-white gap-y-4 p-4 rounded-lg shadow hover:bg-gray-100 hover:cursor-pointer transition-colors duration-300">
              <div class="flex flex-row justify-between items-center gap-y-2">
                <div class="flex flex-col gap-y-4">
                  <h2 class="text-xl font-bold">Visit History</h2>
                  <p class="text-gray-500">Number of clinic visits over the past months.</p>
                </div>
                <div class="bg-gray-200 p-3 rounded-full">
                  <svg class="h-5 w-5" viewBox="0 -35.5 170 170" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g clip-path="url(#clip0)"> <path d="M159.524 0.393145C156.399 0.123788 154.058 0.750571 152.37 2.30179C150.171 4.32164 149.108 7.85474 149.031 13.4077C147.212 15.4816 145.399 17.5445 143.593 19.5965C139.42 24.3401 135.106 29.2446 130.918 34.0834C126.73 38.9222 122.505 43.8811 118.419 48.6762C116.665 50.7333 114.91 52.7923 113.152 54.8533C112.677 54.843 112.182 54.8083 111.663 54.7723C110.128 54.5701 108.57 54.6493 107.064 55.0063C105.06 55.6145 103.869 55.0462 102.107 53.6307C92.4085 45.8476 83.3948 39.8002 74.55 35.1446C73.8555 34.8254 73.2439 34.3489 72.7624 33.752C72.2816 33.1552 71.9436 32.4542 71.7758 31.704C71.0743 29.0054 69.3499 26.6922 66.9731 25.2626C64.5969 23.833 61.7583 23.4013 59.0692 24.0605C56.3348 24.7041 53.9423 26.364 52.3692 28.7085C50.7961 31.0531 50.1584 33.9097 50.5836 36.7075C50.6933 37.4468 50.826 38.1861 50.9536 38.89L51.056 39.4685L15.5387 73.8969C15.3582 73.8795 15.1783 73.8596 14.9991 73.8409C14.4072 73.7767 13.7946 73.7124 13.1805 73.6963C7.30631 73.5259 3.69542 76.116 1.80964 81.8503C0.395138 86.151 1.94355 89.9895 3.23178 92.5031C4.10457 94.3089 5.43379 95.8517 7.0859 96.9748C8.73803 98.0985 10.6546 98.7639 12.6428 98.9034C12.843 98.9143 13.0427 98.9195 13.2422 98.9201C15.156 98.8912 17.0327 98.382 18.7028 97.4396C20.3728 96.4965 21.7836 95.1497 22.8082 93.5201C25.8693 88.8825 26.3451 84.5362 24.2534 80.2489L58.7173 47.1571L68.318 44.1679L96.7993 63.863C97.0238 68.0989 98.0703 71.2753 100.173 74.1232C101.397 75.8724 103.174 77.1517 105.213 77.7521C107.252 78.3519 109.432 78.2368 111.398 77.4262C117.081 75.2495 120.237 70.4261 120.088 64.1697L154.653 20.8963C159.556 21.8606 163.362 21.4107 165.969 19.5528C167.985 18.1186 169.212 15.895 169.615 12.9436C169.846 11.4554 169.772 9.93496 169.397 8.4767C169.022 7.01851 168.354 5.65349 167.434 4.46625C166.462 3.27794 165.259 2.30335 163.898 1.60274C162.538 0.902131 161.049 0.490445 159.524 0.393145Z" fill="#000000"></path> </g> <defs> <clipPath id="clip0"> <rect width="169" height="99" fill="white" transform="translate(0.777344)"></rect> </clipPath> </defs> </g></svg>
                </div>
              </div>
              <div class="h-64 md:h-80">
                <!-- THE CHART GOES HERE -->
                <canvas id="visitChart"></canvas>
              </div>
            </div>

            <div class="flex flex-col md:flex-row flex-grow-1 pt-4 gap-4">
              <a class="flex-1 bg-blue-400 flex items-center justify-center gap-2 text-white py-3 px-6 rounded-lg font-medium shadow-md hover:shadow-lg transition-all duration-200 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-clinic-blue focus:ring-opacity-50" href="./medical-form.php">Edit Medical Form<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-5 h-5" data-lov-id="src/components/Layout.tsx:27:64" data-lov-name="FileText" data-component-path="src/components/Layout.tsx" data-component-line="27" data-component-file="Layout.tsx" data-component-name="FileText" data-component-content="%7B%22className%22%3A%22w-5%20h-5%22%7D"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg></a>
              <a class="flex-1 border border-black/10 hover:bg-gray-100 flex items-center justify-center gap-2 text-black py-3 px-6 rounded-lg font-medium shadow-md hover:shadow-lg transition-all duration-200 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-clinic-blue focus:ring-opacity-50" href="./medical-form-view.php">View Medical Form<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></a>
          </div>
        </div>

        <!-- Request Appointment Page -->  
          <div class="w-full">
            <div class="flex flex-col gap-y-4">

              <div class="flex flex-col gap-y-4">
                <h1 class="text-2xl text-[#020817] font-bold">Request Appointment</h1>
                <p class="text-gray-500">Schedule a visit with our medical staff at the clinic.</p>
              </div>

              <div>
                <div class="flex flex-col gap-y-4 border p-4 border-black/10 rounded-md shadow-sm">
                  <form class="flex flex-col gap-y-4" action="">
                    <div class="flex flex-col gap-y-4">
                      <h2 class="text-xl font-semibold text-[#020817]">New Appointment Request</h2>
                      <p class="text-sm text-gray-500">Fill out the form below to request an appointment.</p>
                    </div>
                    <div class="flex flex-col gap-y-4">
                      <div class="flex flex-col gap-y-2">
                        <label for="name" class="text-sm font-semibold text-[#020817]">Reason for Visit</label>
                        <input type="text" id="reason" class="border border-black/10 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-clinic-blue focus:ring-opacity-50" placeholder="Brief description of your medical concern">
                      </div>
                      <div class="flex flex-col gap-y-2">
                        <label for="date" class="text-sm font-semibold text-[#020817]">Preferred Date</label>
                        <input type="date" id="date" class="border border-black/10 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-clinic-blue focus:ring-opacity-50">
                    </div>
                    <div class="flex flex-col gap-y-2">
                      <label for="notes" class="text-sm font-semibold text-[#020817]">Additional Notes</label>
                      <textarea id="notes" class="border border-black/10 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-clinic-blue focus:ring-opacity-50" rows="4" placeholder="Any additional information or concerns"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-800 text-white font-semibold cursor-pointer py-2 px-4 rounded-md shadow-md hover:shadow-lg transition-all duration-200 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-clinic-blue focus:ring-opacity-50">Request Appointment</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Notification Page -->
          <div class="hidden w-full">
            <div class="flex flex-col gap-y-4">

              <div class="flex flex-col gap-y-4">
                <h1 class="text-2xl text-[#020817] font-bold">Notification</h1>
                <p class="text-gray-500">Stay updated with appointment reminders, health information, and clinic news.</p>
              </div>

              <div class="flex flex-col gap-y-4 border p-4 border-black/10 rounded-md shadow-sm">
                <div class="flex flex-row justify-between items-center">
                  <h1 class="text-xl font-semibold text-[#020817]">Notification Settings</h1>
                  <div class="flex items-center">
                    <span class="mr-2 text-sm font-medium text-[#020817]">Enabled</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                      <input type="checkbox" value="" class="sr-only peer" checked>
                      <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                  </div>
                </div>

                <div class="min-w-[35%] max-w-[40%]">
                  <div class="flex flex-col sm:flex-row gap-2">
                    <button class="flex flex-row text-sm font-medium justify-between items-center text-black border border-black/10 hover:bg-gray-100 transition-color duration-200 rounded-md shadow-xs p-1" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check h-4 w-4 mr-2" data-lov-id="src/pages/Notifications.tsx:174:14" data-lov-name="Check" data-component-path="src/pages/Notifications.tsx" data-component-line="174" data-component-file="Notifications.tsx" data-component-name="Check" data-component-content="%7B%22className%22%3A%22h-4%20w-4%20mr-2%22%7D"><path d="M20 6 9 17l-5-5"></path></svg>Mark all as read</button>
                    <button class="flex flex-row text-sm font-medium justify-between items-center text-black border border-black/10 hover:bg-gray-100 transition-color duration-200 rounded-md shadow-xs p-1" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 h-4 w-4 mr-2" data-lov-id="src/pages/Notifications.tsx:183:14" data-lov-name="Trash2" data-component-path="src/pages/Notifications.tsx" data-component-line="183" data-component-file="Notifications.tsx" data-component-name="Trash2" data-component-content="%7B%22className%22%3A%22h-4%20w-4%20mr-2%22%7D"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>Clear Notification</button>
                  </div>
                </div>

              </div>

              <!-- The Notification Cards goes here -->
              <div class="flex flex-col gap-y-4"> <!-- Card Container -->

                <!-- Sample Notif Card -- backend dev can use this for format sa notif cards -->
                 <div class="flex flex-row justify-between gap-4 border p-4 border-black/10 rounded-md shadow-sm">
                  <div class="flex flex-col gap-y-2">
                    <h2 class="text-lg font-bold text-[#020817]">Appointment Reminder</h2>
                    <p class="text-gray-700">You have an appointment on December 5, 2025 at 3:00 PM.</p>
                    <div class="flex items-center text-sm flex-row text-gray-500">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock h-3 w-3 mr-1" data-lov-id="src/pages/Notifications.tsx:212:24" data-lov-name="Clock" data-component-path="src/pages/Notifications.tsx" data-component-line="212" data-component-file="Notifications.tsx" data-component-name="Clock" data-component-content="%7B%22className%22%3A%22h-3%20w-3%20mr-1%22%7D"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                      <p>1 hour ago</p>
                    </div>
                  </div>

                  <div class="flex flex-row items-center gap-x-2 md:gap-x-4">
                    <button class="hover:bg-gray-100 p-4 rounded-full transition-color duration-200 cursor-pointer" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check h-4 w-4" data-lov-id="src/pages/Notifications.tsx:225:24" data-lov-name="Check" data-component-path="src/pages/Notifications.tsx" data-component-line="225" data-component-file="Notifications.tsx" data-component-name="Check" data-component-content="%7B%22className%22%3A%22h-4%20w-4%22%7D"><path d="M20 6 9 17l-5-5"></path></svg></button>
                    <button class="hover:bg-gray-100 p-4 rounded-full transition-color duration-200 cursor-pointer" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x h-4 w-4" data-lov-id="src/pages/Notifications.tsx:235:22" data-lov-name="X" data-component-path="src/pages/Notifications.tsx" data-component-line="235" data-component-file="Notifications.tsx" data-component-name="X" data-component-content="%7B%22className%22%3A%22h-4%20w-4%22%7D"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg></button>
                  </div>
                 </div>

              </div>

            </div>
          </div>

        <!-- Settings Page -->
          <div class="hidden w-full">
            <div class="flex flex-col gap-y-4">
              <div class="flex flex-col gap-y-4">
                <h1 class="text-2xl text-[#020817] font-bold">Settings</h1>
                <p class="text-gray-500">Manage your account settings and preferences.</p>
              </div>

              <!-- Form for profile information submission, put backend logic for changing first name, lastname and email address.Put logic or js file in onSubmit modifier -->
              <form onsubmit="" class="flex flex-col border p-4 border-black/10 gap-y-2 rounded-md shadow-sm">
                <div>
                  <h2 class="text-lg text-[#020817] font-bold">Profile Information</h2>
                  <p class="text-gray-500 text-sm">Update your personal information and contact details.</p>
                </div>
                <div class="flex flex-col md:flex-row gap-x-2 py-4 w-full">
                  <div class="flex flex-col grow-1 gap-y-2">
                    <label for="firstName">First Name</label>
                    <input value="" class="border border-black/10 p-2 rounded-sm outline-none hover:bg-gray-100 focus:bg-gray-100 transition-colors duration-200" type="text" name="firstName" id="firstName">
                  </div>
                  <div class="flex flex-col grow-1 gap-y-2">
                    <label for="firstName">Last Name</label>
                    <input value="" class="border border-black/10 p-2 rounded-sm outline-none hover:bg-gray-100 focus:bg-gray-100 transition-colors duration-200" type="text" name="lastName" id="lastName">
                  </div>
                </div>
                <div class="flex flex-col grow-1 gap-y-2">
                  <label for="email">Email Address</label>
                  <input value="" class="border border-black/10 p-2 rounded-sm outline-none hover:bg-gray-100 focus:bg-gray-100 transition-colors duration-200" type="email" name="email" id="email">
                </div>

                <div class="flex justify-end">
                  <button class="bg-blue-800 text-white p-2 rounded-md cursor-pointer" type="submit">Save Changes</button>
                </div>
              </form>

              <div class=" border p-4 border-black/10 rounded-md shadow-sm">
                <div>
                  <h2 class="text-lg text-[#020817] font-bold">Change Password</h2>
                  <p class="text-gray-500 text-sm">Update your password to keep your account secure.</p>
                </div>
                <!-- Form for password change submission, put backend logic for changing password, current password must match with the current, and the new and confirm password must match. Put logic or js file in onSubmit modifier -->
                <form onsubmit="">
                  <div class="flex flex-col gap-x-2 py-4 w-full">
                    <div class="flex flex-col grow-1 gap-y-2">
                      <label for="currentPassword">Current Password</label>
                      <input value="" class="border border-black/10 p-2 rounded-sm outline-none hover:bg-gray-100 focus:bg-gray-100 transition-colors duration-200" type="password" name="currentPassword" id="currentPassword">
                    </div>
                    <div class="flex flex-col grow-1 gap-y-2">
                      <label for="newPassword">New Password</label>
                      <input value="" class="border border-black/10 p-2 rounded-sm outline-none hover:bg-gray-100 focus:bg-gray-100 transition-colors duration-200" type="password" name="newPassword" id="newPassword">
                    </div>
                    <div class="flex flex-col grow-1 gap-y-2">
                      <label for="confconfirmPassword">Confirm Password</label>
                      <input value="" class="border border-black/10 p-2 rounded-sm outline-none hover:bg-gray-100 focus:bg-gray-100 transition-colors duration-200" type="password" name="confirmPassword" id="confirmPassword">
                    </div>
                  </div>

                  <div class="flex justify-end">
                    <button class="bg-blue-800 text-white p-2 rounded-md cursor-pointer" type="submit">Update Password</button>
                  </div>
                </form>
              </div>

              <!-- Add logout backend logic at onclick -->
              <div class="flex justify-center md:hidden">
                <button onclick="" class="flex w-full justify-center border border-red-200 items-center mx-2 px-4 py-3 text-gray-700 hover:text-red-400 hover:bg-red-200 transition-color duration-300 rounded-lg cursor-pointer" type="button">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                  </svg>Logout
                </button>
              </div>
            </div>
          </div>

    </main>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Get all link elements with the 'nav-link' class
      const navLinks = document.querySelectorAll('.nav-link');
      
      // Get all main content sections (direct children of the main element)
      const contentSections = document.querySelectorAll('main > div');
      
      // Track the current active page index
      let currentPageIndex = 0; // Starting with Settings page which is index 2 (since it's visible by default)
      
      // Show initial page and highlight active link
      contentSections.forEach((section, index) => {
        section.classList.toggle('hidden', index !== currentPageIndex);
      });
      
      // Find any links that should be highlighted initially
      navLinks.forEach((link, index) => {
        if (index === currentPageIndex) {
          link.classList.add('bg-[#091C98]', 'text-white');
          link.classList.remove('text-gray-700', 'hover:bg-gray-100');
        }
      });
      
      // Add click event listeners to all nav links
      navLinks.forEach((link, index) => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          
          // Don't do anything if clicking the same page
          if (index === currentPageIndex) return;
          
          // Reset all link styles
          navLinks.forEach(navLink => {
            navLink.classList.remove('bg-[#091C98]', 'text-white');
            navLink.classList.add('text-gray-700', 'hover:bg-gray-100');
          });
          
          // Set active link style
          link.classList.add('bg-[#091C98]', 'text-white');
          link.classList.remove('text-gray-700', 'hover:bg-gray-100');
          
          // Hide all pages
          contentSections.forEach(section => {
            section.classList.add('hidden');
          });
          
          // Show the selected page
          // Map navigation index to content index (0=Dashboard, 1=Request Appointment, 2=Notifications, 3=Settings)
          let contentIndex;
          if (index === 0) contentIndex = 0; // Dashboard
          else if (index === 1) contentIndex = 1; // Request Appointment
          else if (index === 2) contentIndex = 2; // Notifications
          else if (index === 3) contentIndex = 3; // Settings
          
          if (contentIndex !== null) {
            contentSections[contentIndex].classList.remove('hidden');
            currentPageIndex = contentIndex;
          }
        });
      });
      
      // Also handle mobile navigation
      const mobileNavLinks = document.querySelectorAll('.md\\:hidden .nav-link');
      mobileNavLinks.forEach((link, index) => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          
          // Map mobile nav index to content index (0=Dashboard, 2=Notifications, 3=Settings)
          let contentIndex;
          if (index === 0) contentIndex = 0; // Dashboard
          else if (index === 1) contentIndex = 1; // Request Appointment
          else if (index === 2) contentIndex = 2; // Notifications
          else if (index === 3) contentIndex = 3;
          
          // Hide all pages
          contentSections.forEach(section => {
            section.classList.add('hidden');
          });
          
          // Show the selected page
          contentSections[contentIndex].classList.remove('hidden');
          currentPageIndex = contentIndex;
        });
      });
    });

      document.addEventListener('DOMContentLoaded', function() {
        // Function to initialize and render the chart
        function createVisitChart(canvasId, visitData) {
          const ctx = document.getElementById(canvasId).getContext('2d');
          
          return new Chart(ctx, {
            type: 'line',
            data: {
              labels: visitData.labels,
              datasets: [{
                label: 'Clinic Visits',
                data: visitData.values,
                fill: true,
                backgroundColor: 'rgba(66, 153, 225, 0.3)',
                borderColor: 'rgba(66, 153, 225, 0.7)',
                borderWidth: 2,
                tension: 0.4, // Smooth curve
                pointRadius: 3,
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  display: false
                },
                tooltip: {
                  backgroundColor: 'rgba(255, 255, 255, 0.9)',
                  titleColor: '#4A5568',
                  bodyColor: '#4A5568',
                  borderColor: '#E2E8F0',
                  borderWidth: 1,
                  padding: 10,
                  displayColors: false,
                  callbacks: {
                    title: function(tooltipItems) {
                      return tooltipItems[0].label;
                    },
                    label: function(context) {
                      return `${context.parsed.y} visits`;
                    }
                  }
                }
              },
              scales: {
                x: {
                  grid: {
                    display: false
                  },
                  ticks: {
                    color: '#718096'
                  }
                },
                y: {
                  beginAtZero: true,
                  max: 36,
                  ticks: {
                    stepSize: 9,
                    color: '#718096'
                  },
                  grid: {
                    color: '#EDF2F7',
                    drawBorder: true
                  }
                }
              }
            }
          });
        }
  
        // Example data for the chart
        const visitData = {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          values: [1, 0, 0, 0, 0, 1, 2, 4, 5, 2, 1, 0]
        };
  
        // Create the chart
        const visitChart = createVisitChart('visitChart', visitData);
        
        // This function can be used for updating the chart if needed
        function updateChartData(chart, newData) {
          chart.data.labels = newData.labels;
          chart.data.datasets[0].data = newData.values;
          chart.update();
        }
      });
    </script>
</body>
</html>