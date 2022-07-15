$('#wishlist-btn').on('click', e => {
    const urlParams = new URLSearchParams(window.location.search);
    const bookId = urlParams.get('id');
    const email = localStorage.getItem('email');

    $.ajax({
        url: 'addToWishlist.php',
        method: 'POST',
        data: {
            email: email,
            book_id: bookId
        }
    })
});