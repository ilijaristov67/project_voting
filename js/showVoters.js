$(document).ready(function () {
    const baseUrl = `${window.location.origin}${window.location.pathname.split('/').slice(0, -1).join('/')}`;
    const apiGetTopVoters = `${baseUrl}/API/getTopVoters.php`;
    $.ajax({
        url: apiGetTopVoters,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            // console.log(response, 'dsayufgsdfuyisdghfuyisd); 
            $('#loadingMessage').hide();
            if (response && Array.isArray(response) && response.length > 0) {
                $('#topVotersList').empty();

                response.forEach(function (voter) {
                    const voterCard = `
                        <div class="col-md-6 col-lg-4 mb-4 ">
                            <div class="card top-voter-card ">
                                <div class="card-body text-center ">
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
});
