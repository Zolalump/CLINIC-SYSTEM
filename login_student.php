<?php
// Start session
session_start();

// Include database connection
include('db.php');

// Initialize error variable
$error = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idnumber = $_POST['idnumber'];
    $department = $_POST['department'];
    $password = $_POST['password'];

    // Validate input
    if (empty($idnumber) || empty($department) || empty($password)) {
        $error = "All fields are required!";
    } else {
        // Escape input to prevent SQL injection
        $idnumber = mysqli_real_escape_string($conn, $idnumber);
        $department = mysqli_real_escape_string($conn, $department);

        // Query the database to find the user
        $query = "SELECT * FROM user_client WHERE idnumber = '$idnumber' AND department = '$department'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Store session
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['fname'] . ' ' . $user['lname'];
                $_SESSION['idnumber'] = $user['idnumber'];
                $_SESSION['department'] = $user['department'];
                $_SESSION['email'] = $user['email'];

                // Redirect to the dashboard
                header('Location: student_src/dashboard.php');
                exit();
            } else {
                $error = "Invalid password!";
            }
        } else {
            $error = "User not found or department mismatch!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./src/img/SMC.png" type="image/png">
    <title>SMCTI Clinic - Please Login</title>
    <link rel="stylesheet" href="./src/css/index.css">
    <script async src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex max-sm:justify-center w-screen h-screen max-sm:items-center flex-row-reverse overflow-hidden">
        <!-- FIXED: Changed form action to submit to the same page -->
        <form class="login-form flex p-2 lg:p-4 max-sm:p-0 flex-col justify-center align-middle h-fit w-fit md:w-1/2 md:h-dvh max-lg:rounded-none bg-[#EEEEEE]/80 z-50 max-sm:rounded-2xl" method="POST" action="">
          <div class="flex justify-center mt-2">
            <img class="" src="img/SMC.png" alt="SMC">
          </div>
          <div class="welcome-text flex flex-col justify-center align-middle text-center opacity-100 mt-8">
            <h1 class="text-[#484848] font-medium text-3xl">Welcome <span class="text-[#091C98] font-semibold">Marians!</span></h1>
            <p class="text-[#676869] text-sm">I hope you have a good stay and enjoy exploring the application.</p>
          </div>
          
          <!-- Display error message if exists -->
          <?php if (!empty($error)): ?>
          <div class="mx-6 mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
            <?php echo htmlspecialchars($error); ?>
          </div>
          <?php endif; ?>
          
          <div class="flex flex-col p-6 gap-4 bg-opacity-100">
            <div class="flex flex-col">
              <label for="id" class="text-sm text-gray-600">ID Number</label>
              <div class="flex items-center relative group">
                <div class="icon-container">
                  <img src="data:image/svg+xml,%3csvg%20width='30'%20height='23'%20viewBox='0%200%2030%2023'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3cpath%20d='M5.59086%204.05469H25.1146C26.4569%204.05469%2027.5551%204.89496%2027.5551%205.92195V17.1255C27.5551%2018.1525%2026.4569%2018.9928%2025.1146%2018.9928H5.59086C4.2486%2018.9928%203.15039%2018.1525%203.15039%2017.1255V5.92195C3.15039%204.89496%204.2486%204.05469%205.59086%204.05469Z'%20stroke='black'%20stroke-opacity='0.9'%20stroke-width='1.01499'%20stroke-linecap='round'%20stroke-linejoin='round'/%3e%3cpath%20d='M27.5551%205.92188L15.3528%2012.4573L3.15039%205.92188'%20stroke='black'%20stroke-opacity='0.9'%20stroke-width='1.01499'%20stroke-linecap='round'%20stroke-linejoin='round'/%3e%3c/svg%3e" alt="User">
                </div>
                <input class="input-field bg-[#FFFFFF] border border-[#D9D9D9] w-full rounded-md pl-12 py-3 text-[#000000] text-base outline-none text-base focus:border-[#091C98] transition-all duration-300" type="text" name="idnumber" id="id" placeholder="Enter ID Number" value="<?php echo isset($_POST['idnumber']) ? htmlspecialchars($_POST['idnumber']) : ''; ?>" required>
              </div>
            </div>
            <div class="flex flex-col">
              <label for="department" class="text-sm text-gray-600">Department</label>
              <div class="flex items-center relative group">
                <div class="icon-container">
                  <img src="img/dep.png" alt="Department">
                </div>
                <select class="input-field bg-[#FFFFFF] border border-[#D9D9D9] w-full rounded-md pl-12 py-3 text-[#000000] text-base outline-none text-base focus:border-[#091C98] transition-all duration-300" name="department" id="department" required>
                  <option disabled value="">Select Department</option>
                  <optgroup label="BED">
                    <option value="Grade School" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Grade School') ? 'selected' : ''; ?>>Grade School</option>
                    <option value="Junior High School" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Junior High School') ? 'selected' : ''; ?>>Junior High School</option>
                    <option value="Senior High School" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Senior High School') ? 'selected' : ''; ?>>Senior High School</option>
                  </optgroup>
                  <optgroup label="TEP">
                    <option value="Bachelor of Arts in Psychology (ABPsych.)" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Bachelor of Arts in Psychology (ABPsych.)') ? 'selected' : ''; ?>>Bachelor of Arts in Psychology (ABPsych.)</option>
                    <option value="Bachelor of Science in Business Administration (BSBA)" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Bachelor of Science in Business Administration (BSBA)') ? 'selected' : ''; ?>>Bachelor of Science in Business Administration (BSBA)</option>
                    <option value="Bachelor of Science in Elementary Education (BEED)" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Bachelor of Science in Elementary Education (BEED)') ? 'selected' : ''; ?>>Bachelor of Science in Elementary Education (BEED)</option>
                    <option value="Bachelor of Science in Secondary Education (BSED)" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Bachelor of Science in Secondary Education (BSED)') ? 'selected' : ''; ?>>Bachelor of Science in Secondary Education (BSED)</option>
                    <option value="Bachelor of Science in Civil Engineering (BSCE)" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Bachelor of Science in Civil Engineering (BSCE)') ? 'selected' : ''; ?>>Bachelor of Science in Civil Engineering (BSCE)</option>
                    <option value="Bachelor of Science in Nursing (BSN)" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Bachelor of Science in Nursing (BSN)') ? 'selected' : ''; ?>>Bachelor of Science in Nursing (BSN)</option>
                    <option value="Bachelor of Science in Hospitality Management (BSHM)" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Bachelor of Science in Hospitality Management (BSHM)') ? 'selected' : ''; ?>>Bachelor of Science in Hospitality Management (BSHM)</option>
                    <option value="Bachelor of Science in Tourism Management (BSTM)" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Bachelor of Science in Tourism Management (BSTM)') ? 'selected' : ''; ?>>Bachelor of Science in Tourism Management (BSTM)</option>
                    <option value="Bachelor of Science in Computer Science (BSCS)" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Bachelor of Science in Computer Science (BSCS)') ? 'selected' : ''; ?>>Bachelor of Science in Computer Science (BSCS)</option>
                    <option value="Bachelor of Science in Criminology (BSCrim.)" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Bachelor of Science in Criminology (BSCrim.)') ? 'selected' : ''; ?>>Bachelor of Science in Criminology (BSCrim.)</option>
                  </optgroup>
                  <option value="Graduate Education Program" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Graduate Education Program') ? 'selected' : ''; ?>>Graduate Education Program</option>
                  <option value="Juris Doctor Program" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Juris Doctor Program') ? 'selected' : ''; ?>>Juris Doctor Program</option>
                  <optgroup label="PERSONNEL">
                    <option value="Top Level Institutional Administrator" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Top Level Institutional Administrator') ? 'selected' : ''; ?>>Top Level Institutional Administrator</option>
                    <option value="HED Middle Level Administrator and Faculty" <?php echo (isset($_POST['department']) && $_POST['department'] == 'HED Middle Level Administrator and Faculty') ? 'selected' : ''; ?>>HED Middle Level Administrator and Faculty</option>
                    <option value="BED Middle Level Administrator and Faculty" <?php echo (isset($_POST['department']) && $_POST['department'] == 'BED Middle Level Administrator and Faculty') ? 'selected' : ''; ?>>BED Middle Level Administrator and Faculty</option>
                    <option value="Grade School Faculty" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Grade School Faculty') ? 'selected' : ''; ?>>Grade School Faculty</option>
                    <option value="Junior High School Faculty" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Junior High School Faculty') ? 'selected' : ''; ?>>Junior High School Faculty</option>
                    <option value="Senior High School Faculty" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Senior High School Faculty') ? 'selected' : ''; ?>>Senior High School Faculty</option>
                  </optgroup>
                  <optgroup label="NTP">
                    <option value="Finance" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Finance') ? 'selected' : ''; ?>>Finance</option>
                    <option value="Registrars" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Registrars') ? 'selected' : ''; ?>>Registrars</option>
                    <option value="ICT Personnel" <?php echo (isset($_POST['department']) && $_POST['department'] == 'ICT Personnel') ? 'selected' : ''; ?>>ICT Personnel</option>
                    <option value="Guidance" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Guidance') ? 'selected' : ''; ?>>Guidance</option>
                    <option value="School Clinic" <?php echo (isset($_POST['department']) && $_POST['department'] == 'School Clinic') ? 'selected' : ''; ?>>School Clinic</option>
                    <option value="Admin Assistants" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Admin Assistants') ? 'selected' : ''; ?>>Admin Assistants</option>
                    <option value="Campus Ministers" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Campus Ministers') ? 'selected' : ''; ?>>Campus Ministers</option>
                    <option value="Canteen Staff" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Canteen Staff') ? 'selected' : ''; ?>>Canteen Staff</option>
                    <option value="Laboratory Custodian" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Laboratory Custodian') ? 'selected' : ''; ?>>Laboratory Custodian</option>
                    <option value="Physical Plant Supervisor" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Physical Plant Supervisor') ? 'selected' : ''; ?>>Physical Plant Supervisor</option>
                    <option value="Property Custodian" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Property Custodian') ? 'selected' : ''; ?>>Property Custodian</option>
                    <option value="Printing/Binding Office" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Printing/Binding Office') ? 'selected' : ''; ?>>Printing/Binding Office</option>
                    <option value="Library" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Library') ? 'selected' : ''; ?>>Library</option>
                    <option value="Community Involvement Program" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Community Involvement Program') ? 'selected' : ''; ?>>Community Involvement Program</option>
                    <option value="Maintainance Personnel" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Maintainance Personnel') ? 'selected' : ''; ?>>Maintainance Personnel</option>
                    <option value="Outsourced Janitorial Services" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Outsourced Janitorial Services') ? 'selected' : ''; ?>>Outsourced Janitorial Services</option>
                  </optgroup>
                </select>
              </div>
            </div>
            <div class="flex flex-col">
              <label for="ps" class="text-sm text-gray-600">Password</label>
              <div class="flex items-center relative group">
                <div class="icon-container">
                  <img class="opacity-90" src="data:image/svg+xml,%3csvg%20width='23'%20height='23'%20viewBox='0%200%2023%2023'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3crect%20width='22.0763'%20height='22.0763'%20transform='translate(0.396484%200.796875)'%20fill='white'/%3e%3cpath%20d='M17.8738%2010.916H4.99594C3.97991%2010.916%203.15625%2011.7397%203.15625%2012.7557V19.1946C3.15625%2020.2107%203.97991%2021.0343%204.99594%2021.0343H17.8738C18.8898%2021.0343%2019.7135%2020.2107%2019.7135%2019.1946V12.7557C19.7135%2011.7397%2018.8898%2010.916%2017.8738%2010.916Z'%20stroke='black'%20stroke-opacity='0.9'%20stroke-linecap='round'%20stroke-linejoin='round'/%3e%3cpath%20d='M6.83496%2010.9153V7.23595C6.83496%206.01616%207.31952%204.84633%208.18205%203.9838C9.04457%203.12128%2010.2144%202.63672%2011.4342%202.63672C12.654%202.63672%2013.8238%203.12128%2014.6863%203.9838C15.5489%204.84633%2016.0334%206.01616%2016.0334%207.23595V10.9153'%20stroke='black'%20stroke-opacity='0.9'%20stroke-linecap='round'%20stroke-linejoin='round'/%3e%3c/svg%3e" alt="Password">
                </div>
                <input class="input-field bg-[#FFFFFF] border border-[#D9D9D9] w-full rounded-md pl-12 py-3 text-[#000000] outline-none text-base focus:border-[#091C98] transition-colors duration-300" type="password" name="password" id="ps" placeholder="Enter Password" required>
                <div class="absolute right-3 cursor-pointer password-toggle" id="toggle-password">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="flex flex-row justify-between px-8 items-center">
            <div class="flex items-center">
              <input class="accent-[#091C98] scale-[1.5] cursor-pointer" value="" type="checkbox" name="remember" id="rem" placeholder="Remember Me">
              <label class="px-2 text-[#707070] text-sm align-middle cursor-pointer" for="rem">Remember Me</label>
            </div>
            <a class="text-[#091C98] cursor-pointer text-xs text-center hover:underline transition-all duration-200" href="" rel="noopener noreferrer">Forgot Password?</a>
          </div>
        <div class="flex justify-center w-full my-8 cursor-pointer">
            <button class="login-btn block w-full mx-6 bg-[#091C98] hover:bg-[#16205c] ease-in duration-100 text-[#FFFFFF] text-lg font-semibold px-52 py-2 rounded-lg opacity-100 max-sm:px-28 max-md:px-28" type="submit">Login</button>
        </div>
        <div class="text-center mt-4">
        <p class="text-sm text-gray-600">Don't have an account?
          <a href="student_src/register_student.php" class="text-[#091C98] font-semibold hover:underline">Sign up</a>
        </p>
        </div>
        </form>
        <div class="max-sm:absolute w-full md:w-1/2 max-md:flex z-0 overflow-hidden bg-[#091C98] object-cover">
          <img class="z-0 w-full h-dvh mix-blend-hard-light object-fill" src="./img/loginBg.png" alt="SMC BG">
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          // Show/Hide Password Toggle
          const togglePassword = document.getElementById('toggle-password');
          const passwordInput = document.getElementById('ps');
          
          togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Change the eye icon
            if (type === 'text') {
              this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
              </svg>`;
            } else {
              this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>`;
            }
          });
          
          // Animate input fields on focus
          const inputFields = document.querySelectorAll('.input-field');
          
          inputFields.forEach(field => {
            field.addEventListener('focus', function() {
              this.parentElement.classList.add('shadow-md');
              // Make sure the icon stays visible by adding a background to it
              const iconContainer = this.parentElement.querySelector('.icon-container');
              if (iconContainer) {
                iconContainer.style.zIndex = '20';
              }
            });
            
            field.addEventListener('blur', function() {
              this.parentElement.classList.remove('shadow-md');
            });
          });
          
          // Login button animation
          const loginButton = document.querySelector('.login-btn');
          
          loginButton.addEventListener('mousedown', function() {
            this.classList.add('scale-95');
            setTimeout(() => {
              this.classList.remove('scale-95');
            }, 150);
          });
        });
      </script>
</body>
</html>