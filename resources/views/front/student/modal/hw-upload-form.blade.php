<style>
    #progressDiv {
        width: 100%;
        background-color: lightgray;
        border-radius: 5px;
        overflow: hidden;
        position: relative;
    }

    #progressBar {
        height: 20px;
        width: 0;
    }

    #progressText{
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        color: white;
        font-weight: bold;
    }

</style>
<div id="hwUploadForm" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Subject : <span id="subject"></span> || Home Work : <span id="title"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="uploadForm" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <input type="file" id="file" class="form-control" name="file">

                    <input type="hidden" name="student_id" value="{{ $studentClass->student_id }}"/>
                    <input type="hidden" name="hw_id" value="{{ $hw->id }}"/>
                    <!-- Progress Bar -->
                    <div id="progressDiv" style="display:none;" class="mt-2">
                        <div id="progressBar" class="bg-success"></div>
                        <p id="progressText"></p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger waves-effect" ><i class="fa fa-recycle"></i> Reset</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="fa fa-save"></i> Upload</button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
