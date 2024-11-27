let loginForm = $('#loginUser');


loginForm.on('submit', function (e) {
    let email = $('#loginEmail').val();
    let password = $('#loginPassword').val();
    e.preventDefault();
    $('#loginModal').modal('hide');
    let formData = {
        email: email,
        password: password
    }
    const baseUrl = `${window.location.origin}${window.location.pathname.split('/').slice(0, -1).join('/')}`;
    const apiUrl = `${baseUrl}/API/loginUser.php`;
    $.ajax({
        url: apiUrl,
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(formData),
        dataType: 'json',
        success: function (response) {
            if (Array.isArray(response.errors) && response.errors.length > 0 && response.errors[0].error === true) {
                const errorMessages = response.errors.map(err => `<p style="font-size: 20px; margin: 5px 0;">${err.message}</p>`).join('');
                Swal.fire({
                    title: 'Errors Occurred',
                    html: errorMessages,
                    icon: 'error'
                });
            } else {
                $('#loginEmail').val('')
                $('#loginPassword').val('')
                Swal.fire({
                    title: 'Welcome',
                    text: 'Successfully logged in',
                    icon: 'success'
                }).then(() => {
                    window.location.reload()
                })
            }
        },
        error: function (err) {
            console.log(err)
        }
    })
})