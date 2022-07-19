$('.remove-book-btn').on('click', (e) => {
    const wrapperEl = e.target.parentElement.parentElement;
    const bookId = wrapperEl.querySelector('input').value;

    const email = localStorage.getItem('email');

    $.ajax({
        url: '/wishlist/delete',
        method: 'POST',
        data: {
            email: email,
            book_id: bookId
        },
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

    const email = localStorage.getItem('email');

    $.ajax({
        url: '/wishlist',
        method: 'POST',
        data: {
            email: email,
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

    const email = localStorage.getItem('email');

    $.ajax({
        url: '/wishlist/delete',
        method: 'POST',
        data: {
            email: email,
            book_id: bookId
        },
        success: (response) => {
            if (response.includes('success')) {
               $('#wishlist-btn-selected').prop('id', 'wishlist-btn');
            }
        },
        dataType: 'text'
    });
});