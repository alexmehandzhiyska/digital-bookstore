import Swal from '../node_modules/sweetalert2/src/sweetalert2.js';

$('#add-to-cart-btn').on('click', () => {
    const currentPath = window.location.href;
    const bookId = /\d+/.exec(currentPath)[0];

    const email = localStorage.getItem('email');

    $.ajax({
        url: '/cart',
        method: 'POST',
        data: {
            email: email,
            book_id: bookId
        },
        success: (response) => {
            if (response.includes('success')) {
                Swal.fire({
                    icon: 'success',
                    title: 'The book has been added to your cart successfully.',
                });
            }
        },
        dataType: 'text'
    });
});

$('.add-to-cart-btn').on('click', (e) => {
    const bookId = e.target.parentElement.parentElement.querySelector('input').value;

    const email = localStorage.getItem('email');

    $.ajax({
        url: '/cart',
        method: 'POST',
        data: {
            email: email,
            book_id: bookId
        },
        success: (response) => {
            if (response.includes('success')) {
                Swal.fire({
                    icon: 'success',
                    title: 'The book has been added to your cart successfully.',
                });
            }
        },
        dataType: 'text'
    });
});