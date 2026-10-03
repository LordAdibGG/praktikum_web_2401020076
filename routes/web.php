<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form-mahasiswa', function () {
    return view('form-mahasiswa');
});

Route::post('/form-mahasiswa', function (Request $request) {

    // ===== 1. SANITASI =====
    $dataBersih = [
        'nama'  => strip_tags(trim((string) $request->input('nama'))),
        'email' => filter_var(
            (string) $request->input('email'),
            FILTER_SANITIZE_EMAIL
        ),
        'nim'   => trim((string) $request->input('nim')),
        'usia'  => trim((string) $request->input('usia')),
    ];

    // ===== 2. VALIDASI =====
    $validator = Validator::make($dataBersih, [
        'nama'  => ['required', 'min:3', 'max:50'],
        'email' => ['required', 'email'],
        'nim'   => ['required', 'digits_between:8,12'],
        'usia'  => ['required', 'integer', 'min:17', 'max:60'],
    ], [
        'nama.required' => 'Nama wajib diisi.',
        'nama.min'      => 'Nama minimal 3 karakter.',
        'nama.max'      => 'Nama maksimal 50 karakter.',

        'email.required' => 'Email wajib diisi.',
        'email.email'    => 'Format email tidak valid.',

        'nim.required'       => 'NIM wajib diisi.',
        'nim.digits_between' => 'NIM harus berupa angka 8 sampai 12 digit.',

        'usia.required' => 'Usia wajib diisi.',
        'usia.integer'  => 'Usia harus berupa angka.',
        'usia.min'      => 'Usia minimal 17 tahun.',
        'usia.max'      => 'Usia maksimal 60 tahun.',
    ]);

    // ===== 3. PENANGANAN ERROR =====
    if ($validator->fails()) {
        return redirect('/form-mahasiswa')
            ->withErrors($validator)
            ->withInput();
    }

    // ===== 4. DATA VALID =====
    $data = $validator->validated();
    $data['usia'] = (int) $data['usia'];

    return view('hasil-form', ['data' => $data]);
});