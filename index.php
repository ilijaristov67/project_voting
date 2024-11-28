<?php

require_once __DIR__ . "/partials/header.php";
?>

<body>
    <?php
    require_once __DIR__ . "/partials/navbar.php";
    ?>

    <?php
    require_once __DIR__ . "/partials/banner.php";
    ?>
    <div class="container mt-5">
        <h2 class="text-center">Top Voters</h2>
        <div class="row justify-content-center" id="topVotersList">

        </div>
        <div id="loadingMessage" class="loading">Loading top voters...</div>
    </div>
    <?php
    require_once __DIR__ . "/partials/scripts.php";
    ?>

    <script src="./js/registerUser.js"></script>
    <script src="./js/loginUser.js"></script>
    <script src="./js/logoutUser.js"></script>
    <script src="./js/showVoters.js"></script>
</body>

</html>