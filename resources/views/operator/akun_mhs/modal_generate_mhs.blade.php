<!-- Modal -->
<div class="modal fade" id="modalGenerate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Generate Akun Mahasiswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/akunMHS" method="POST">
      <div class="modal-body">
          @csrf
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Nama" required>
            @error('nama')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" placeholder="NIM" required>
            @error('nim')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="angkatan" class="form-label">Angkatan</label>

            <select class="form-control @error('angkatan') is-invalid @enderror" name="angkatan" aria-label="Default select example">
              <option value="" selected>Pilih Angkatan</option>
              @foreach ($semua_angkatan as $angkatan)
                <option value="{{ $angkatan }}" {{ (old('angkatan') == $angkatan)?"selected":"" }}>{{ $angkatan }}</option>
              @endforeach
            </select>
            @error('angkatan')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>

            <select class="form-control @error('status') is-invalid @enderror" name="status" aria-label="Default select example">
              <option value="Aktif" {{ (old('status') == "Aktif")?"selected":"" }} selected>Aktif</option>
              <option value="Cuti" {{ (old('status') == "Cuti")?"selected":"" }}>Cuti</option>
              <option value="Mangkir" {{ (old('status') == "Mangkir")?"selected":"" }}>Mangkir</option>
              <option value="DO" {{ (old('status') == "DO")?"selected":"" }}>DO</option>
              <option value="Undur Diri" {{ (old('status') == "Undur Diri")?"selected":"" }}>Undur Diri</option>
              <option value="Lulus" {{ (old('status') == "Lulus")?"selected":"" }}>Lulus</option>
              <option value="Meninggal Dunia" {{ (old('status') == "Meninggal Dunia")?"selected":"" }}>Meninggal Dunia</option>
            </select>
            @error('status')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="dosen_wali" class="form-label">Dosen Wali</label>

            <select class="form-control @error('dosen_wali') is-invalid @enderror" name="dosen_wali" aria-label="Default select example">
              <option value="" selected>Pilih Dosen Wali</option>
              @foreach ($data_doswal as $doswal)
                <option value="{{ $doswal->nip }}">{{ $doswal->nama }}</option>
              @endforeach
            </select>
            @error('status')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>

@if($errors->has('nama') OR $errors->has('nim') OR $errors->has('angkatan') OR $errors->has('status') OR $errors->has('dosen_wali'))
  <script>
    $(document).ready(function () {
      $('#modalGenerate').modal('show');
    });
  </script>
@endif