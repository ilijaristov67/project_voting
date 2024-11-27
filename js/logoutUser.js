$('#logOut').on('click', function () {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you really want to log out?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, log out',
        cancelButtonText: 'No, stay logged in'
    }).then((result) => {
        if (result.isConfirmed) {
            const baseUrl = `${window.location.origin}${window.location.pathname.split('/').slice(0, -1).join('/')}`;
            const apiUrl = `${baseUrl}/API/logoutUser.php`;
            $.ajax({
                url: apiUrl,
                method: 'POST',
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Logged Out',
                            text: 'You have been successfully logged out.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload();
                        });
                    } else if (response.error) {
                        Swal.fire({
                            title: 'Error',
                            text: response.error,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: 'Error',
                        text: 'An unexpected error occurred. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    console.error(error);
                }
            });
        }
    });
});
