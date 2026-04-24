<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function ppdb() {
        return view('sistem.layout', ['title' => 'PPDB Online', 'icon' => 'fa-user-plus']);
    }

    public function akademik() {
        return view('sistem.layout', ['title' => 'Sistem Akademik & E-Rapor', 'icon' => 'fa-book-reader']);
    }

    public function keuangan() {
        return view('sistem.layout', ['title' => 'Sistem Keuangan & SPP', 'icon' => 'fa-wallet']);
    }

    public function hrd() {
        return view('sistem.layout', ['title' => 'SDM & Manajemen HR', 'icon' => 'fa-users-cog']);
    }

    public function inventaris() {
        return view('sistem.layout', ['title' => 'Inventaris & Gudang', 'icon' => 'fa-boxes']);
    }

    public function registration() {
        return view('auth.register');
    }
}
