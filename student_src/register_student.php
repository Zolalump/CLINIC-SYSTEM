<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCTI Clinic - Registration</title>
  <link rel="stylesheet" href="/WebDa/CLINIC-SYSTEM-3/reserve">
  <link rel="icon" href="./src/img/SMC.png" type="image/png">
</head>
<style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #dfe9f3 0%, #ffffff 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-form {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 20px;
      max-width: 700px;
      width: 100%;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .login-form img {
      height: 70px;
    }

    .login-form h1 {
      font-size: 2.2rem;
      color: #091C98;
      margin-bottom: 20px;
      font-weight: 700;
    }

    label {
      font-size: 0.9rem;
      color: #333;
      margin-bottom: 5px;
      display: block;
      font-weight: 500;
    }

    .input-field {
      background-color: #fff;
      border: 1px solid #d0d0d0;
      border-radius: 10px;
      padding: 12px 14px;
      margin-bottom: 16px;
      font-size: 1rem;
      transition: border 0.3s ease, box-shadow 0.3s ease;
      width: 100%;
    }

    .input-field:focus {
      border-color: #091C98;
      outline: none;
      box-shadow: 0 0 0 3px rgba(9, 28, 152, 0.1);
    }

    textarea.input-field {
      resize: vertical;
      min-height: 80px;
    }

    .login-btn {
      background-color: #091C98;
      color: #fff;
      font-weight: 600;
      padding: 12px;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-size: 1rem;
    }

    .login-btn:hover {
      background-color: #16205c;
    }

    .text-center {
      text-align: center;
    }

    .text-sm {
      font-size: 0.875rem;
    }

    a {
      color: #091C98;
      text-decoration: none;
      font-weight: 600;
    }

    a:hover {
      text-decoration: underline;
    }

    select.input-field {
      appearance: none;
      background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
      background-repeat: no-repeat;
      background-position: right 10px center;
      background-size: 16px;
    }
    
  </style>
<body>
  <div class="flex max-sm:justify-center w-screen h-fit py-10 flex-row-reverse overflow-hidden">
    <form class="login-form flex p-4 flex-col justify-center align-middle w-full max-w-2xl bg-[#EEEEEE]/80 rounded-2xl mx-auto" action="register.php" method="POST">
        <div class="flex justify-center mb-4" id="logoSMC">
            <img src="../img/SMC.png" alt="SMC" class="h-20 w-auto" id="logoSMC" />
        </div>

      <h1 class="text-[#484848] font-medium text-3xl text-center mb-4">Create <span class="text-[#091C98] font-semibold">Account</span></h1>

      
      <label for="idnumber">ID Number</label>
      <input type="text" name="idnumber" id="idnumber" required class="input-field">

     
      <label for="name">First Name</label>
      <input type="text" name="fname" id="fname" required class="input-field">
      
      <label for="name">Last Name</label>
      <input type="text" name="lname" id="lname" required class="input-field">

      
      <label for="email">Email</label>
      <input type="email" name="email" id="email" required class="input-field">

      
      <label for="department">Department</label>
      <select name="department" id="department" required class="input-field">
        <option selected disabled value="">Select Department</option>
        <optgroup label="BED">
          <option>Grade School</option>
          <option>Junior High School</option>
          <option>Senior High School</option>
        </optgroup>
        <optgroup label="TEP">
          <option>Bachelor of Arts in Psychology (ABPsych.)</option>
          <option>Bachelor of Science in Business Administration (BSBA)</option>
          <option>Bachelor of Science in Elementary Education (BEED)</option>
          <option>Bachelor of Science in Secondary Education (BSED)</option>
          <option>Bachelor of Science in Civil Engineering (BSCE)</option>
          <option>Bachelor of Science in Nursing (BSN)</option>
          <option>Bachelor of Science in Hospitality Management (BSHM)</option>
          <option>Bachelor of Science in Tourism Management (BSTM)</option>
          <option>Bachelor of Science in Computer Science (BSCS)</option>
          <option>Bachelor of Science in Criminology (BSCrim.)</option>
        </optgroup>
        <option>Graduate Education Program</option>
        <option>Juris Doctor Program</option>
        <optgroup label="PERSONNEL">
          <option>Top Level Institutional Administrator</option>
          <option>HED Middle Level Administrator and Faculty</option>
          <option>BED Middle Level Administrator and Faculty</option>
          <option>Grade School Faculty</option>
          <option>Junior High School Faculty</option>
          <option>Senior High School Faculty</option>
        </optgroup>
        <optgroup label="NTP">
          <option>Finance</option>
          <option>Registrars</option>
          <option>ICT Personnel</option>
          <option>Guidance</option>
          <option>School Clinic</option>
          <option>Admin Assistants</option>
          <option>Campus Ministers</option>
          <option>Canteen Staff</option>
          <option>Laboratory Custodian</option>
          <option>Physical Plant Supervisor</option>
          <option>Property Custodian</option>
          <option>Printing/Binding Office</option>
          <option>Library</option>
          <option>Community Involvement Program</option>
          <option>Maintenance Personnel</option>
          <option>Outsourced Janitorial Services</option>
        </optgroup>
      </select>


      <label for="gender">Gender</label>
      <select name="gender" id="gender" required class="input-field">
        <option value="" selected disabled>Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Prefer not to say">Prefer not to say</option>
      </select>

      <label for="birthdate">Birthdate</label>
      <input type="date" name="birthdate" id="birthdate" required class="input-field">

     
      <label for="phone">Phone Number</label>
      <input type="tel" name="phone" id="phone" pattern="[0-9]{11}" placeholder="09XXXXXXXXX" required class="input-field">

      
      <label for="address">Address</label>
      <textarea name="address" id="address" required class="input-field"></textarea>

      
      <label for="password">Password</label>
      <input type="password" name="password" id="password" required class="input-field">

      
      <label for="confirm_password">Confirm Password</label>
      <input type="password" name="confirm_password" id="confirm_password" required class="input-field">

      
      <button type="submit" class="login-btn bg-[#091C98] hover:bg-[#16205c] text-white font-semibold py-2 px-4 rounded mt-6">Register</button>

      
      <p class="text-center text-sm mt-4">Already have an account? <a href="../login_student.php" class="text-[#091C98] hover:underline">Login</a></p>
    </form>
  </div>

  <style>
    .input-field {
      background-color: #FFFFFF;
      border: 1px solid #D9D9D9;
      border-radius: 6px;
      padding: 10px 12px;
      margin-bottom: 10px;
      font-size: 16px;
      color: #000;
      width: 100%;
    }
    label {
      font-size: 14px;
      color: #484848;
      margin-top: 10px;
    }
  </style>
</body>
</html>
