import Swal from '../node_modules/sweetalert2/src/sweetalert2.js';

$('#login-form').on('submit', e => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const email = formData.get('email');
    const password = formData.get('password');

    $.ajax({
        url: 'login.php',
        method: 'POST',
        data: {
            login: 1,
            email: email,
            password: password,
        },
        success: (response) => {
            if (response.includes('success')) {
                localStorage.setItem('email', email);
                window.location = 'home.php';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid email or password. Please try again.',
                });
            }
        },
        dataType: 'text'
    });
});