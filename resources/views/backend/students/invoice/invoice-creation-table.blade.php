<table class="table table-centered table-bordered table-hover table-sm">
    <thead>
    <tr>
        <th style="width: 40px">SL</th>
        <th>Name</th>
        <th>Stdn. ID</th>
        <th>Mother Mob.</th>
        <th class="text-center" style="width: 120px">Monthly(Tk.)</th>
        <th class="text-center" style="width: 120px">Discount(%)</th>
        <th class="text-center" style="width: 120px">Receivable(Tk.)</th>
        <th class="text-center" style="width: 100px">
            <div class="custom-control custom-checkbox custom-control-left">
                <input type="checkbox" class="custom-control-input" id="checkAll">
                <label class="custom-control-label" for="checkAll">Check All</label>
            </div>
        </th>
    </tr>
    </thead>
    <tbody>
    @if(count($students)>0)
        @foreach($students as $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student['info']->name }}</td>
                <td>{{ $student['info']->roll }}</td>
                <td>{{ $student['info']->mother_mobile }}</td>
                <td><input type="text" class="form-control text-center" name="fee[{{ $student['info']->id }}]" value="{{ $student['fee']->monthly_fee }}" readonly></td>
                <td><input type="text" class="form-control text-center" name="discount[{{ $student['info']->id }}]" value="{{ $student['fee']->discount }}" readonly></td>
                <td><input type="text" class="form-control text-center" name="payable[{{ $student['info']->id }}]" value="{{ $student['fee']->payable }}" readonly></td>
                <td class="text-center">
                    <div class="custom-control custom-checkbox custom-control-left">
                        <input type="checkbox" name="students[{{ $student['info']->id }}]" class="custom-control-input student" id="customCheck{{ $student['info']->id }}">
                        <label class="custom-control-label" for="customCheck{{ $student['info']->id }}">Check</label>
                    </div>
                </td>
            </tr>
        @endforeach

        <input type="hidden" name="class_item_id" value="{{ $item->id }}"/>
    @endif
    </tbody>
    @if(count($students)>0)
        <tfoot>
        <tr>
            <th colspan="8">
                <button type="submit" class="btn btn-success btn-sm btn-block">Create Invoice</button>
            </th>
        </tr>
        </tfoot>
    @else
        <tfoot>
        <tr>
            <th class="text-center text-danger" colspan="8">No Student Found for Invoice Creation.</th>
        </tr>
        </tfoot>
    @endif
</table>

<script>
    // document.addEventListener("visibilitychange", function () {
    //     if (document.visibilityState === "visible") {
    //         // console.log("Tab is active");
    //         getClassWiseStudentInvoice()
    //     }
    // });

    document.getElementById("checkAll").addEventListener("click", function () {
        let checkboxes = document.querySelectorAll('.student');
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    })

    document.getElementsByClassName('student').forEach(function (item) {
        item.addEventListener('click', function () {
            let checkboxes = document.querySelectorAll('.student');
            let total = 0;
            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    total += 1;
                }
            }
            if (total === checkboxes.length) {
                document.querySelector('#checkAll').checked = true;
            }else {
                document.querySelector('#checkAll').checked = false;
            }
        })
    })

</script>
