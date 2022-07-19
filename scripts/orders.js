import Swal from '../node_modules/sweetalert2/src/sweetalert2.js';

$('#order-form').on('submit', e => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const firstName = formData.get('first_name');
    const lastName = formData.get('last_name');
    const address = formData.get('address');
    const phone = formData.get('phone');
    const additionalInfo = formData.get('additional_info');

    const email = localStorage.getItem('email');

    $.ajax({
        url: '/order',
        method: 'POST',
        data: {
            order: 1,
            email: email,
            first_name: firstName,
            last_name: lastName,
            address: address,
            phone: phone,
            additional_info: additionalInfo
        },
        success: (response) => {
            if (response.includes('success')) {
                Swal.fire({
                    icon: 'success',
                    title: 'Your order has been placed successfully.',
                })
                .then(() => {
                    window.location = '/';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Cannot place your order. Please try again later.',
                })
                .then(() => {
                    window.location = '/order';
                });
            }
        },
        dataType: 'text'
    });
});