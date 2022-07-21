import Swal from '../../node_modules/sweetalert2/src/sweetalert2.js';

$('#add-to-cart-btn').on('click', () => {
    const currentPath = window.location.href;
    const bookId = /\d+/.exec(currentPath)[0];

    const userId = localStorage.getItem('userId');

    $.ajax({
        url: `/cart`,
        method: 'POST',
        data: {
            user_id: userId,
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
    const userId = localStorage.getItem('userId');
    const bookId = e.target.parentElement.parentElement.querySelector('input').value;

    $.ajax({
        url: `/cart`,
        method: 'POST',
        data: {
            user_id: userId,
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