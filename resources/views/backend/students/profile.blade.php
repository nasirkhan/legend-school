@extends('backend.master')
@section('document-title') Student Information @endsection
@section('page-title') Student Information
{{--<button onclick="sendIdPassword('{{ $student->id }}')" class="btn btn-sm btn-primary">Send ID & Password</button> --}}
@endsection
@section('active-breadcrumb-item') <a href="{{ route('student-information',['id'=>$student->id]) }}">Student Profile</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    {{--                <h4 class="card-title text-primary">Batch Table</h4>--}}
                    <div id="table" class="table-responsive p-1">
                        <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th colspan="3">
{{--                                    <a target="_blank" href="{{ route('student-payment-detail',['id'=>$student->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Payments</a>--}}
{{--                                    <a target="_blank" href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Attendances</a>--}}
{{--                                    <a target="_blank" href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Report Card</a>--}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr><td style="width: 80px">Name</td><td style="width: 10px">:</td><td>{{ $student->name }}</td></tr>
                            <tr><td style="width: 80px">Blood Group</td><td style="width: 10px">:</td><td>{{ $student->blood_group }}</td></tr>
                            <tr><td style="width: 80px">Student ID</td><td style="width: 10px">:</td><td>{{ $student->roll }}</td></tr>
                            <tr><td style="width: 80px">Password</td><td style="width: 10px">:</td><td>{{ $student->password }}</td></tr>
{{--                            <tr>--}}
{{--                                <td>Text Recipient</td>--}}
{{--                                <td>:</td>--}}
{{--                                <td class="">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col pr-0 custom-control custom-radio custom-radio-success">--}}
{{--                                            <input type="radio" name="default_sms" id="mother" value="mother" {{ $student->default_sms=='mother' ? 'checked':'' }}--}}
{{--                                            onclick="smsNumberUpdate(this)" class="custom-control-input">--}}
{{--                                            <label class="custom-control-label" for="mother">Mother</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col pr-0 custom-control custom-radio custom-radio-success">--}}
{{--                                            <input type="radio" name="default_sms" id="father" value="father" {{ $student->default_sms=='father' ? 'checked':'' }}--}}
{{--                                            onclick="smsNumberUpdate(this)" class="custom-control-input">--}}
{{--                                            <label class="custom-control-label" for="father">Father</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col pr-0 custom-control custom-radio custom-radio-success">--}}
{{--                                            <input type="radio" name="default_sms" id="self" value="self" {{ $student->default_sms=='self' ? 'checked':'' }}--}}
{{--                                            onclick="smsNumberUpdate(this)" class="custom-control-input">--}}
{{--                                            <label class="custom-control-label" for="self">Self</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}




                            <tr><td style="width: 80px">Year</td><td style="width: 10px">:</td><td>{{ $studentClass->year }}</td></tr>
                            <tr><td style="width: 80px">Class</td><td style="width: 10px">:</td><td>{{ $studentClass->classInfo->name }}</td></tr>
                            <tr>
                                <td style="width: 80px">
                                    Subjects <br/>
                                    @if($studentClass->classInfo->section_id == 3)
                                        <button class="btn btn-sm btn-primary" onclick="studentSubjectAdd('{{ $student->id }}','{{ $studentClass->class_id }}','{{ $studentClass->classInfo->name }}')">Choice Form</button>
                                    @endif
                                </td>

                                <td style="width: 10px">:</td>

                                <td>
                                    @if($studentClass->classInfo->section_id == 1 or $studentClass->classInfo->section_id == 2)
                                        <ul>
                                            @foreach($subjects as $subject)
                                                <li>{{ $subject->sub_code }} - {{ $subject->subject->name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul>
                                            @foreach($selectedSubjects as $key => $value)
                                                <li>{{ $value->code }} - {{ $value->subject->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                            </tr>
{{--                            <tr><td style="width: 80px">Session</td><td style="width: 10px">:</td><td>{{ $student->session->name }}</td></tr>--}}

                            <tr><td style="width: 80px">Tuition Fee</td><td style="width: 10px">:</td><td>Tk. {{ numberFormat($studentMonthlyFee->payable) }}/-</td></tr>
                            @php($labFeeInfo = labFeeInfo($studentMonthlyFee->student_id,$studentMonthlyFee->class_id,$studentMonthlyFee->year))

                            @if($labFeeInfo['lab_fee']>0)
                                <tr><td style="width: 80px">Lab Fee</td><td style="width: 10px">:</td><td>Tk. {{ numberFormat($labFeeInfo['lab_fee']) }}/-</td></tr>
                            @endif


                            <tr><td style="width: 80px">Self Contact</td><td style="width: 10px">:</td><td>{{ $student->mobile }}</td></tr>
                            <tr><td style="width: 80px">Self Email</td><td style="width: 10px">:</td><td>{{ $student->email }}</td></tr>
                            <tr><td style="width: 80px">Father Name</td><td style="width: 10px">:</td><td>{{ $student->father_name }}</td></tr>
                            <tr><td style="width: 80px">Father Mobile</td><td style="width: 10px">:</td><td>{{ $student->father_mobile }}</td></tr>
                            <tr><td style="width: 80px">Mother Name</td><td style="width: 10px">:</td><td>{{ $student->mother_name }}</td></tr>
                            <tr><td style="width: 80px">Mother Mobile</td><td style="width: 10px">:</td><td>{{ $student->mother_mobile }}</td></tr>
                            <tr><td style="width: 80px">Date of Birth</td><td style="width: 10px">:</td><td>{{ dateFormat($student->date_of_birth,'d-M-Y') }}</td></tr>
                            <tr><td style="width: 80px">Joining Date</td><td style="width: 10px">:</td><td>{{ dateFormat($student->join_date,'d-M-Y') }}</td></tr>
                            <tr><td style="width: 80px">Address</td><td style="width: 10px">:</td><td>{{ $student->address }}</td></tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
<div class="col-lg-2 col-md-3">
    <img width="100%" class="img-thumbnail" id="profile_photo" src="{{ isset($student->photo) ? asset($student->photo->url) : asset('assets/images/user-avatar.png') }}" alt="Image Not Found">
</div>
</div>

    @include('backend.students.modal.subject-add-form')
@endsection

@section('script')
<script>
{{--function smsNumberUpdate(e){--}}
{{--    $('.loader').show();--}}
{{--    $.get('{{ route('sms-number-update') }}',{--}}
{{--        default_sms: e.value,--}}
{{--        student_id: {{ $student->id }}--}}
{{--    },(response)=>{--}}
{{--        $('.loader').hide();--}}
{{--        console.log(response);--}}
{{--    });--}}
{{--}--}}

{{--function sendIdPassword(id){--}}
{{--    $('.loader').show();--}}
{{--    $.get('{{ route('send-id-password') }}',{id: id},(response)=>{--}}
{{--        $('.loader').hide();--}}
{{--        console.log(response);--}}
{{--        Swal.fire('Success', 'ID & Password sent successfully', 'success');--}}
{{--    });--}}
{{--}--}}

function studentSubjectAdd(id,classId,name){
    let remDivCss = 'custom-control custom-checkbox  custom-checkbox-danger mb-2'
    let divCss = 'custom-control custom-checkbox  custom-checkbox-success mb-2'
    let inputCss = 'custom-control-input'
    let labelCss = 'custom-control-label'
    let usedSubjects = ''
    let usedSubjectCodes = ''
    let unusedSubjects = ''
    let unusedSubjectCode = ''
    $(".loader").show();
    $.get("{{ route('get-class-subjects-for-student') }}",{student_id:id,class_id:classId}, (response)=>{
        if (response.success){
            $(".loader").hide();
            for (let i in response.unused){
                let item = response.unused[i]
                unusedSubjects += `
<div class="${divCss}">
<input type="checkbox" class="${inputCss}" id="unused-${item.id}" name="selected[${item.id}]">
<label class="${labelCss}" for="unused-${item.id}">${item.code} : ${item.name} </label>
</div>`
            }

            for (let j in response.used){
                let selectedItem = response.used[j]
                usedSubjects += `
<div class="${remDivCss}">
<input type="checkbox" class="${inputCss}" id="used-${selectedItem.student_subject_id}" name="removed[${selectedItem.student_subject_id}]">
<label class="${labelCss}" for="used-${selectedItem.student_subject_id}">${selectedItem.code} : ${selectedItem.name}</label>
</div>`
            }
            $('#subjectAddForm .modal-title').find('span').text(name)
            $('#subjectAddForm .modal-body').find('input[name=student_id]').val(id)
            $('#subjectAddForm .modal-body').find('input[name=class_id]').val(classId)
            $('#subjectAddForm .modal-body').find('#remove').html(usedSubjects)
            $('#subjectAddForm .modal-body').find('#select').html(unusedSubjects)
            $('#subjectAddForm').modal('show')
        }
    }).then((response)=>{
        // Swal.fire('Message', 'Data loaded successfully', 'success');
        // Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
    });
}

function choiceForm(){
    $('#subjectAddForm').modal('show')
}
</script>
@endsection
{{--this script override all--}}
{{--@section('script') @include('backend.students.script') @endsection--}}
{{--this style override all--}}
{{--@section('style') @include('backend.students.style') @endsection--}}


