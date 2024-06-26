@extends('templates.main')

@section('container')

<style>
  .card {
    border-radius: 10px;
    margin: 1rem;
    padding: 1.5rem;
  }

  .card-header {
    background-color: #6c757d;
    color: #fff;
    border-radius: 10px 10px 0 0;
  }

  .table-bordered {
    border: 1px solid #dee2e6;
    margin-top: 1rem;
  }

  .table-bordered th,
  .table-bordered td {
    border: 1px solid #6c757d;
    padding: 0.75rem;
    text-align: center;
  }

  .point {
    cursor: pointer;
  }

  .rekap-pkl {
    background-color: #d1ecf1;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: #fff;
  }
</style>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/rekapMhsPerwalian">Rekap Mahasiswa Perwalian</a></li>
    <li class="breadcrumb-item active" aria-current="page">Rekap PKL Mahasiswa</li>
  </ol>
</nav>

<div class="row text-center mb-3">
  <h4>Rekap Progress PKL Mahasiswa Perwalian Informatika</h4>
</div>

<div class="card bg-body-tertiary table-responsive" id="rekap-pkl-main">
  <div class="row d-flex justify-content-center m-0">
    <div class="col-auto">
      <h5>Angkatan</h5>
    </div>
  </div>

  <table class="table-bordered text-center rounded">
    <tr>
      @for ($i = $current_year - 6; $i <= $current_year; $i++) <td colspan="2">{{ $i }}</td>
        @endfor
    </tr>

    <tr>
      @for ($i = $current_year - 6; $i <= $current_year; $i++) @if (isset($rekap_pkl[$i])) <td class="point rekap-pkl" data-angkatan="{{ $i }}" data-status="Sudah">Sudah</td>
        <td class="point rekap-pkl" data-angkatan="{{ $i }}" data-status="Belum">Belum</td>
        @else
        <td class="point rekap-pkl" data-angkatan="{{ $i }}" data-status="Sudah">Sudah</td>
        <td class="point rekap-pkl" data-angkatan="{{ $i }}" data-status="Belum">Belum</td>
        @endif
        @endfor
    </tr>

    <tr>
      @for ($i = $current_year - 6; $i <= $current_year; $i++) @if (isset($rekap_pkl[$i])) <td class="point rekap-pkl" data-angkatan="{{ $i }}" data-status="Sudah">{{ $rekap_pkl[$i]["sudah_pkl"] }}</td>
        <td class="point rekap-pkl" data-angkatan="{{ $i }}" data-status="Belum">{{ $rekap_pkl[$i]["belum_pkl"] }}</td>
        @else
        <td class="point rekap-pkl" data-angkatan="{{ $i }}" data-status="Sudah">0</td>
        <td class="point rekap-pkl" data-angkatan="{{ $i }}" data-status="Belum">0</td>
        @endif
        @endfor
    </tr>
  </table>
</div>

<div class="row justify-content-between">
  <div class="col-auto">
    {{-- <button class="btn btn-primary btn-sm" id="btn-print-rekap">Cetak</button> --}}
    <form action="/printRekapPKL" target="blank" method="post">
      @csrf
      <input type="hidden" name="rekap_pkl" value="{{ json_encode($rekap_pkl) }}">
      <input type="hidden" name="current_year" value="{{ $current_year }}">
      <button class="btn btn-secondary btn-sm mt-2" type="submit">Cetak</button>
    </form>
  </div>
</div>

<div class="row mt-4 mb-3">
  <div class="col list-mhs-pkl">
  </div>
</div>

<script src="/js/rekap.js"></script>
@endsection