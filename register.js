document.getElementById('register-form').addEventListener('submit', function (event) {
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (username.length < 3) {
        alert('Username must be at least 3 characters long.');
        event.preventDefault();
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        event.preventDefault();
    }

    if (password.length < 6) {
        alert('Password must be at least 6 characters long.');
        event.preventDefault();
    }

    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        event.preventDefault();
    }
});