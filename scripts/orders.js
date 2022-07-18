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
        url: 'orderForm.php',
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
                window.location = 'home.php';
            }
        },
        dataType: 'text'
    });
});