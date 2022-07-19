import Swal from '../node_modules/sweetalert2/src/sweetalert2.js';

$('#add-to-cart-btn').on('click', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const bookId = urlParams.get('id');

    const email = localStorage.getItem('email');

    $.ajax({
        url: 'addToCart.php',
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
        url: 'addToCart.php',
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