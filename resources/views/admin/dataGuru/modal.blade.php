<div class="modal fade" id="guruModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="guruForm" action="#">
                    <div class="mb-3">
                        <label for="nama_guru">Nama <small class="text-danger">*</small></label>
                        <input type="text" name="nama_guru" class="form-control" id="nama_guru"
                            placeholder="Ketik Nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="nip">NIP<small class="text-danger">*</small></label>
                        <input type="number" name="nip" class="form-control" id="nip"
                            placeholder="Ketik NIP">
                    </div>
                    <div class="mb-3">
                        <label for="tempat_lahir">Tempat Lahir<small class="text-danger">*</small></label>
                        <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                            placeholder="Ketik Tempat Lahir">
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir">Tanggal Lahir<small class="text-danger">*</small></label>
                        <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir">
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin <small class="text-danger">*</small></label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option disabled selected hidden>-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="agama">Agama <small class="text-danger">*</small></label>
                        <select name="agama" id="agama" class="form-control" required>
                            <option disabled selected hidden>-- Pilih --</option>
                            <option value="1">Islam</option>
                            <option value="2">Kristen</option>
                            <option value="3">Katolik</option>
                            <option value="4">Hindu</option>
                            <option value="5">Budha</option>
                            <option value="6">Konghucu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alamat">Alamat<small class="text-danger">*</small></label>
                        <textarea name="alamat" class="form-control" id="alamat" placeholder="Ketik Alamat"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp">No HP<small class="text-danger">*</small></label>
                        <input type="number" name="no_hp" class="form-control" id="no_hp"
                            placeholder="Ketik No HP">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email Akun<small class="text-danger">*</small></label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Ketik Email">
                    </div>
                    <!-- Status Akun only visible during editing -->
                    <div class="mb-3" id="statusAkunContainer" style="display: none;">
                        <label for="status_aktif" class="form-label">Status Guru</label>
                        <select class="form-select" id="status_aktif" name="status_aktif" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="float-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnSubmit"></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
