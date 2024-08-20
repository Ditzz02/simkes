<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('beranda', function (BreadcrumbTrail $trail) {
    $trail->push('Beranda', route('beranda'));
});

// Home > Blog
Breadcrumbs::for('daftar_mahasiswa', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Mahasiswa', route('daftar_mahasiswa'));
});

Breadcrumbs::for('tambah_mahasiswa', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Mahasiswa');
    $trail->push('Tambah', route('tambah_mahasiswa'));
});

Breadcrumbs::for('edit_mahasiswa', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Mahasiswa');
    $trail->push('Edit', route('edit_mahasiswa'));
});

Breadcrumbs::for('daftar_dosen', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Dosen', route('daftar_dosen'));
});

Breadcrumbs::for('tambah_dosen', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Dosen');
    $trail->push('Tambah', route('tambah_dosen'));
});

Breadcrumbs::for('edit_dosen', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Dosen');
    $trail->push('Edit', route('edit_dosen'));
});

Breadcrumbs::for('daftar_mk', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Mata Kuliah', route('daftar_mk'));
});

Breadcrumbs::for('tambah_mk', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Mata Kuliah');
    $trail->push('Tambah', route('tambah_mk'));
});

Breadcrumbs::for('daftar_nilai', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Nilai', route('daftar_nilai'));
});

Breadcrumbs::for('tambah_nilai', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Nilai');
    $trail->push('Tambah', route('tambah_nilai'));
});