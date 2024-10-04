<div class="modal fade" id="elemenModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="elemenForm">
                    {{-- <input type="hidden" name="id" id="id"> --}}
                    <div class="mb-3">
                        <label for="elemen">Elemen</label>
                        <input type="text" name="elemen" class="form-control" id="elemen">
                    </div>
                    <div class="mb-3">
                        <label for="id_dimensi">Dimensi</label>
                        <select name="id_dimensi" class="form-control" id="id_dimensi">
                            <option value="">-- Pilih Dimensi --</option>
                            @foreach ($dimensi as $d)
                                <option value="{{ $d->id }}">{{ $d->dimensi }}</option>
                            @endforeach
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
