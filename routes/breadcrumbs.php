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

// Project
Breadcrumbs::register('list_project', function($breadcrumbs){
    $breadcrumbs->push('Project', route('backend::project.index'));
});

Breadcrumbs::register('edit_project', function($breadcrumbs){
    $breadcrumbs->parent('list_project');
    $breadcrumbs->push('Ubah Project', route('backend::project.index'));
});

Breadcrumbs::register('create_project', function($breadcrumbs){
    $breadcrumbs->parent('list_project');
    $breadcrumbs->push('Tambah Project', route('backend::project.index'));
});

// Logbook
Breadcrumbs::register('list_logbook', function($breadcrumbs){
    $breadcrumbs->push('Logbook', route('backend::logbook.index'));
});

Breadcrumbs::register('edit_logbook', function($breadcrumbs){
    $breadcrumbs->parent('list_logbook');
    $breadcrumbs->push('Ubah Logbook', route('backend::logbook.index'));
});

Breadcrumbs::register('create_logbook', function($breadcrumbs){
    $breadcrumbs->parent('list_logbook');
    $breadcrumbs->push('Tambah Logbook', route('backend::logbook.index'));
});