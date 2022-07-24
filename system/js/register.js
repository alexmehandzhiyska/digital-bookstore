import Swal from '../../node_modules/sweetalert2/src/sweetalert2.js';

$('#register-form').on('submit', e => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const firstName = formData.get('first_name');
    const lastName = formData.get('last_name');
    const email = formData.get('email');
    const password = formData.get('password');
    const repeatPassword = formData.get('repeat_password');

    if (!firstName || !lastName || !email || !password || !repeatPassword) {
        $('.error-message').text('All fields are required!');
        return;
    }

    if (password !== repeatPassword) {
        $('.error-message').text('Passwords must match!');
        return;
    }

    $.ajax({
        url: '/register',
        method: 'POST',
        data: {
            login: 1,
            first_name: firstName,
            last_name: lastName,
            email: email,
            password: password,
            repeat_password: repeatPassword,
            is_admin: false
        },
        success: (response) => {
            if (response.includes('success')) {
                const reversedResponse = response
                .split('')
                .reverse()
                .join();
                
                const userId = /\d+/.exec(reversedResponse)[0];

                localStorage.setItem('email', email);
                localStorage.setItem('userId', userId);
                
                window.location = '/';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Cannot create your account. Please try again later.',
                })
                .then(() => {
                    window.location = '/register';
                });
            }
        },
        dataType: 'text'
    });
});