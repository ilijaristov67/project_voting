let registerUserForm = $('#registerUser');
registerUserForm.on('submit', function (e) {
    e.preventDefault();

    $('#registerModal').modal('hide');
    let formData = {
        first_name: $('#first_name').val(),
        last_name: $('#last_name').val(),
        email: $('#email').val(),
        password: $('#password').val(),
    }
    const baseUrl = `${window.location.origin}${window.location.pathname.split('/').slice(0, -1).join('/')}`;
    const apiUrl = `${baseUrl}/API/registerUser.php`;
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
                $('#first_name').val('')
                $('#last_name').val('')
                $('#email').val('')
                $('#password').val('')
                Swal.fire({
                    title: 'Successfully Registered',
                    text: 'You account was created',
                    icon: 'success'
                })
            }

        },
        error: function (err) {
            console.log(err)
        }
    })
})