$(document).ready(function () {
    const baseUrl = `${window.location.origin}${window.location.pathname.split('/').slice(0, -1).join('/')}`;
    const apiGetTopVoters = `${baseUrl}/API/getTopVoters.php`;
    const apiGetTopVotedPeopleByCategory = `${baseUrl}/API/getTopVotersPerCategory.php`;
    $.ajax({
        url: apiGetTopVoters,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            $('#loadingMessage').hide();
            if (response && Array.isArray(response) && response.length > 0) {
                $('#topVotersList').empty();
                response.forEach(function (voter) {
                    const voterCard = `
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card top-voter-card">
                                <div class="card-body text-center">
                                    <h5 class="voter-name">${voter.first_name} ${voter.last_name}</h5>
                                    <p class="vote-count">${voter.vote_count} Votes</p>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#topVotersList').append(voterCard);
                });
            } else {
                $('#topVotersList').html('<p class="loading">No top voters found.</p>');
            }
        },
        error: function (err) {
            console.log(err);
            $('#loadingMessage').text('An error occurred while fetching top voters.');
        }
    });
    $.ajax({
        url: apiGetTopVotedPeopleByCategory,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log('Response from getTopVotersPerCategory:', response);

            if (response && typeof response === 'object') {
                for (let categoryName in response) {
                    const categoryVoters = Array.isArray(response[categoryName]) ? response[categoryName] : [];

                    console.log(`Category: ${categoryName}`, categoryVoters);
                    const sanitizedCategoryName = categoryName.trim().replace(/[^a-zA-Z0-9]/g, '_');

                    if (categoryVoters.length > 0) {
                        const categorySection = `
                            <div class="category-section mt-5">
                                <h3>${categoryName}</h3>
                                <div class="row" id="topVotersList_${sanitizedCategoryName}"></div>
                            </div>
                        `;
                        $('#topVotedByCategoryList').append(categorySection);

                        categoryVoters.forEach(function (voter) {
                            const voterCard = `
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card top-voter-card">
                                        <div class="card-body text-center">
                                            <h5 class="voter-name">${voter.first_name} ${voter.last_name}</h5>
                                            <p class="vote-count">${voter.vote_count} Votes</p>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $(`#topVotersList_${sanitizedCategoryName}`).append(voterCard);
                        });
                    } else {
                        console.log(`No voters in category: ${categoryName}`);
                        $('#topVotedByCategoryList').append(`
                            <div class="category-section mt-5">
                                <h3>${categoryName}</h3>
                                <p class="loading">No top voted people found in this category.</p>
                            </div>
                        `);
                    }
                }
            } else {
                $('#topVotedByCategoryList').html('<p class="loading">No data available.</p>');
            }
        },
        error: function (err) {
            console.log(err);
            $('#loadingMessage').text('An error occurred while fetching the top-voted people per category.');
        }
    });
});
