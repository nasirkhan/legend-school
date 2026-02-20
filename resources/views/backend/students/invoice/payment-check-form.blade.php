<div class="row">
    <div class="col-12">
        <table class="table table-sm table-bordered table-striped">
            <thead>
            <tr>
                <td><strong>Name : </strong>{{ $student->name }}</td>
                <td><strong>ID : </strong>{{ $student->roll }}</td>
                <td><strong>Class : </strong>{{ $monthlyFee->class->code }}</td>
                <td><strong>Session : </strong>{{ $monthlyFee->year }} - {{ $monthlyFee->year+1 }}</td>
{{--                <td><strong>Invoice No : </strong>{{ $invoice->invoice_no }}</td>--}}
{{--                <td><strong>Due Date : </strong>{{ $invoice->deadline===null? '' : dateFormat($invoice->deadline,'jS M Y') }}</td>--}}
            </tr>
            </thead>
        </table>
    </div>
    <div class="col-lg-8 col-md-7 pr-md-0">
        @php($colspan = 2)
        <table class="table table-bordered table-striped table-sm">
            <tr>
                <th style="width: 20px">Sl.</th>
                <th class="" style="width: 30px">Select</th>
                <th>Description</th>
                <th>Reference</th>
                <th class="text-right">Amount(Tk)</th>
                <th class="text-center">Status</th>
            </tr>
            @php($sl = 1)

{{--            @if(isset($invoice->previousDue))--}}
{{--                @php($previousDue = $invoice->previousDue)--}}
{{--                <tr>--}}
{{--                    <td>{{ $sl++ }}</td>--}}
{{--                    <td>Previous Due</td>--}}
{{--                    <td>{{ $previousDue->description }}</td>--}}
{{--                    <td class="text-right">{{ numberFormat($previousDue->receivable) }}</td>--}}
{{--                </tr>--}}
{{--            @endif--}}

            @foreach($studentPaymentItems as $studentPaymentItem)

                @php($lateFeeReport = checkLateFee($studentPaymentItem->id))
                @php($amount = $studentPaymentItem->receivable + $lateFeeReport['late_fee'])

                <tr class="{{ $lateFeeReport['late_fee']>0 and $studentPaymentItem->status!=1? 'text-danger':'' }}">
                    <td class="text-center">{{ $sl++ }}</td>
                    <td class="text-center">
                        @if($studentPaymentItem->status==1)

                        @elseif($studentPaymentItem->status==2)
                            <div class="custom-control custom-checkbox custom-checkbox-secondary">
                                <input type="checkbox"
                                       name="student_payment_items[{{ $studentPaymentItem->id }}]"
                                       class="custom-control-input class-item"
                                       id="student_payment_item-{{ $studentPaymentItem->id }}"
                                       onclick="studentPaymentCalculate()"
                                       value="{{ $amount }}"
                                >
                                <label class="custom-control-label" for="student_payment_item-{{ $studentPaymentItem->id }}"></label>
                            </div>
                        @endif
                    </td>
                    <td>
                        {{ $studentPaymentItem->item->name }}
                        @if($studentPaymentItem->lab_fee>0) + Lab Fee @endif

                        @if($lateFeeReport['late_fee']>0) + Late Fee @endif

                        @if($studentPaymentItem->item->billing_cycle==2)
                            ({{ $studentPaymentItem->year }} -  {{ $studentPaymentItem->year+1 }})
                        @elseif($studentPaymentItem->item->billing_cycle==3)
                            ({{ $studentPaymentItem->month->name }} - {{ dateFormat($studentPaymentItem->due_date,'Y') }})
                        @endif
                    </td>

                    <td>
                        @if($studentPaymentItem->status==1)

                        @elseif($studentPaymentItem->status==2)
                            {!! $lateFeeReport['message'] !!}
                        @endif
                    </td>

                    <td class="text-right">
                        {{ numberFormat($amount) }}
                    </td>

                    <td class="text-center">
                        @if($studentPaymentItem->status==1)
                            <span style="font-size: smaller" class="badge badge-soft-success">Paid</span>
                        @elseif($studentPaymentItem->status==2 and $studentPaymentItem->due_date == null)
                            <span style="font-size: smaller" class="badge badge-soft-warning">Unpaid</span>
                        @elseif($studentPaymentItem->status==2 and $lateFeeReport['late_fee']>0)
                            <span style="font-size: smaller" class="badge badge-soft-danger">Late</span>
                        @elseif($studentPaymentItem->status==2 and $lateFeeReport['late_fee']==0)
                            <span style="font-size: smaller" class="badge badge-soft-secondary">Upcoming</span>
                        @endif
                    </td>
                </tr>
            @endforeach

{{--            @php($fine=0) @php($discount=0)--}}
{{--            @php($delay = invoiceDelay($invoice->deadline))--}}
{{--            @if($delay>0)--}}
{{--                                @php($perDayFine = siteInfo('daily_fine'))--}}
{{--                                @php($fine = $delay*$perDayFine)--}}
{{--                @php($lateFee = lateFee($invoice->id))--}}
{{--                @php($fine = $lateFee['fine'])--}}
{{--                <tr>--}}
{{--                    <td>{{ ++$sl }}</td>--}}
{{--                    <td>Late Fee</td>--}}
{{--                    <td>{{ $lateFee['reference'] }}</td>--}}
{{--                    <td class="text-right">--}}
{{--                        {{ numberFormat($fine) }}--}}
{{--                        <input type="hidden" name="late_fee" value="{{ $fine }}"/>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>{{ ++$sl }}</td>--}}
{{--                    <td>Discount</td>--}}
{{--                    <td>--}}
{{--                        <input type="text" name="reference" value="Late Fee"/>--}}
{{--                    </td>--}}
{{--                    @php($discount=0)--}}
{{--                    <td class="text-right">--}}
{{--                                                {{ numberFormat($discount) }}--}}
{{--                        <input type="text" name="discount" value="{{ $discount }}" class="text-right"--}}
{{--                               onclick="this.select()"--}}
{{--                               onkeyup="discountCalculate({--}}
{{--                           invoice_total:{{ $invoice->receivable_amount }},--}}
{{--                           fine:{{ $fine }},--}}
{{--                           element:this,--}}
{{--                           })"--}}

{{--                               onblur="discountCalculate({--}}
{{--                           invoice_total:{{ $invoice->receivable_amount }},--}}
{{--                           fine:{{ $fine }},--}}
{{--                           element:this,--}}
{{--                           })"--}}
{{--                        />--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endif--}}



{{--            <tr>--}}
{{--                @php($receivable = $invoice->receivable_amount+$fine-$discount)--}}
{{--                <th class="text-center" colspan="3">Total Amount</th>--}}
{{--                <th class="text-right" id="showReceivableAmount">{{ numberFormat($receivable) }}</th>--}}
{{--                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}"/>--}}
{{--                <input type="hidden" name="receivable_amount" id="receivableAmount" value="{{ $receivable }}"/>--}}
{{--            </tr>--}}

        </table>
    </div>

    <div class="col-lg-4 col-md-5">
        <table class="table table-sm table-bordered table-striped table-centered">
            <tr>
                <th colspan="2" class="text-primary"><i class="bx bx-dollar-circle font-weight-bold"></i> Payment Methods</th>
            </tr>

            <tr class="bg-primary">
                <th class="text-white">Total</th>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text pt-0 pb-0">Tk.</span>
                        </div>
                        <input type="number" onkeyup="calculateTotal()" min="0" id="total"
                               name="total" onclick="this.select()" value="0"
                               class="form-control form-control-sm text-center" readonly
                        />
                    </div>
                </td>
            </tr>

            <tr class="bg-warning">
                <th class="text-white">Discount</th>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text pt-0 pb-0">Tk.</span>
                        </div>

                        <input type="number" onkeyup="studentPaymentCalculate()" min="0" id="discount"
                               name="discount" onclick="this.select()" value="0"
                               class="form-control form-control-sm text-center"
                        />
                    </div>
                </td>
            </tr>

            <tr class="bg-warning">
                <th class="text-white">Note</th>
                <td>
                    <div class="input-group">
                        <input type="text" id="note" name="note" placeholder="Note about discount if any" class="form-control form-control-sm text-center"/>
                    </div>
                </td>
            </tr>

            <tr class="bg-success">
                <th class="text-white">Receivable</th>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text pt-0 pb-0">Tk.</span>
                        </div>

                        <input type="number" onkeyup="calculateTotal()" min="0" id="receivable"
                               name="receivable" onclick="this.select()" value="0"
                               class="form-control form-control-sm text-center" readonly
                        />
                    </div>
                </td>
            </tr>

            <tr>
                <td>Cash</td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text pt-0 pb-0">Tk.</span>
                        </div>

                        <input type="number" onkeyup="calculateTotal()" min="0" id="cash"
                               name="payment_amounts[1]" onclick="this.select()" value="0"
                               class="form-control form-control-sm text-center payment-method"
                        />

                    </div>
                </td>
            </tr>

            <tr>
                <td>bKash</td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text pt-0 pb-0">Tk.</span>
                        </div>
                        <input type="number" onkeyup="calculateTotal()" min="0"
                               name="payment_amounts[2]" onclick="this.select()" value="0"
                               class="form-control form-control-sm text-center payment-method"
                        />
                        <input type="text" name="payment_references[2]" class="form-control form-control-sm text-center payment-method" placeholder="Reference"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Nagad</td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text pt-0 pb-0">Tk.</span>
                        </div>
                        <input type="number" onkeyup="calculateTotal()" min="0"
                               name="payment_amounts[3]" onclick="this.select()" value="0"
                               class="form-control form-control-sm text-center payment-method"
                        />
                        <input type="text" name="payment_references[3]" class="form-control form-control-sm text-center payment-method" placeholder="Reference"/>
                    </div>
                </td>
            </tr>

            <tr>
                <td>Bank</td>
                <td>
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text pt-0 pb-0">Tk.</span>
                        </div>
                        <input type="number" onkeyup="calculateTotal()" min="0"
                               name="payment_amounts[4]" onclick="this.select()" value="0"
                               class="form-control form-control-sm text-center payment-method"
                        />
                        <input type="text" name="payment_references[4]" class="form-control form-control-sm text-center payment-method" placeholder="Reference"/>
                    </div>
                </td>
            </tr>

            <tr class="bg-info">
                <th class="text-white">Received</th>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text pt-0 pb-0">Tk.</span>
                        </div>
                        <input type="number" name="total_received" value="0" class="form-control form-control-sm text-center bg-light" readonly>
                    </div>
                </td>
            </tr>

            <tr>
                <td>Date</td>
                <td>
                    <div class="input-group">
                        <input type="date" name="payment_date" class="form-control form-control-sm text-center">
                    </div>
                </td>
            </tr>

            <tr>
{{--                <th></th>--}}
                <th colspan="2">
                    <button class="btn btn-success btn-sm btn-block font-weight-bold" id="submitButton" type="submit"><i class="fa fa-money-bill-wave"></i> Collect Payment</button>
                </th>
            </tr>
        </table>
    </div>
</div>

<script>
    function discountCalculate(obj){
        let discount = Number(obj.element.value);
        if (isNaN(discount)){
            obj.element.value = 0;
        }
        let total = Number(obj.invoice_total);
        let fine = Number(obj.fine);
        let newTotal = total+fine-discount;

        document.querySelector('#showReceivableAmount').textContent = numberWithCommas(newTotal);
        document.querySelector('[name="receivable_amount"]').value = newTotal;
        calculateTotal();
    }

    function calculateTotal(){
        let pMethods = document.querySelectorAll('.payment-method');
        let total = 0;
        for (let i = 0; i < pMethods.length; i++) {
            total += Number(pMethods[i].value);
        }
        document.querySelector('[name="total_received"]').value = total;
    }

    document.getElementById('collectPayment').addEventListener('submit', function (e) {
        e.preventDefault();
        let receivableAmount = Number(document.querySelector('[name="receivable_amount"]').value);
        let total = Number(document.querySelector('[name="total_received"]').value);
        if(total === receivableAmount){
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to collect payment ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes Collect'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        }else {
            let msg = `Total Received Amount: <strong>${numberWithCommas(total)}</strong><br>Must be equal to <br>Receivable Amount: <strong>${numberWithCommas(receivableAmount)}</strong>`
            Swal.fire({
                title: '<strong>Inconsistent <u>Amount</u></strong>',
                html: `${msg}`,
                icon: 'error'
            });
        }
    });

    document.addEventListener("keydown", function (event) {
        // Check if F2 is pressed (key code 113)
        if (event.key === "F2") {
            event.preventDefault(); // Prevent default F2 action (optional)
            document.getElementById("submitButton").focus();
        }
    });

    document.addEventListener("keydown", function (event) {
        if (event.altKey && event.key.toLowerCase() === "c") {
            event.preventDefault(); // optional: prevent browser default action
            document.getElementById("cash").select();
        }
    });

    document.addEventListener("keydown", function (event) {
        if (event.altKey && event.key.toLowerCase() === "d") {
            event.preventDefault(); // optional: prevent browser default action
            document.getElementById("discount").select();
        }
    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function removeCommas(str) {
        return parseFloat(str.replace(/,/g, ""));
    }
</script>

<script>
    function studentPaymentCalculate(){
        let totalAmount = amountCalculate()
        let discount = Number(document.querySelector("#discount").value)
        document.querySelector("#total").value = totalAmount
        document.querySelector("#receivable").value = (totalAmount - discount)
    }

    function amountCalculate(){
        let checkedItems = document.querySelectorAll('.class-item:checked');
        let sum = 0;
        for (const item of checkedItems) {
            sum += Number(item.value)
        }
        return sum
    }

    document.getElementById('collectPayment').addEventListener('submit', function (e) {
        e.preventDefault();
        let receivableAmount = Number(document.querySelector('[name="receivable"]').value);
        let total = Number(document.querySelector('[name="total_received"]').value);
        if(total === receivableAmount){
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to collect payment ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes Collect'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        }else {
            let msg = `Total Received Amount: <strong>${numberWithCommas(total)}</strong><br>Must be equal to <br>Receivable Amount: <strong>${numberWithCommas(receivableAmount)}</strong>`
            Swal.fire({
                title: '<strong>Inconsistent <u>Amount</u></strong>',
                html: `${msg}`,
                icon: 'error'
            });
        }
    });
</script>
