@extends('templates.main')

@section('container')

<style>
  /* Add this style to your existing CSS file or create a new one */

  /* Style for the card container */
  .card {
    border: 1px solid #fff;
    /* Set the white border for the card */
    border-radius: 10px;
    /* Set the border-radius for the card */
    box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
    /* Set a box shadow for the card */
    margin-bottom: 20px;
    /* Adjust the margin between cards as needed */
  }

  /* Style for the transparent card */
  .transparent-card {
    background-color: rgba(255, 255, 255, 0.2);
    /* Set the background color with transparency */
  }

  /* Style for the card title */
  .card h4 {
    color: #ffffff;
    /* Set the text color for the card title */
  }

  /* Style for the card body */
  .card-body {
    background-color: rgba(255, 255, 255, 0.1);
    /* Set the background color for the card body with transparency */
  }

  /* Style for the buttons inside the card */
  .card a.btn {
    margin-top: 10px;
    /* Adjust the top margin for the buttons */
  }

  /* Style for the date and status badge */
  .card .col-4.text-center h6,
  .card .col-4.border-start.border-end.text-center h5 {
    color: #ffffff;
    /* Set the text color for the date and status */
  }

  /* Style for the status badge */
  .col-auto.bg-success.rounded.border.text-white h3 {
    background-color: #28a745;
    /* Set the background color for the success status */
  }

  /* Style for the semester and nilai */
  .card .col-4.border-start.border-end.text-center h4,
  .card .col-4.text-center h5 {
    color: #ffffff;
    /* Set the text color for the semester and nilai */
  }

  /* Style for the nilai badge */
  .col-auto.bg-body-secondary.rounded.border h3 {
    background-color: rgba(255, 255, 255, 0.2);
    /* Set the background color for the nilai badge with transparency */
  }

  /* Style for the link in the file name */
  .card a[href^="/showFile"] {
    color: #007bff;
    /* Set the text color for the file name link */
  }

  /* Style for the validation status */
  .card h6 {
    color: #ffffff;
    /* Set the text color for the validation status */
  }

  /* Style for the text color of "Sudah" in validation status */
  .card .text-success {
    color: #28a745;
    /* Set the text color for the "Sudah" status */
  }

  /* Style for the text color of "Belum" in validation status */
  .card .text-danger {
    color: #dc3545;
    /* Set the text color for the "Belum" status */
  }
</style>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/validasiProgress">Validasi Progress Studi</a></li>
    <li class="breadcrumb-item"><a href="/validasiProgress/validasiSkripsi">Validasi Skripsi</a></li>
    <li class="breadcrumb-item"><a href="/validasiProgress/validasiSkripsi/{{ $angkatan }}">List Angkatan {{ $angkatan }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Skripsi {{ $mahasiswa->nim }}</li>
  </ol>
</nav>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row justify-content-center mb-3">
  <div class="col-auto">
    <h4>Skripsi</h4>
  </div>
</div>

<div class="card p-2 ps-3 mb-2 bg-body-tertiary">
  <div>Nama: {{ $nama }}</div>
  <div>NIM: {{ $nim }}</div>
</div>

<div class="card transparent-card mb-3">
  <div class="row m-2 position-absolute" style="right: 0">
    <div class="col-auto ms-auto">
      <h4 class="m-0">
        @if (isset($dataSkripsi))
        <div class="modalSkripsiButton" type="button" data-bs-toggle="modal" data-bs-target="#modalSkripsi" data-status="{{ $dataSkripsi->status  }}" data-semester="{{ $dataSkripsi->semester }}" data-tanggal-sidang="{{ $dataSkripsi->tanggal_sidang }}" data-nilai="{{ $dataSkripsi->nilai }}" data-scan-skripsi="{{ $dataSkripsi->scan_bass }}">
          <i class="bi bi-pencil-square"></i>
        </div>
        @endif
      </h4>
    </div>
  </div>

  <div class="row m-2 position-absolute" style="bottom: 0;right: 0">
    @if (isset($dataSkripsi))
    @if ($dataSkripsi->validasi == 0)
    <a href="/validateSkripsi/{{ $nim }}/1" class="btn btn-success btn-sm" type="button">
      Validasi
    </a>
    @else
    <a href="/validateSkripsi/{{ $nim }}/0" class="btn btn-danger btn-sm" type="button">
      Batal Validasi
    </a>
    @endif
    @endif
  </div>

  <div class="row d-flex justify-content-center align-items-center my-2 mx-2">
    <div class="col-4 text-center py-5">
      <div class="row mt-2">
        <div class="col">
          <h6>Tanggal Sidang</h6>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col">
          <h5>{{ (isset($dataSkripsi->tanggal_sidang))?$dataSkripsi->tanggal_sidang:"~" }}</h5>
        </div>
      </div>
    </div>

    <div class="col-4 border-start border-end text-center py-3 ">
      <div class="row">
        <div class="col">
          <h5>Status</h5>
        </div>
      </div>
      <div class="row mb-3 justify-content-center">
        <div class="col-auto {{ (isset($dataSkripsi))?"bg-success":"bg-body-secondary" }} rounded border text-white">
          <h3 class="my-1">{{ (isset($dataSkripsi))?"Lulus":"~" }}</h3>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h6>Semester Skripsi</h6>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h4>{{ (isset($dataSkripsi->semester))?$dataSkripsi->semester:"~" }}</h4>
        </div>
      </div>
    </div>

    <div class="col-4 text-center py-5">
      <div class="row">
        <div class="col">
          <h5>Nilai</h5>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-auto bg-body-secondary rounded border">
          <h3 class="my-1">{{ (isset($dataSkripsi->nilai))?$dataSkripsi->nilai:"~" }}</h3>
        </div>
      </div>

      <div class="row mt-3">
        @if (isset($dataSkripsi) && !is_null($dataSkripsi->scan_bass))
        <div class="col">
          <h6 class="m-0">Scan BASS: <a href="/showFile/{{ $dataSkripsi->scan_bass }}" target="__blank">scan-bass.pdf</a></h6>
        </div>
        @else
        <div class="col">
          <h6 class="m-0">Scan BASS: ~</h6>
        </div>
        @endif
      </div>

      <div class="row mt-3">
        @if (isset($dataSkripsi) && $dataSkripsi->validasi == 1)
        <div class="col">
          <h6>Validasi: <span class="text-success">Sudah</span></h6>
        </div>
        @else
        <div class="col">
          <h6>Validasi: <span class="text-danger">Belum</span></h6>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

@include('operator.validasi_progress_studi.skripsi.modal_edit_skripsi')
<script src="/js/modal.js"></script>
@if ($errors->any())
@dump($errors)
@endif
@endsection