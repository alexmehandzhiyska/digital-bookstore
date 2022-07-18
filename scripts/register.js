import Swal from '../node_modules/sweetalert2/src/sweetalert2.js';

$('#register-form').on('submit', e => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const firstName = formData.get('first_name');
    const lastName = formData.get('last_name');
    const email = formData.get('email');
    const password = formData.get('password');

    $.ajax({
        url: 'register.php',
        method: 'POST',
        data: {
            login: 1,
            first_name: firstName,
            last_name: lastName,
            email: email,
            password: password,
            is_admin: false
        },
        success: (response) => {
            if (response.includes('success')) {
                localStorage.setItem('email', email);
                window.location = 'home.php';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Cannot create your account. Please try again later.',
                })
                .then(() => {
                    window.location = 'register.php';
                });
            }
        },
        dataType: 'text'
    });
});