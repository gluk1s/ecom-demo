<?php

require_once(__DIR__ . "./router.php");

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', './views/index.php');

get('/contact', './views/contact.php');

get('/shop', './views/shop.php');

// Dynamic GET. Example with 1 variable
get('/items/$item_id', "./views/item.php");

post('/items/$item_id', "./views/item.php");

get('/checkout', "./views/checkout.php");

post('/checkout', "./views/checkout.php");

get('/admin', './views/admin-login.php');

post('/admin', './views/admin-login.php');

get('/admin_homepage', './views/index-admin.php');

get('/items/edit/$item_id', './views/item-edit.php');

post('/items/edit/$item_id', './views/item-edit.php');

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','./views/404.php');
