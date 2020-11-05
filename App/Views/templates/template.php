<?php require_once INCLUDES . DS . '1_head.php'; ?>

<body>
    <?php require_once INCLUDES . DS . '_header.php'; ?>
    <?php require_once INCLUDES . DS . '_menu.php'; ?>
    <main id="main-frame">
        <?php require_once VIEWS . DS . self::$view ?>
    </main>
    <?php require_once INCLUDES . DS . '_footer.php'; ?>
    <?php require_once INCLUDES . DS . '2_foot.php'; ?>
</body>