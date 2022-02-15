<?php // routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Setting
Breadcrumbs::for('setting', function (BreadcrumbTrail $trail) {
    $trail->push(__('view.setting'), route('backoffice.setting'));
});

// Company
Breadcrumbs::for('company', function (BreadcrumbTrail $trail) {
    $trail->parent('setting');
    $trail->push(__('view.company'), route('backoffice.setting.company'));
});

// Office
Breadcrumbs::for('office', function (BreadcrumbTrail $trail) {
    $trail->parent('setting');
    $trail->push(__('view.office'), route('backoffice.setting.office'));
});

// Mail Reception
Breadcrumbs::for('mail-reception', function (BreadcrumbTrail $trail) {
    $trail->parent('setting');
    $trail->push(__('view.mail_reception'), route('backoffice.setting.mail-reception'));
});

// Social Networks
Breadcrumbs::for('social-networks', function (BreadcrumbTrail $trail) {
    $trail->parent('setting');
    $trail->push(__('view.social_networks'), route('backoffice.setting.social-networks'));
});

// Maintenance Networks
Breadcrumbs::for('maintenance-mode', function (BreadcrumbTrail $trail) {
    $trail->parent('setting');
    $trail->push(__('view.maintenance_mode'), route('backoffice.setting.maintenance-mode'));
});

// Payment Methods
Breadcrumbs::for('payment-methods', function (BreadcrumbTrail $trail) {
    $trail->parent('setting');
    $trail->push(__('view.payment_methods'), route('backoffice.setting.payment-methods'));
});
