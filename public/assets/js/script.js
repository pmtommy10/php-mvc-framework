const cookieArr = document.cookie.split('; ');
const cookies = {};

const loader = document.getElementById('loader');
const bodyOverlay = document.getElementById('body-overlay');

const timeout = timeout => new Promise(resolve => setTimeout(() => resolve(true), timeout));

window.fadeOut = (el, speed = 500) => new Promise((resolve, reject) => {
    const speedText = +speed / 1000 + 's';
    el.style.transition = speedText;
    el.style.opacity = 0;
    setTimeout(() => {
        el.style.display = 'none';
        resolve(el)
    }, speed);
});

window.fadeIn = (el, speed = 500) => new Promise((resolve, reject) => {
    const speedText = +speed / 1000 + 's';
    el.style.display = '';
    el.style.transition = speedText;
    el.style.opacity = 0;
    setTimeout(() => (el.style.opacity = 1), 1);
    setTimeout(() => resolve(el), speed);
});

window.autosize = element => {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight) + "px";
}

window.formattedDatetime = (datetime, type) => {
    let locales;
    if (cookies['lang'] === 'th') {
        locales = 'th-TH';
    } else if (cookies['lang'] === 'en') {
        locales = 'en-US';
    } else if (cookies['lang'] === 'cn') {
        locales = 'zh-BJ';
    }
    locales = locales || 'en-US';
    const config = {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
    };
    if (type === '') {
        config.hour = 'numeric';
        config.minute = 'numeric';
        config.second = 'numeric'
    }
    return new Date(datetime).toLocaleDateString(locales, config);
    // return Intl.DateTimeFormat(locales, config).format(datetime);
}
window.onload = () => {
    if (document.cookie.includes('logged')) {
        document.cookie = 'logged=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        location.reload();
    }
    // fadeOut(loader);
}
window.onbeforeunload = () => {
    loader.style.display = '';
    loader.style.transition = '';
    loader.style.opacity = 1;
};

cookieArr.forEach((val, index) => {
    const arr = val.split('=');
    const key = arr[0];
    const value = arr[1];
    cookies[key] = value;
});
const lang = cookies.lang;
var tableLangUrl;
if (!cookies['lang']) {
    tableLangUrl = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json";
} else {
    tableLangUrl = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/" + (cookies["lang"] == 'th' ? 'Thai' : (cookies["lang"] == 'en' ? 'English' : 'Chinese')) + '.json';
}

/**
 * Error alert;
 */
const errorSwal = (data = null) => {
    if (data === null) {
        data = {
            title: t.get('ขออภัย')[lang],
            text: t.get('พบข้อบกพร่องทางเทคนิค')[lang]+ ' ' +t.get('โปรดลองอีกครั้งหรือแจ้งปัญหาให้ทางทีมงานทราบ')[lang],
            icon: 'error',
        }
    }
    swal({
        title: data.title || t.get('ขออภัย')[lang],
        text: data.text,
        icon: data.icon || 'error',
        buttons: {
            confirm: t.get('แจ้งปัญหา')[lang],
            cancel: t.get('ปิด')[lang]
        }
    }).then(contact => contact && window.open('/report'));
    return false;
}

window.fetchJson = async (url, method = 'GET', formData = null) => {
    // const fetchHeaders = { 'Accept': 'application/json' };
    // if (cookies['jwt']) {
    //     fetchHeaders.Authorization = 'JWT '+cookies['jwt'];
    // }
    const fetched = await fetch(url, {
        method: method,
        body: formData,
        // headers: fetchHeaders,
        // credentials: 'include',
    });

    if (!fetched.ok) return errorSwal();

    const result = await fetched.json();
    if (!result) return errorSwal();
    if (result.success === false) return errorSwal(result)

    return result;
}

document.addEventListener('DOMContentLoaded', e => {
    fadeOut(loader);
});