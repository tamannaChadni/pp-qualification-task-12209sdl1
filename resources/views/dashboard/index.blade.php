@extends('layout.main')
@section('title', 'Transcation Details')
@section('content')
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
        Transcation
    </button>
    <!-- /.modal -->
    <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">Transcation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="myTrans">

                    <form class="">
                        <div class="form-group">
                            <label>Amount</label><br>
                            <input type="number" name="amount" id="amount">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Transcation Type</label>
                            <select class="form-control" name="transcation_type" id="transcation_type">
                                <option></option>
                                <option value="0">Add Money</option>
                                <option value="1">Send Money</option>
                                <option value="2">Cash In</option>
                                <option value="3">Cash out</option>
                            </select>
                        </div><br>
                        <div class="form-group">
                            <label>Account</label><br>
                            <input type="email" name="email" id="email">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-light" id="btn_save">Transcation
                                save</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // console.log($('#modal-info form'));
            $('#modal-info').on('submit', 'form', function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // console.log('submitted');
                const data = $(this).serialize();
                var state = $('#btn_save').val();
                var type = "POST"
                var ajaxurl = 'transcation';
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: data,
                    // dataType: 'text',
                    success: function(data) {
                        setTimeout(() => {
                            toastr.success(data.message, data.title);
                        }, 300)
                        $('#modal-info').modal('hide');
                    },

                    error: function(data) {
                        setTimeout(() => {
                            toastr.error(data.message, data.title);
                        }, 300)
                    }
                })
            })
        })
    </script>

@endsection
