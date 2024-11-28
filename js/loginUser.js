let loginForm = $('#loginUser');

loginForm.on('submit', function (e) {
    let email = $('#loginEmail').val();
    let password = $('#loginPassword').val();
    e.preventDefault();
    $('#loginModal').modal('hide');
    let formData = {
        email: email,
        password: password
    };
    const baseUrl = `${window.location.origin}${window.location.pathname.split('/').slice(0, -1).join('/')}`;
    const apiUrl = `${baseUrl}/API/loginUser.php`;
    $.ajax({
        url: apiUrl,
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(formData),
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    title: 'Welcome',
                    text: response.message,
                    icon: 'success'
                }).then(() => {
                    window.location.reload();
                });
            } else if (response.errors) {
                Swal.fire({
                    title: 'Login Failed',
                    text: response.errors.message,
                    icon: 'error'
                });
            }
        },
        error: function (err) {
            console.error('AJAX Error:', err);
            Swal.fire({
                title: 'Error',
                text: 'An unexpected error occurred. Please try again.',
                icon: 'error'
            });
        }
    });
});
