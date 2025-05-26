<?php
session_start();
include '../db.php';

$students = $conn->query("SELECT * FROM archived_log_entries WHERE department = 'basic-education'");
$faculty = $conn->query("SELECT * FROM archived_log_entries WHERE department = 'tertiary'");
$personnels = $conn->query("SELECT * FROM archived_log_entries WHERE department = 'personnel'");

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
            <button
              type='button'
              class='bg-green-600 text-white px-3 py-1 rounded-md text-sm font-semibold hover:bg-green-800 transition-colors duration-300 open-restore-modal'
              data-id='$id'
              data-name=\"$name\"
            >Restore</button>
          </td>
        </tr>
      ";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
  } else {
    echo "<p class='text-gray-500 italic'>No logs found.</p>";
  }

  echo "</section>";
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Archived Logs - SMCTI</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="../../img/logo sa smc.png" />
  <link rel="stylesheet" href="/WebDa/booking/font/Suisse/stylesheet.css" />
  <style>
    body { font-family: 'Suisse', sans-serif; font-weight: 400 !important; }
    @keyframes fadeInDown {
      from { transform: translateY(-10px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
    .fade-in-down { animation: fadeInDown 0.3s ease-out; }
  </style>
</head>
<body class="bg-gray-50" style="margin: 30px;">
  <?php if (isset($_SESSION['message'])): ?>
    <div class="fixed top-6 right-6 bg-green-100 text-green-800 px-4 py-3 rounded-lg shadow fade-in-down z-50">
      <?= $_SESSION['message']; unset($_SESSION['message']); ?>
    </div>
  <?php endif; ?>

  <main>
    <div class="min-h-screen p-4 md:p-8 max-w-7xl mx-auto">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">
            Archived Logbooks
            <div class="text-lg font-light text-gray-600">View and restore deleted logs</div>
          </h1>
        </div>
        <a href="dashboard.php" class="ml-auto bg-gradient-to-r from-blue-600 to-blue-400 text-white font-semibold py-2 px-6 rounded-lg shadow-lg hover:from-blue-700 hover:to-blue-500 transition-all duration-300 ease-in-out flex items-center">
          ← Go Back
        </a>
      </div>

      <div class="space-y-10">
        <?php
          renderUserTable("Basic Education Program", $students);
          renderUserTable("Tertiary Education Program", $faculty);
          renderUserTable("Archived Personnels", $personnels);
        ?>
      </div>
    </div>
  </main>

    <!-- Restore Confirmation Modal -->
    <div id="restoreModal" class="fixed inset-0 z-50 hidden bg-black/40 backdrop-blur-sm flex items-center justify-center transition-all">
    <div class="bg-white p-6 rounded-xl shadow-xl w-[95%] max-w-sm fade-in-down">
        <h3 class="text-xl font-semibold text-green-600 flex items-center gap-2 mb-2">
        <i data-lucide="rotate-ccw" class="w-5 h-5"></i> Confirm Restoration
        </h3>
        <p class="text-gray-600 text-sm mb-4">
        Are you sure you want to restore <span id="restoreUserName" class="font-medium text-green-600"></span>?
        </p>
        <form id="restoreForm" method="POST" action="restore_user.php">
        <input type="hidden" name="id" id="restoreUserId" />
        <div class="flex justify-end gap-3">
            <button type="button" class="cancel-restore px-4 py-2 text-gray-600 hover:text-gray-900">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">Yes, Restore</button>
        </div>
        </form>
    </div>
    </div>

<style>
  @keyframes fadeIn {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
  }
  @keyframes fadeInDown {
    from { transform: translateY(-10px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
  }
  .fade-in-down {
    animation: fadeInDown 0.3s ease-out;
  }
  .animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
  }
</style>


  <script>
  const restoreModal = document.getElementById("restoreModal");
  const restoreUserId = document.getElementById("restoreUserId");
  const restoreUserName = document.getElementById("restoreUserName");

  document.querySelectorAll(".open-restore-modal").forEach(btn => {
    btn.addEventListener("click", () => {
      restoreUserId.value = btn.dataset.id;
      restoreUserName.textContent = btn.dataset.name;
      restoreModal.classList.remove("hidden");
    });
  });

  document.querySelector(".cancel-restore").addEventListener("click", () => {
    restoreModal.classList.add("hidden");
  });

  restoreModal.addEventListener("click", (e) => {
    if (e.target === restoreModal) {
      restoreModal.classList.add("hidden");
    }
  });

  // ✅ Initialize Lucide icons after it's fully loaded
  document.addEventListener("DOMContentLoaded", function () {
    lucide.createIcons();
  });
  </script>
  <script src="https://unpkg.com/lucide@latest"></script>
  
</body>
</html>
