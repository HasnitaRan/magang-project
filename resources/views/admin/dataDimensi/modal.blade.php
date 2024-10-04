<div class="modal fade" id="dimensiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="dimensiForm">
                    {{-- <input type="hidden" name="id" id="id"> --}}
                    <div class="mb-3">
                        <label for="dimensi">Dimensi</label>
                        <input type="text" name="dimensi" class="form-control" id="dimensi">
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