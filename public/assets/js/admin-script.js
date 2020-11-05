"use strict";

let t = {};

(function ($) {
    localStorage.smallSidebar === 'true' ? document.getElementsByTagName('body')[0].className = 'sidebar-icon-only' : true;
    $('#collapse-sidebar-toggler').prependTo('#main-content');

    fetch('/translate').then(res => res.json()).then(result => {
        for (const i in result) {
            t[i] = result[i];
            t[i].th = i;
        }
    });
})($);

const lang = 'th';

$.extend($.fn.DataTable.defaults, {
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json",
    }
});

window.fetchJson = async (url, method = 'GET', formData = null) => {
    const fetched = await fetch(url, {
        method: method,
        body: formData,
    });

    if (!fetched.ok) return errorSwal();

    const result = await fetched.json();
    if (!result) return errorSwal();
    if (result.success === false) return errorSwal(result)

    return result;
}
window.errorSwal = (data = null) => {
    if (data === null) {
        data = {
            title: t['ขออภัย'][lang],
            text: t['พบข้อบกพร่องทางเทคนิค'][lang]+ ' ' +t['โปรดลองอีกครั้งหรือแจ้งปัญหาให้ทางทีมงานทราบ'][lang],
            icon: 'error',
        }
    }
    swal({
        title: data.title || t['ขออภัย'][lang],
        text: data.text,
        icon: data.icon || 'error',
        buttons: {
            confirm: 'แจ้งปัญหา',
            cancel: 'ปิด'
        }
    }).then(contact => contact && window.open('/report'));
    return false;
}

$(document).on('click', function (event) {
    const $target = $(event.target);
    if (
        !$target.closest('#sidebar').length &&
        $('#sidebar').css('transform') === "matrix(1, 0, 0, 1, 0, 0)"
    ) {
        $('#sidebar').removeClass('is-open');
        $('body').removeClass('overflow-hidden');
        $('.overlay').hide();
    }
});

function openSidebar() {
    if (!$('#sidebar').hasClass('is-open')) {
        $('#sidebar').addClass('is-open');
        $('body').addClass('overflow-hidden');
        $('.overlay').show();
    } else {
        $('#sidebar').removeClass('is-open');
        $('body').removeClass('overflow-hidden');
        $('.overlay').hide();
    }
}

function notifyMe(title, text) {
    // Let's check if the browser supports notifications

    $.post('load.php?load=CheckNotify', function (data) {
        if (data.notified !== true) {
            if (!("Notification" in window)) {
                alert("This browser does not support desktop notification");
                return false;
            }

            // Let's check whether notification permissions have already been granted
            if (Notification.permission === "granted") {
                // If it's okay let's create a notification
                var notification = new Notification(title, {
                    body: text,
                    icon: '/assets/img/logo.png'
                });
            }

            // Otherwise, we need to ask the user for permission
            else if (Notification.permission !== "denied") {
                Notification.requestPermission().then(function (permission) {
                    // If the user accepts, let's create a notification
                    if (permission === "granted") {
                        var notification = new Notification(title, {
                            body: text,
                            icon: '/assets/img/logo.png'
                        });
                    }
                });
            }

            // At last, if the user has denied notifications, and you 
            // want to be respectful there is no need to bother them any more.

            $.post('action.php?action=Notified');
        }
    }, 'JSON');
}

$('table.auto-datatable').dataTable();

$('[data-toggle="tooltip"]').tooltip();

const capitalize = (s) => {
    if (typeof s !== 'string') return ''
    return s.charAt(0).toUpperCase() + s.slice(1)
}

$(document).ready(function ($) {

    var href = location.href.split('/')[location.href.split('/').length - 1] || 'index.php';
    var url = href.split('?')[0];
    // console.log(url);

    var activePage = [location.protocol, '//', location.host, location.pathname].join('');
    // console.log('Active page: '+activePage);
    $('nav.sidebar-navigation a').each(function () {
        var linkPage = this.href;

        // console.log('Link page: '+linkPage);
        if (activePage === linkPage) {
            $(this).addClass("active");
            if ($(this).closest('div').hasClass('collapse')) {
                $(this).closest('.collapse').addClass('show');
            }
        }
    });

    let src = './assets/media/bing.mp3';
    let audio = new Audio(src);

    if (1 == 2) {
        
        var es = new EventSource('load.php?load=UpdateRealTime');

        window.intervalBing = setInterval(() => {}, 1000);

        es.addEventListener('newDeposit', function (e) {
            var data = JSON.parse(e.data);
            console.log('newDeposit', data);
            if (data.count) {
                notifyMe('ฝากเงิน', `มีรายการแจ้งฝากที่ยังไม่ได้ตรวจสอบ ${data.count} รายการ`)
                window.intervalBing = setInterval(() => {
                    audio.play();
                }, 1000);
                $('#deposit-count').text(data.count).show();
            } else {
                clearInterval(window.intervalBing);
                $('#deposit-count').text(data.count).hide();
            }
        });
        es.addEventListener('newWithdraw', function (e) {
            var data = JSON.parse(e.data);
            console.log('newWithdraw', data);
            if (data.count) {
                notifyMe('ถอนเงิน', `มีรายการแจ้งถอนที่ยังไม่ได้ตรวจสอบ ${data.count} รายการ`)
                window.intervalBing = setInterval(() => {
                    audio.play();
                }, 1000);
                $('#withdraw-count').text(data.count).show();
            } else {
                clearInterval(window.intervalBing);
                $('#withdraw-count').text(data.count).hide();
            }
        });
        es.addEventListener('waitWithdraw', function (e) {
            var data = JSON.parse(e.data);
            console.log('waitWithdraw', data);
            if (data.count) {
                notifyMe('ถอนเงินรอโอน', `มีรายการแจ้งถอนที่ยังไม่ได้โอนเงิน ${data.count} รายการ`)
                window.intervalBing = setInterval(() => {
                    audio.play();
                }, 1000);
                $('#wait-withdraw-count').text(data.count).show();
            } else {
                clearInterval(window.intervalBing);
                $('#wait-withdraw-count').text(data.count).hide();
            }
        });
        es.addEventListener('newMember', function (e) {
            var data = JSON.parse(e.data);
            console.log('newMember', data);
            if (data.count) {
                notifyMe('สมาชิกใหม่', `มีสมาชิกใหม่ที่ยังไม่ได้ตรวจสอบ ${data.count} บัญชี`)
                window.intervalBing = setInterval(() => {
                    audio.play();
                }, 1000);
                $('#member-count').text(data.count).show();
            } else {
                clearInterval(window.intervalBing);
                $('#member-count').text(data.count).hide();
            }
        });

    }

});

/**
 * Custom Events
 * for sidebar new items' count badge
 */

/**
 * Read contact message => fetch new unread count
 */
document.body.addEventListener('read-contact-msg', e => console.log(e));

