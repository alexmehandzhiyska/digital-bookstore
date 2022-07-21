import Swal from '../node_modules/sweetalert2/src/sweetalert2.js';

$('#login-form').on('submit', e => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const email = formData.get('email');
    const password = formData.get('password');

    $.ajax({
        url: '/login',
        method: 'POST',
        data: {
            login: 1,
            email: email,
            password: password,
        },
        success: (response) => {
            console.log(response);
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
                    title: 'Invalid email or password. Please try again.',
                });
            }
        },
        dataType: 'text'
    });
});