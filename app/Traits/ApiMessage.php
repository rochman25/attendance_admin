<?php

namespace App\Traits;

trait ApiMessage
{
    public $validationError = "Validasi Error.";
    public $loginSukses = "Login berhasil";
    public $loginGagal = "Login gagal";
    public $dataFound = "Data ditemukan.";
    public $dataNotFound = "Data tidak ditemukan.";
    public $addSuccess = "Data berhasil ditambahkan.";
    public $addFailed = "Data gagal ditambahkan";
    public $updateSuccess = "Data berhasil diperbarui.";
    public $deleteSuccess = "Data berhasil dihapus.";
    public $unknownMode = "Mode tidak ditemukan.";
    public $saveSuccess = "Data berhasil disimpan";

    public $nis = "test";

    public $attendanceSignIn = "Selamat sudah presensi masuk hari ini.";
    public $attendanceSignOut = "Selamat sudah presensi keluar hari ini.";

    public $attendanceSignInLimit = "Sudah presensi masuk hari ini";
    public $attendanceSignOutLimit = "Sudah presensi keluar hari ini";

    public $attendanceDone = "Sudah presensi hari ini";
    public $tokenRefreshed = "Token berhasil di refresh";
}

