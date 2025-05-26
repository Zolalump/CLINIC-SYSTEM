<?php
session_start();
include '../db.php';

// Adjust these department names to match your actual DB values
$students = $conn->query("SELECT * FROM log_entries WHERE department = 'basic-education'");
$faculty = $conn->query("SELECT * FROM log_entries WHERE department = 'tertiary'");
$personnels = $conn->query("SELECT * FROM log_entries WHERE department = 'personnel'");

function renderUserTable($title, $resultSet) {
  echo "<section>";
  echo "<h2 class='text-2xl font-semibold text-blue-800 mb-4'>$title</h2>";

  if ($resultSet->num_rows > 0) {
    echo "<div class='overflow-x-auto rounded-lg shadow bg-white max-h-[300px] overflow-y-auto'>";
    echo "<table class='min-w-full divide-y divide-gray-200'>";
    echo "<thead class='bg-blue-100 sticky top-0 z-10'>";
    echo "<tr>";
    echo "<th scope='col' class='px-6 py-3 text-left text-xs font-medium text-blue-900 uppercase tracking-wider'>Name</th>";
    echo "<th scope='col' class='px-6 py-3 text-left text-xs font-medium text-blue-900 uppercase tracking-wider'>Classification</th>";
    echo "<th scope='col' class='px-6 py-3 w-28 text-center text-xs font-medium text-blue-900 uppercase tracking-wider'>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody class='divide-y divide-gray-100'>";
    
    while ($row = $resultSet->fetch_assoc()) {
      $id = $row['id'];
      $name = htmlspecialchars($row['name']);
      $classification = htmlspecialchars($row['classification']);
      echo "
        <tr class='hover:bg-blue-50 transition'>
          <td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900'>$name</td>
          <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-700'>$classification</td>
          <td class='px-6 py-4 whitespace-nowrap text-center'>
            <button type='button' 
                    data-id='$id' 
                    data-name=\"$name\" 
                    class='open-delete-modal bg-red-600 text-white px-3 py-1 rounded-md text-sm font-semibold hover:bg-red-800 transition-colors duration-300'>
              Delete
            </button>
          </td>
        </tr>
      ";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
  } else {
    echo "<p class='text-gray-500 italic'>No log found.</p>";
  }

  echo "</section>";
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SMCTI</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="../../img/logo sa smc.png" />
  <link rel="stylesheet" href="/WebDa/booking/font/Suisse/stylesheet.css" />
  <style>
    body {
      font-family: 'Suisse', sans-serif;
      font-weight: 400 !important;
    }
  </style>
</head>
<body class="bg-gray-50" style="margin: 30px;">
  <main>
    <div class="min-h-screen p-4 md:p-8 max-w-7xl mx-auto">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">
            Dashboard
            <div class="text-lg font-light text-gray-600">Logbook Dashboard below</div>
          </h1>
        </div>

        <div class="flex gap-3">
          <a href="archive_users.php" 
            class="bg-gray-300 hover:bg-gray-400 text-gray-900 font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out flex items-center">
            📦 Archived Logbook
          </a>

          <a href="../dashboard.php"
            class="bg-gradient-to-r from-blue-600 to-blue-400 text-white font-semibold py-2 px-6 rounded-lg shadow-lg hover:from-blue-700 hover:to-blue-500 transition-all duration-300 ease-in-out flex items-center">
            ← Go Back
          </a>
        </div>
      </div>

      <div class="space-y-10">
        <?php
          renderUserTable("Basic Education Program", $students);
          renderUserTable("Tertiary Education Program", $faculty);
          renderUserTable("Personnels", $personnels);
        ?>
      </div>
    </div>
  </main>

  <!-- Delete Confirmation Modal -->
  <div id="deleteModal" class="fixed inset-0 z-50 hidden bg-black/40 backdrop-blur-sm flex items-center justify-center transition-all">
    <div class="bg-white p-6 rounded-xl shadow-xl w-[95%] max-w-sm animate-fadeIn">
      <h3 class="text-xl font-semibold text-red-600 flex items-center gap-2 mb-2">
        <i data-lucide="alert-triangle" class="w-5 h-5"></i> Confirm Deletion
      </h3>
      <p class="text-gray-600 text-sm mb-4">
        Are you sure you want to delete <span id="deleteUserName" class="font-medium text-red-500"></span>?
      </p>
      <form id="deleteForm" method="POST" action="delete_user.php">
        <input type="hidden" name="id" id="deleteUserId" />
        <div class="flex justify-end gap-3">
          <button type="button" class="cancel-btn px-4 py-2 text-gray-600 hover:text-gray-900">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">Yes, Delete</button>
        </div>
      </form>
    </div>
  </div>

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
            const buttons = document.querySelectorAll(".tab-button");
            const panes = document.querySelectorAll(".tab-pane");

            // Initialize: show first tab and set active button
            buttons.forEach((btn, i) => {
              if (i === 0) {
                btn.classList.remove("bg-blue-700");
                btn.classList.add("bg-blue-900");
              } else {
                btn.classList.remove("bg-blue-900");
                btn.classList.add("bg-blue-700");
              }
            });
            panes.forEach((pane, i) => {
              if (i === 0) pane.classList.remove("hidden");
              else pane.classList.add("hidden");
            });

            buttons.forEach((button) => {
              button.addEventListener("click", () => {
                const target = button.getAttribute("data-tab");

                // Toggle active button style
                buttons.forEach((btn) => {
                  btn.classList.remove("bg-blue-900");
                  btn.classList.add("bg-blue-700");
                });
                button.classList.remove("bg-blue-700");
                button.classList.add("bg-blue-900");

                // Show the correct tab content
                panes.forEach((pane) => {
                  pane.classList.add("hidden");
                  if (pane.getAttribute("data-tab") === target) {
                    pane.classList.remove("hidden");
                  }
                });
              });
            });
          });

    document.addEventListener("DOMContentLoaded", function () {
          lucide.createIcons();

          const modal = document.getElementById("deleteModal");
          const deleteUserId = document.getElementById("deleteUserId");
          const deleteUserName = document.getElementById("deleteUserName");

          document.querySelectorAll(".open-delete-modal").forEach(btn => {
            btn.addEventListener("click", () => {
              deleteUserId.value = btn.dataset.id;
              deleteUserName.textContent = btn.dataset.name;
              modal.classList.remove("hidden");
            });
          });

          document.querySelector(".cancel-btn").addEventListener("click", () => {
            modal.classList.add("hidden");
            deleteUserId.value = "";
            deleteUserName.textContent = "";
          });

          modal.addEventListener("click", (e) => {
            if (e.target === modal) modal.classList.add("hidden");
          });
        });
      </script>

      <style>
        @keyframes fadeIn {
          from { transform: translateY(20px); opacity: 0; }
          to { transform: translateY(0); opacity: 1; }
        }
        .animate-fadeIn {
          animation: fadeIn 0.3s ease-out;
        }
      </style>
      </script>
      <script src="https://unpkg.com/lucide@latest"></script>
  </body>
</html>
