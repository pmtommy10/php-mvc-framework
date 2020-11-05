<?php

use App\Controllers\AdminController;
?>
<div id="loader" class="position-fixed w-100 h-100" style="z-index: 9999; background: rgba(255,255,255,0.5); display: none;">
    <div class="text-muted d-flex w-100 h-100 justify-content-center align-items-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
<script>
    const loader = document.getElementById('loader');

    const fadeOut = (el, speed = 500) => new Promise((resolve, reject) => {
        const speedText = +speed / 1000 + 's';
        el.style.transition = speedText;
        el.style.opacity = 0;
        setTimeout(() => {
            el.style.display = 'none';
            resolve(el)
        }, speed);
    });

    const fadeIn = (el, speed = 500) => new Promise((resolve, reject) => {
        const speedText = +speed / 1000 + 's';
        el.style.display = '';
        el.style.transition = speedText;
        setTimeout(() => (el.style.opacity = 1), 1);
        setTimeout(() => resolve(el), speed);
    });
</script>

<!-- sidebar nav -->
<aside id="sidebar" class="shadow sidebar">
    <header class="header text-center p-3">
        <button class="btn-close d-sm-none float-left mt-n1 ml-2 text-black-50" onclick="openSidebar()"></button>
        <a href="" class="h5 font-weight-light mb-0 mx-auto text-dark"><?= AdminController::$webName ?></a>
    </header>
    <hr class="sidebar-seperator bg-secondary m-0">
    <div class="sidebar-container">
        <nav class="sidebar-navigation">
            <?php foreach (AdminController::menu() as $key => $menuGroup) : ?>

                <?php if ($menuGroup === 'seperator') : ?>
                    <hr class="sidebar-seperator bg-secondary">
                <?php continue;
                endif; ?>

                <div id="accordion-<?= $key ?>" class="accordion">
                    <div class="panel">
                        <?php foreach ($menuGroup as $index => $menu) : ?>

                            <a href="<?= $menu['link'] ?? '#collapse-' . $menu['text'] ?>" <?= isset($menu['dropdown-item']) ? 'data-toggle="collapse"' : '' ?> class="sidebar-link" data-parent="#accordion-<?= $key ?>">
                                <i class="<?= $menu['icon'] ?> fa-fw fa-lg"></i>
                                <span class="sidebar-link-text"><?= $menu['text'] ?></span>
                            </a>

                            <?php if (isset($menu['dropdown-item'])) : ?>
                                <div id="collapse-<?= $menu['text'] ?>" class="collapse" data-parent="#accordion-<?= $key ?>">
                                    <ul class="sidebar-list">
                                        <?php foreach ($menu['dropdown-item'] as $item) : ?>
                                            <li class="sidebar-list-item"><a href="<?= $item['link'] ?>"><?= $item['text'] ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </div>
                </div>

            <?php endforeach; ?>
        </nav>
        <footer class="sidebar-footer-navigation">
            <a href="../" target="_blank" rel="noopener" class="text-black-50 text-decoration-none"><i class="fas fa-share mr-2"></i><span>ไปสู่หน้าเว็บไซต์</span></a>
        </footer>
    </div>
</aside> <!-- /aside.sidebar -->

<!-- overlay on mobile -->
<div class="overlay" style="display: none;"></div>
<button id="collapse-sidebar-toggler" class="align-items-center btn btn-lg position-absolute shadow-none d-none d-xl-flex top-0 left-0" style="z-index: 1; background: rgba(255,255,255,0.25);" onclick="$('body').toggleClass('sidebar-icon-only'); localStorage.smallSidebar === 'true' ? localStorage.smallSidebar = 'false' : localStorage.smallSidebar = 'true';">
    <span style="transform: scale(2, 1.25) translateY(-2px);">≡</span>
</button>