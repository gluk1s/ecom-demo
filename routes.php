<?php

require_once(__DIR__ . "./router.php");

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost/projects/final_project
// The output -> Index

// homepage
get('/', './views/index.php');

// contact page
get('/contact', './views/contact.php');

// shop page
get('/shop', './views/shop.php');

// Item page (data by item id)
get('/items/$item_id', "./views/item.php");

post('/items/$item_id', "./views/item.php");

// Cart page
get('/checkout', "./views/checkout.php");

post('/checkout', "./views/checkout.php");

// Admin panel login
get('/admin', './views/admin-login.php');

post('/admin', './views/admin-login.php');

// Admin homepage
get('/admin_homepage', './views/index-admin.php');

// Admin edit page
get('/item/edit/$item_id', './views/item-edit.php');

post('/item/edit/$item_id', './views/item-edit.php');

// Admin create new item page
get('/item/create', './views/item-create.php');

post('/item/create', './views/item-create.php');

// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','./views/404.php');
