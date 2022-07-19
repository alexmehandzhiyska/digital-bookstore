import Swal from '../node_modules/sweetalert2/src/sweetalert2.js';

$('.rating-star').on('click', (e) => {
    const urlParams = new URLSearchParams(window.location.search);
    const bookId = urlParams.get('id');

    const email = localStorage.getItem('email');

    const rating = e.target.id;

    $.ajax({
        url: 'addRating.php',
        method: 'POST',
        data: {
            email: email,
            book_id: bookId,
            rating: rating
        },
        success: (response) => {
            if (!response.includes('Error')) {
                window.location = `bookDetails.php?id=${response}`;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Cannot rate this book now. Please try again later.',
                });
            }
        },
        dataType: 'text'
    });
});