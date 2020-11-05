<?php

define('lang', isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'en');

$transl = [
    // Home Sidebar
    'หน้าแรก' => [
        'en' => 'Home',
        'cn' => '首页',
    ],
    'สินค้าใหม่' => [
        'en' => 'New Products',
        'cn' => '更新产品',
    ],
    'ร้านค้า' => [
        'en' => 'Shops',
        'cn' => '网店',
    ],
    'ข่าวสาร' => [
        'en' => 'News',
        'cn' => '新闻',
    ],
    'กฎระเบียบ' => [
        'en' => 'Rules',
        'cn' => '规则',
    ],
    'ติดต่อ' => [
        'en' => 'Contact us',
        'cn' => '联系',
    ],
    'ค้นหา' => [
        'en' => 'Search',
        'cn' => '索搜',
    ],
    'ผลการค้นหา' => [
        'en' => 'Search results',
        'cn' => '搜索结果',
    ],
    
    'ข่าวประชาสัมพันธ์' => [
        'en' => 'Announcement',
        'cn' => '公告',
    ],
];

define('TRANSLATE', $transl);