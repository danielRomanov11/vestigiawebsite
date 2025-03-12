const signUpForm = document.getElementById('signUpForm');
const loginForm = document.getElementById('loginForm');
const fullname_input = document.getElementById('fullName-input'); 
const email_input = document.getElementById('email-input');
const password_input = document.getElementById('password-input');
const repeat_password_input = document.getElementById('repeat-password-input');

if (signUpForm) {
  signUpForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const errors = getSignupFormErrors(fullname_input, email_input, password_input, repeat_password_input);
    displayErrors(errors, signUpForm);
  });
}

if (loginForm) {
  loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const errors = getLoginFormErrors(email_input, password_input);
    displayErrors(errors, loginForm);
  });
}

function getSignupFormErrors(fullname, email, password, repeat_password) {
  let errors = [];

  if (fullname.value === '' || fullname.value === null) {
    errors.push({ field: fullname, message: 'Full Name is required' });
  }

  if (email.value === '' || email.value === null) {
    errors.push({ field: email, message: 'Email is required' });
  }

  if (password.value === '' || password.value === null) {
    errors.push({ field: password, message: 'Password is required' });
  }

  if (repeat_password.value === '' || repeat_password.value === null) {
    errors.push({ field: repeat_password, message: 'Repeat password is required' });
  }

  if (password.value !== repeat_password.value) {
    errors.push({ field: repeat_password, message: 'Passwords do not match' });
  }

  return errors;
}

function getLoginFormErrors(email, password) {
  let errors = [];

  if (email.value === '' || email.value === null) {
    errors.push({ field: email, message: 'Email is required' });
  }

  if (password.value === '' || password.value === null) {
    errors.push({ field: password, message: 'Password is required' });
  }

  return errors;
}

function displayErrors(errors, form) {
  // Clear previous errors
  const errorElements = form.querySelectorAll('.error-message');
  errorElements.forEach(el => el.remove());

  errors.forEach(error => {
    const { field, message } = error;
    field.placeholder = message;
    field.style.borderColor = 'red';
    field.style.fontStyle = 'italic';
  });
}