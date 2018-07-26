<?php

// Dashboard
Breadcrumbs::register('dashboard', function($breadcrumbs){
    $breadcrumbs->push('Dashboard', route('backend::dashboard'), ['icon' => 'fa fa-dashboard']);
});

// Home > About
Breadcrumbs::register('about', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('About', route('backend::about'));
});

// Periode
Breadcrumbs::register('list_periode', function($breadcrumbs){
    $breadcrumbs->push('Periode', route('backend::periode.index'));
});

Breadcrumbs::register('edit_periode', function($breadcrumbs){
    $breadcrumbs->parent('list_periode');
    $breadcrumbs->push('Ubah Periode', route('backend::periode.index'));
});

Breadcrumbs::register('create_periode', function($breadcrumbs){
    $breadcrumbs->parent('list_periode');
    $breadcrumbs->push('Tambah Periode', route('backend::periode.index'));
});