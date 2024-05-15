<?php
$visit_histories = array();
foreach (json_decode(stripslashes($_COOKIE['visit_history']), true) as $key => $value) {
    if (!in_array($value, $visit_histories))
        $visit_histories[$key] = $value;
}
?>

<div class="row">

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-warning text-white me-2">
                <i class="mdi mdi-eye"></i>
            </span> Visit History
        </h3>
    </div>


    <?php foreach ($visit_histories as $visit) : ?>
        <div class="col-lg-4 mb-3">
            <a href="<?= $visit['url'] ?>" target="_blank">
                <div class="card-visit-history">
                    <div class="visit-title">
                        <?= strlen($visit['title'])  > 30 ? substr($visit['title'], 0, 30) . '...' : $visit['title'] ?>
                    </div>
                    <div class="visit-options">
                        <div class="visit-type">
                            <i class="mdi mdi-assistant"></i> <?= $visit['type'] ?>
                        </div>
                        <div class="visit-date">
                            <i class="mdi mdi-calendar-clock"></i> <?= $visit['date'] ?>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>