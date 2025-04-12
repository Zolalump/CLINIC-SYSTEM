// Handle form toggling
const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signup');

signUpButton.addEventListener('click', function (event) {
  event.preventDefault(); // Prevent default button behavior
  signInForm.classList.add('hidden');
  signUpForm.classList.remove('hidden');
});

signInButton.addEventListener('click', function (event) {
  event.preventDefault(); // Prevent default button behavior
  signUpForm.classList.add('hidden');
  signInForm.classList.remove('hidden');
});


// Email validation on blur
const emailField = document.getElementById('email');
const emailFeedback = document.getElementById('emailFeedback');

emailField.addEventListener('blur', function () {
    const email = emailField.value.trim();

    // Clear previous feedback
    emailFeedback.textContent = '';
    emailFeedback.style.color = 'gray';

    if (email === '') {
        emailFeedback.textContent = 'Email cannot be empty.';
        emailFeedback.style.color = 'red';
        return;
    }

    // Call backend to validate email
    fetch('register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ validateEmail: true, email: email })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            emailFeedback.textContent = data.message; // Valid email
            emailFeedback.style.color = 'green';
        } else {
            emailFeedback.textContent = data.message; // Invalid email
            emailFeedback.style.color = 'red';
        }
    })
    .catch(error => {
        emailFeedback.textContent = 'Error verifying email. Please try again.';
        emailFeedback.style.color = 'red';
        console.error('Error:', error);
    });
});

