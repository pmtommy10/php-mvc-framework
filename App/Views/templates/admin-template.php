<?php require_once INCLUDES . DS . 'admin' . DS . '1_head.php'; ?>

<body style="background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);">
    <div class="mobile-toolbar sticky-top d-xl-none d-flex align-items-center">
        <button class="btn shadow-none font-weight-bold ml-n3 px-4 py-3" style="margin-left: -10px;" type="button" onclick="openSidebar()">
            <div style="transform: scale(2, 1.25);">&equiv;</div>
        </button>
        <h5 class="ml-sm-4 mb-0 lh-sm text-nowrap" style="overflow: auto hidden;">
            <?= $pageHeader['pageTitle'] ?>
            <?php if (!empty($pageHeader['pageDesc'])) : ?>
                <small class="font-weight-light d-block" style="font-size: 14px;"><?= $pageHeader['pageDesc'] ?></small>
            <?php endif; ?>
        </h5>
    </div>
    <?php require_once INCLUDES . DS . 'admin' . DS . '_sidebar.php'; ?>
    <main id="main-content" class="main [container-xl]">
        <header id="title-bar" class="title-bar d-none d-xl-block">
            <h1 class="text-dark font-weight-normal"><?= $pageHeader['pageTitle'] ?></h1>
            <?php if (!empty($pageHeader['pageDesc'])) : ?>
                <div class="lead"><?= $pageHeader['pageDesc'] ?></div>
            <?php endif; ?>
        </header>

        <?php require_once VIEWS . DS . 'admin' . DS . self::$view ?>
    </main>
    <?php require_once INCLUDES . DS . 'admin' . DS . '2_foot.php'; ?>
</body>