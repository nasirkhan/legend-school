<table class="signature">
    <tr>
        <td class="b-n p-0"></td>
        <td class="b-n p-0">
            @php($vpSign = siteInfo('vp_signature'))
            @if(isset($vpSign) and $vpSign != '')
                <img src="{{ asset($vpSign) }}" alt="">
            @endif

        </td>
        <td class="b-n p-0">
            @php($principalSign = siteInfo('principal_signature'))
            @if(isset($principalSign) and $principalSign != '')
                <img style="max-height: 70px" src="{{ asset($principalSign) }}" alt="">
            @endif
        </td>
    </tr>
    <tr>
        <th style="font-size: 13px">&nbsp;&nbsp;&nbsp;Class Teacher&nbsp;&nbsp;&nbsp;</th>
        <th style="font-size: 13px">&nbsp;&nbsp;&nbsp;Vice Principal&nbsp;&nbsp;&nbsp;</th>
        <th style="font-size: 13px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Principal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    </tr>
</table>
