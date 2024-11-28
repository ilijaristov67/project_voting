$(document).ready(function () {
    const baseUrl = `${window.location.origin}${window.location.pathname.split('/').slice(0, -1).join('/')}`;
    const apiUrlUsers = `${baseUrl}/API/getAllUsers.php`;
    const apiUrlCategories = `${baseUrl}/API/getAllCategories.php`;
    const apiSaveVote = `${baseUrl}/API/saveVote.php`;

    $.ajax({
        url: apiUrlUsers,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            const employees = response;
            const employeeSelect = $('#employee');
            let currentUser = $('#currentUserId').val();
            employees.forEach(employee => {
                let option = $(`<option value="${employee.id}">${employee.first_name} ${employee.last_name}</option>`);
                if (employee.id != currentUser) {
                    employeeSelect.append(option);
                }

            });
        },
        error: function (err) {
            console.log(err);
        }
    });
    $.ajax({
        url: apiUrlCategories,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            const categories = response;
            const categorySelect = $('#category');
            categories.forEach(category => {
                let option = $(`<option value="${category.id}">${category.category}</option>`);
                categorySelect.append(option);
            });
        },
        error: function (err) {
            console.log(err);
        }
    });
    $('#voteForm').on('submit', function (e) {
        e.preventDefault();
        let currentUser = $('#currentUserId').val();
        let votedEmployee = $('#employee').val();
        let categoryId = $('#category').val();
        let comment = $('#comment').val();
        let formData = {
            voter_id: currentUser,
            nominee_id: votedEmployee,
            category_id: categoryId,
            comment: comment
        };
        console.log(formData)
        $.ajax({
            url: apiSaveVote,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your vote has been saved successfully.',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                    $('#voteForm')[0].reset();
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.errors ? response.errors[0].message : 'Something went wrong.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            },
            error: function (err) {
                console.error('Error while saving the vote:', err);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while saving your vote. Please try again later.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        });
    });


});
