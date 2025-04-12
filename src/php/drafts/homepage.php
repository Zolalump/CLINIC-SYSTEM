<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
$email = $_SESSION['email'];

$query = $conn->prepare("SELECT firstName, lastName FROM users WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>login</title>
</head>
<body>
    <img class="absolute z-0 bg-contain bg-center bg-no-repeat w-full h-full sm:block hidden " src="students.jpg" alt="image1">
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <section id="signIn" class="flex items-center justify-center min-h-screen bg-gray-100">
        <section class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
          <section class="flex flex-col justify-center p-8 md:p-14">
            <span class="mb-3 text-4xl font-bold text-blue-900">Login</span>
            <span class="font-light text-gray-400 mb-8">Welcome Marianss!</span>
            <form action="" method="POST">
              <section class="py-4">
                <label class="mb-2 text-md">ID number</label>
                <input
                  type="text"
                  placeholder="Enter ID number"
                  name="id"
                  id="id"
                  class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
                />
              </section>
              <section class="py-4  ">
                <label class="mb-2 text-md">Password</label>
                <input
                  type="password"
                  placeholder="Password"
                  name="pass"
                  id="pass"
                  class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
                />
              </section>
              <section class="text-center text-gray-400">
                Don't have an account?
                <button id="signUpButton" class="font-bold text-blue-900 mt-15">Sign Up</button>
              </section>
              <section class="flex justify-end mt-3">
                <a href="/reserve.html" class="w-full">
                    <button
                        type="button"
                        class="w-full bg-blue-900 text-white p-2 rounded-lg mb-6 hover:bg-white hover:text-black hover:border hover:border-gray-300"
                    >
                        Sign In
                    </button>
                </a>
            </section>
            </form>
          </section>
        </section>
      </section>

      <section id="signup" class="h-dvh w-dvh hidden">
        <section class="flex items-center justify-center min-h-screen bg-gray-100">
          <section class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
            <section class="flex flex-col justify-center p-8 md:p-12">
              <span class="mb-3 text-4xl font-bold text-blue-900">Sign Up</span>
              <span class="font-light text-gray-400">Welcome to Marians!</span>
              <form action="register.php" method="POST">
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
                  <input type="password" name="password" placeholder="Enter Password" class="w-full p-2 border duration-150 transition-colors hover:ring-[1px] hover:ring-blue-400 focus:ring-[1px] focus:ring-blue-400 outline-none border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
                </section class="mb-5">
                <section class="py-2 mb-5">
                      <label class="text-md">Confirm Password</label>
                      <div class="relative">
                          <input 
                              type="password" 
                              name="confirm_password" 
                              id="confirmPassword" 
                              placeholder="Enter Confirm Password"
                              class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" 
                              required 
                          />
                          <button 
                              type="button" 
                              id="toggleConfirmPassword" 
                              class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-500 focus:outline-none"
                          >
                          </button>
                      </div>
                  </section>
                  <input
                  type="submit"
                  class="w-full bg-blue-900 text-white p-2 rounded-lg mb-6 duration-150 transition-colors hover:cursor-pointer hover:text-blue-900 hover:bg-white hover:ring-[1px] hover:ring-green-950"
                  value="Sign Up"
                  name="signUp"
                />
              </form>
              <section class="text-center text-gray-400">
                Already have an account?
                <button id="signInButton" class="font-bold text-blue-900">Login</button>
              </section>
            </section>
          </section>
        </section>
      </section>

      <script src="script.js"></script>
  </body>
</html>