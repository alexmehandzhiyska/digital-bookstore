import Swal from '../../node_modules/sweetalert2/src/sweetalert2.js';

$('.rating-star').on('click', (e) => {
    const currentPath = window.location.href;
    const bookId = /\d+/.exec(currentPath)[0];

    const userId = localStorage.getItem('userId');

    const rating = e.target.id;

    $.ajax({
        url: `/books/${bookId}/rating`,
        method: 'POST',
        data: {
            user_id: userId,
            book_id: bookId,
            rating: rating
        },
        success: (response) => {
            if (!response.includes('Error')) {
                window.location = `/books/${response}`;
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