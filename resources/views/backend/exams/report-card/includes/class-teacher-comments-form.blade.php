<form action="{{ route('class-teacher-comment-save') }}" method="POST">
    @csrf
    <tr><td class="b-w"></td></tr>
    <tr><th class="b-w" style="margin: 10px 0; font-size: 13px">Teacher's Evaluation</th></tr>
    <tr><td class="b-w"></td></tr>

    <tr>
        <td class="p-0 b-w">
            <table>
                <tr>
                    <th class="bg-white" colspan="2" style="font-size: 13px">Extracurricular Activities/ Skill development</th>
                </tr>
                <tr>
                    <td class="p-0" style="width: 55%">
                        <table class="clubs">
                            <tr>
                                <td class="txt-l bl-n" rowspan="{{ count($sc->items)+1 }}" style="width: 28%">{{ $sc->name }}</td>
                            </tr>
                            @php($loopCount = 1)
                            @foreach($sc->items as $item)
                                @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                <tr>
                                    <td class="txt-l" style="width: 62%">{{ $item->name }}</td>
                                    <td class="" style="width: 10%">
                                        <input type="text" value="{{ isset($activity)? $activity->grade : '' }}" class="txt-c b-n" style="height: 15px; width: 100%" name="eca_grade[{{ $item->id }}]">
                                    </td>
                                </tr>
                                @php($loopCount++)
                            @endforeach
                        </table>

                        <table class="clubs">
                            <tr>
                                <td class="txt-l bl-n" rowspan="{{ count($lc->items)+1 }}" style="width: 28%">{{ $lc->name }}</td>
                            </tr>
                            @php($loopCount = 1)
                            @foreach($lc->items as $item)
                                @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                <tr>
                                    <td class="txt-l" style="width: 62%">{{ $item->name }}</td>
                                    <td class="" style="width: 10%">
                                        <input type="text" value="{{ isset($activity)? $activity->grade : '' }}" class="txt-c b-n" style="height: 15px; width: 100%" name="eca_grade[{{ $item->id }}]">
                                    </td>
                                </tr>
                                @php($loopCount++)
                            @endforeach
                        </table>

                        <table class="clubs">
                            <tr>
                                <td class="txt-l bl-n" rowspan="{{ count($tic->items)+1 }}" style="width: 28%">{{ $tic->name }}</td>
                            </tr>
                            @php($loopCount = 1)
                            @foreach($tic->items as $item)
                                @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                <tr>
                                    <td class="txt-l" style="width: 62%">{{ $item->name }}</td>
                                    <td class="" style="width: 10%">
                                        <input type="text" value="{{ isset($activity)? $activity->grade : '' }}" class="txt-c b-n" style="height: 15px; width: 100%" name="eca_grade[{{ $item->id }}]">
                                    </td>
                                </tr>
                                @php($loopCount++)
                            @endforeach
                        </table>

                        <table class="clubs">
                            <tr>
                                <td class="txt-l bl-n bb-n" rowspan="{{ count($sic->items)+1 }}" style="width: 28%">{{ $sic->name }}</td>
                            </tr>
                            @php($loopCount = 1)
                            @foreach($sic->items as $item)
                                @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                <tr>
                                    <td class="txt-l {{ $loopCount==count($sic->items)?'bb-n':'' }}" style="width: 62%">{{ $item->name }}</td>
                                    <td class="{{ $loopCount==count($sic->items)?'bb-n':'' }}" style="width: 10%">
                                        <input type="text" value="{{ isset($activity)? $activity->grade : '' }}" class="txt-c b-n" style="height: 15px; width: 100%" name="eca_grade[{{ $item->id }}]">
                                    </td>
                                </tr>
                                @php($loopCount++)
                            @endforeach
                        </table>
                    </td>

                    <td class="p-0" style="width: 45%">
                        <table class="clubs">
                            <tr>
                                <td class="txt-l bl-n" rowspan="{{ count($cpac->items)+2 }}" style="width: 30%">{{ $cpac->name }}</td>
                            </tr>
                            @php($loopCount = 1)
                            @foreach($cpac->items as $item)
                                @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                <tr>
                                    <td class="txt-l " style="width: 58%">{{ $item->name }}</td>
                                    <td class="" style="width: 12%">
                                        <input type="text" value="{{ isset($activity)? $activity->grade : '' }}" class="txt-c b-n" style="height: 15px; width: 100%" name="eca_grade[{{ $item->id }}]">
                                    </td>
                                </tr>
                                @php($loopCount++)
                            @endforeach
                        </table>

                        <table class="clubs">
                            <tr>
                                <td class="txt-l bl-n" rowspan="{{ count($csc->items)+1 }}" style="width: 30%">{{ $csc->name }}</td>
                            </tr>
                            @php($loopCount = 1)
                            @foreach($csc->items as $item)
                                @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                <tr>
                                    <td class="txt-l" style="width: 58%">{{ $item->name }}</td>
                                    <td class="" style="width: 12%">
                                        <input type="text" value="{{ isset($activity)? $activity->grade : '' }}" class="txt-c b-n" style="height: 15px; width: 100%" name="eca_grade[{{ $item->id }}]">
                                    </td>
                                </tr>
                                @php($loopCount++)
                            @endforeach
                        </table>

                        <table class="clubs">
                            <tr>
                                <td class="txt-l bl-n" rowspan="{{ count($ac->items)+1 }}" style="width: 30%">{{ $ac->name }}</td>
                            </tr>
                            @php($loopCount = 1)
                            @foreach($ac->items as $item)
                                @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                <tr>
                                    <td class="txt-l" style="width: 58%">{{ $item->name }}</td>
                                    <td class="" style="width: 12%">
                                        <input type="text" value="{{ isset($activity)? $activity->grade : '' }}" class="txt-c b-n" style="height: 15px; width: 100%" name="eca_grade[{{ $item->id }}]">
                                    </td>
                                </tr>
                                @php($loopCount++)
                            @endforeach
                        </table>

                        <table class="clubs">
                            <tr>
                                <td class="txt-l bl-n bb-n" rowspan="{{ count($olmp->items)+1 }}" style="width: 30%">{{ $olmp->name }}</td>
                            </tr>
                            @php($loopCount = 1)
                            @foreach($olmp->items as $item)
                                @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                <tr>
                                    <td class="txt-l {{ $loopCount==count($olmp->items)?'bb-n':'' }}" style="width: 58%">{{ $item->name }}</td>
                                    <td class="{{ $loopCount==count($olmp->items)?'bb-n':'' }} pt-0 pb-0" style="width: 12%;">
                                        <input type="text" value="{{ isset($activity)? $activity->grade : '' }}" class="txt-c b-n" style="height: 15px; width: 100%" name="eca_grade[{{ $item->id }}]">
                                    </td>
                                </tr>
                                @php($loopCount++)
                            @endforeach
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td class="p-0 b-w">
            <table  style="margin-top: 2px">
                <tr>
                    @if($exam->comment=='y')
                        <th class="b-w txt-l" style="font-size: 13px">Class Teacher's Comment: </th>
                        <th class="b-w txt-l p-0" style="width: 67.5%;">
                            <input type="text" name="comment" value="{{ isset($comment) ? $comment->comment : '' }}" style="width: 100%; height: 30px">
                        </th>
                    @endif
                    <th class="b-w txt-l p-0">
                        <button  style="background-color: navy; color: white; width: 100%; height: 29.5px; border: none">Save</button>
                    </th>
                </tr>
                <input type="hidden" name="student_id" value="{{ $student->id }}">
                <input type="hidden" name="exam_id" value="{{ $exam->id }}">

            </table>
        </td>
    </tr>
</form>
