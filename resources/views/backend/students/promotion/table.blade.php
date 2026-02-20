<table id="datatable_" class="table table-hover table-sm table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th style="width: 30px">Sl.</th>
        <th>Name</th>
        <th>Stdn. ID</th>
        <th>Moth. Mob.</th>
        <th class="text-center">
            Payment Details
        </th>

        <th>Total</th>
        <th class="text-right" style="width: 100px">Discount(Tk.)</th>
        <th class="text-right" style="width: 90px">Receivable(Tk.)</th>
        <th class="text-center" style="width: 220px">Remark</th>
        <th class="text-center" style="width: 80px">
            Select All
            @if(count($students)>0)
                <input type="checkbox" class="form-control" style="font-size: 1pt" onchange="checkAll(this)">
            @endif
        </th>
    </tr>
    </thead>
    <tbody>
    @if(count($students)>0)
        @foreach($students as $student)
            @php($sl = $loop->iteration)
            <tr>
                <td>{{ $sl }}</td>
                <td>{{ $student['name'] }}</td>
                <td>{{ $student['roll'] }}</td>
                <td>{{ $student['mother_mobile'] }}</td>
                <td class="py-0">
                    <table>
                        @php($chargesForOneStudent = 0)
                        @foreach($charges as $charge)
                            <tr>
                                <td class="">
                                    <input type="checkbox" style="" checked class="checked-{{ $student['id'] }}"
                                           id="checkbox-{{ $student['id'] }}-{{ $charge['class_item_id'] }}"
                                           name="charges[{{ $student['id'] }}][{{ $charge['class_item_id'] }}]"
                                           onclick="itemWiseDiscountCalculate('{{ $student['id'] }}','{{ $charge['class_item_id'] }}')"
                                    />
                                    <label class="font-weight-normal mb-0" for="checkbox-{{ $student['id'] }}-{{ $charge['class_item_id'] }}">{{ $charge['name'] }}</label>
                                </td>
                                <td>:</td>
                                <td class="text-right amount-{{ $student['id'] }}" id="amount_{{ $student['id'] }}_{{ $charge['class_item_id'] }}">{{ $charge['amount'] }}</td>
                                <td>
                                    <input type="number" name="item_discount[{{ $student['id'] }}][{{ $charge['class_item_id'] }}]" placeholder="Discount"
                                           id="item_discount_{{ $student['id'] }}_{{ $charge['class_item_id'] }}"
                                           class="form-control text-center item_discount_{{ $student['id'] }} pt-0 pb-0 pr-1 pl-2" style="height: 25px; width: 90px"
                                           onkeyup="itemWiseDiscountCalculate('{{ $student['id'] }}','{{ $charge['class_item_id'] }}')"
                                           onclick="this.select();"
                                    />
                                </td>
                            </tr>
                            @php($chargesForOneStudent += $charge['amount'])
                        @endforeach
                    </table>

                </td>

                <td id="total_amount_{{ $student['id'] }}">
                    {{ $chargesForOneStudent }}
                </td>

                <td>
                    <input type="number" name="discount[{{ $student['id'] }}]" readonly
                           class="form-control pt-1 pb-1 text-center discount"
                           value="0" min="0" max="{{ $chargesForOneStudent }}" placeholder="0.00"
                           id="discount_{{ $student['id'] }}"
                    />
                </td>



                <td>
                    <input type="number" name="receivable[{{ $student['id'] }}]"
                           class="form-control pt-1 pb-1 text-center"
                           value="{{ $chargesForOneStudent }}" min="0" placeholder="0.00" readonly
                           id="receivable_{{ $student['id'] }}"
                    />
                </td>

                <td>
                    <textarea name="remark[{{ $student['id'] }}]" class="mini-editor form-control" cols="" rows="4" placeholder="Remark"></textarea>
                </td>

                <td>
                    <input type="checkbox" class="form-control stdn" style="font-size: 1pt"
                           id="customCheckcolor{{ $student['id'] }}"
                           name="students[{{ $student['id'] }}]"
                    >
                </td>
            </tr>
        @endforeach

        <tr>
            <td colspan="10">
                @foreach($charges as $charge)
                    <input type="hidden" name="original_charges[{{ $charge['class_item_id'] }}]" value="{{ $charge['amount'] }}">
                @endforeach
            </td>
        </tr>


    @endif
    </tbody>
    @if(count($students)>0)
        <tfoot>
        <tr>
            <td colspan="10">
                <button type="submit" class="btn btn-success btn-block btn-sm">
                    <i class="fa fa-paper-plane"></i>
                    Send to Next Class
                </button>
            </td>
        </tr>
        </tfoot>
    @endif
</table>
<script src="{{ asset('assets/js/pages/custom-mini-editor.js') }}"></script>
