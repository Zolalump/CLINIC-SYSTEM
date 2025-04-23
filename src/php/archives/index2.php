<?php
session_start();
$message = $_SESSION['message'] ?? '';
$messageType = $_SESSION['message_type'] ?? '';
unset($_SESSION['message'], $_SESSION['message_type']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="..image/WebDaVinci-Logo-Small.webp">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../font/Suisse/stylesheet.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../output.css">
    <title>WebDaVinci - Please Login</title>
    <style>
        #authMessage {
            transition: opacity 0.5s ease-out; 
        }
    </style>
</head>
<body>
    <img class="absolute z-0 bg-contain bg-center bg-no-repeat w-full h-full sm:block hidden " src="../image/heroPageBg.webp" alt="image1">
    <div class="flex items-center justify-center min-h-screen bg-gray-100">

    <section id="signIn" class="flex items-center justify-center min-h-screen bg-gray-100">
        <section class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
          <section class="flex flex-col justify-center p-8 md:p-14">
          <?php if ($message): ?>
            <div id="authMessage" class="<?php echo $messageType === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?> p-4 rounded-md mb-4">
                <?php echo $message; ?>
            </div>
          <?php endif; ?>
          <span class="mb-3 text-4xl font-bold text-green-950">Login</span>
          <span class="font-light text-gray-400 mb-8">Welcome to WebDaVinci!</span>
          <form action="register2.php" method="POST">
            <section class="py-4">
              <label class="mb-2 text-md">Email</label>
              <input
                type="text"
                placeholder="Email"
                name="email"
                id="email"
                class="w-full p-2 border border-gray-300 rounded-md duration-150 transition-colors hover:ring-[1px] hover:ring-blue-400 focus:ring-[1px] focus:ring-blue-400 outline-none placeholder:font-light placeholder:text-gray-500"
              />
            </section>
            <section class="py-4">
              <label class="mb-2 text-md">Password</label>
              <div class="relative">
                    <input
                      type="password"
                      placeholder="Password"
                      name="pass"
                      id="pass"
                      class="w-full p-2 border border-gray-300 rounded-md duration-150 transition-colors hover:ring-[1px] hover:ring-blue-400 focus:ring-[1px] focus:ring-blue-400 outline-none placeholder:font-light placeholder:text-gray-500"
                    />
                    <button
                        type="button"
                        id="togglePassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"
                    >
                    <div style="font-size: x-large;">
                        <i class='bx bx-show' id="showIcon"></i>
                        <i class='bx bx-hide' id="hideIcon" style="display: none;"></i>
                    </div>      
                    </button>
                </div>
            </section>
            <section class="flex justify-end mb-3">
              <a href="forgot-pass2.php" class="text-sm font-medium text-primary-600 hover:underline dark:text-green-900">Forgot password?</a>
            </section>
            <input
              type="submit"
              class="w-full bg-green-950 text-white p-2 rounded-lg mb-6 duration-150 transition-colors hover:cursor-pointer hover:text-green-950 hover:bg-white hover:ring-[1px] hover:ring-green-950"
              value="Sign In"
              name="signIn"
            />
          </form>
          <section class="text-center text-gray-400">
            Don't have an account?
            <button id="signUpButton" class="font-bold text-green-950 mt-15">Sign Up</button>
          </section>
        </section>
      </section>
    </section>
  
    
    <section id="signup" class="h-dvh w-dvh hidden">
      <section class="flex items-center justify-center min-h-screen bg-gray-100">
        <section class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
          <section class="flex flex-col justify-center p-8 md:p-12">
            <span class="mb-3 text-4xl font-bold text-green-950">Sign Up</span>
            <span class="font-light text-gray-400">Welcome to WebDaVinci!</span>
            <form action="./src/php/register2.php " method="POST">
              <section class="py-2">
                <label class="text-md">First Name</label>
                <input type="text" name="fName" placeholder="Enter First Name" class="w-full p-2 border duration-150 transition-colors hover:ring-[1px] hover:ring-blue-400 focus:ring-[1px] focus:ring-blue-400 outline-none border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
              </section>
              <section class="py-2">
                <label class="text-md">Last Name</label>
                <input type="text" name="lName" placeholder="Enter Last Name" class="w-full p-2 border duration-150 transition-colors hover:ring-[1px] hover:ring-blue-400 focus:ring-[1px] focus:ring-blue-400 outline-none border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
              </section>
              <section class="py-2">
                <label class="text-md">Email</label>
                <input
                  type="email"
                  placeholder="Enter Email"
                  name="email"
                  id="email"
                  class="w-full p-2 border border-gray-300 rounded-md transition-colors hover:ring-[1px] hover:ring-blue-400 focus:ring-[1px] focus:ring-blue-400 outline-none placeholder:font-light placeholder:text-gray-500"
                />
              </section>
              <section class="py-">
                <label class="text-md">Password</label>
                <div class="relative">
                  <input 
                    type="password" 
                    name="password" 
                    id="password2"
                    placeholder="Enter Password" 
                    class="w-full p-2 border duration-150 transition-colors hover:ring-[1px] hover:ring-blue-400 focus:ring-[1px] focus:ring-blue-400 outline-none border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" 
                    />
                    <button
                        type="button"
                        id="togglePassword2"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"
                    >
                    <div style="font-size: x-large;">
                        <i class='bx bx-show' id="showIcon2"></i>
                        <i class='bx bx-hide' id="hideIcon2" style="display: none;"></i>
                    </div>      
                </div>
              </section class="mb-5">
              <section class="py-2 mb-5">
                    <label class="text-md">Confirm Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="confirm_password" 
                            id="ConfirmPass" 
                            placeholder="Enter Confirm Password"
                            class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" 
                            required 
                        />
                        <button 
                            type="button" 
                            id="toggleConfirmPass" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"
                        >
                        <div style="font-size: x-large; margin: none;">
                            <i class='bx bx-show' id="showIcon3"></i>
                            <i class='bx bx-hide' id="hideIcon3" style="display: none;"></i>
                        </div>    
                        </button>
                    </div>
                </section>
                <input
                type="submit"
                class="w-full bg-green-950 text-white p-2 rounded-lg mb-6 duration-150 transition-colors hover:cursor-pointer hover:text-green-950 hover:bg-white hover:ring-[1px] hover:ring-green-950"
                value="Sign Up"
                name="signUp"
              />
            </form>
            <section class="text-center text-gray-400" style="margin-top: 10px;">
              Already have an account?
              <button id="signInButton" class="font-bold text-green-950 mt-2">Login</button>
            </section>
          </section>
        </section>
      </section>
    </section>

  <script src="./src/js/script.js"></script>
        <script>
          function hideMessage() {
            const messageDiv = document.getElementById('authMessage');
            if (messageDiv) {
                setTimeout(() => {
                    messageDiv.style.opacity = '0'; 
                    setTimeout(() => {
                        messageDiv.remove(); 
                    }, 500); 
                }, 3000); 
            }
        }  

        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('pass');
            const showIcon = document.getElementById('showIcon');
            const hideIcon = document.getElementById('hideIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showIcon.style.display = 'none';
                hideIcon.style.display = 'inline';
            } else {
                passwordInput.type = 'password';
                showIcon.style.display = 'inline';
                hideIcon.style.display = 'none';
            }
        });

        document.getElementById('togglePassword2').addEventListener('click', function() {
            const passwordInput = document.getElementById('password2');
            const showIcon = document.getElementById('showIcon2');
            const hideIcon = document.getElementById('hideIcon2');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showIcon.style.display = 'none';
                hideIcon.style.display = 'inline';
            } else {
                passwordInput.type = 'password';
                showIcon.style.display = 'inline';
                hideIcon.style.display = 'none';
            }
        });

        document.getElementById('toggleConfirmPass').addEventListener('click', function() {
            const passwordInput = document.getElementById('ConfirmPass');
            const showIcon = document.getElementById('showIcon3');
            const hideIcon = document.getElementById('hideIcon3');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showIcon.style.display = 'none';
                hideIcon.style.display = 'inline';
            } else {
                passwordInput.type = 'password';
                showIcon.style.display = 'inline';
                hideIcon.style.display = 'none';
            }
        });
        window.onload = hideMessage;
  </script>
</body>
</html>
