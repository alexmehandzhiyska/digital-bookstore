$('.remove-book-btn').on('click', (e) => {
    const wrapperEl = e.target.parentElement.parentElement;
    const bookId = wrapperEl.querySelector('input').value;

    $.ajax({
        url: `/wishlist?&book_id=${bookId}`,
        method: 'DELETE',
        success: (response) => {
            if (response.includes('success')) {
                window.location = '/wishlist';
            }
        },
        dataType: 'text'
    });
});

$('#wishlist-btn').on('click', () => {
    const currentPath = window.location.href;
    const bookId = /\d+/.exec(currentPath)[0];

    const userId = localStorage.getItem('userId');

    $.ajax({
        url: '/wishlist',
        method: 'POST',
        data: {
            user_id: userId,
            book_id: bookId
        },
        success: (response) => {
            if (response.includes('success')) {
               $('#wishlist-btn').prop('id', 'wishlist-btn-selected');
            }
        },
        dataType: 'text'
    });
});

$('#wishlist-btn-selected').on('click', () => {
    const currentPath = window.location.href;
    const bookId = /\d+/.exec(currentPath)[0];

    const userId = localStorage.getItem('userId');

    $.ajax({
        url: `/wishlist?&book_id=${bookId}`,
        method: 'DELETE',
        success: (response) => {
            if (response.includes('success')) {
               $('#wishlist-btn-selected').prop('id', 'wishlist-btn');
            }
        },
        dataType: 'text'
    });
});