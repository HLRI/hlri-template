<?php
/*
Template Name: lottery code
*/
get_header();
?>

    <div class="container mt-5 mb-5 pt-5 pb-5">
        <div class="mt-5 mb-5 pt-5 pb-5">
            <h1>
                Your Lottery Code Is
                <?= isset($_SESSION['lottery-code']) ? $_SESSION['lottery-code'] : 'No code generated'; ?>
            </h1>
        </div>
    </div>

<?php
get_footer();
