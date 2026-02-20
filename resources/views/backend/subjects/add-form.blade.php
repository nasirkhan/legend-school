<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New Subject</h5>
    <form class="" action="{{ route('subject-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-10 pr-md-0 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Subject</span>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="Subject name"/>
                </div>
            </div>

{{--            <div class="col-lg-3 pr-md-0 mb-2">--}}
{{--                <div class="input-group">--}}
{{--                    <div class="input-group-prepend">--}}
{{--                        <span class="input-group-text">Serial</span>--}}
{{--                    </div>--}}
{{--                    <input type="number" name="sl" class="form-control" placeholder="Serial no."/>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="col-lg-2 mb-2">
                <div class="row">
                    <div class="col"><button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button></div>
                </div>
            </div>
        </div>
    </form>
</div>
