$('#remove-book-btn').on('click', (e) => {
    const wrapperEl = e.target.parentElement.parentElement;
    const bookId = wrapperEl.querySelector('input').value;

    const email = localStorage.getItem('email');

    $.ajax({
        url: 'removeFromWishlist.php',
        method: 'POST',
        data: {
            email: email,
            book_id: bookId
        },
        success: (response) => {
            if (response.includes('success')) {
                window.location = 'wishlist.php';
            }
        },
        dataType: 'text'
    });
});

$('#wishlist-btn').on('click', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const bookId = urlParams.get('id');

    const email = localStorage.getItem('email');

    $.ajax({
        url: 'addToWishlist.php',
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
    const urlParams = new URLSearchParams(window.location.search);
    const bookId = urlParams.get('id');

    const email = localStorage.getItem('email');

    $.ajax({
        url: 'removeFromWishlist.php',
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
            }
        },
        dataType: 'text'
    });
});