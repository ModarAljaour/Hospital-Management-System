<!-- Modal -->
<div class="modal fade" id="add_diagnosis{{ $invoice->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تشخيص حالة مريض</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('diagnostics.store') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                    <input type="hidden" name="patient_id" value="{{ $invoice->patient_id }}">
                    <input type="hidden" name="doctor_id" value="{{ $invoice->doctor_id }}">

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">التشخيص</label>
                        <textarea class="form-control" name="diagnosis" rows="6"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ trans('Doctors.drugs') }}</label>
                        <textarea class="form-control" name="medicine" rows="6"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Doctors.close') }}</button>
                    <button type="submit" class="btn btn-primary"> {{ trans('Doctors.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
