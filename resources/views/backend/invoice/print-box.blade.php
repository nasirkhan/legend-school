<style>
    #printBox{
        width: 90px;
        position: fixed;
        right: -130px;
        top: 5px;
        z-index: 9999;
    }

    body:hover #printBox{
        right: 5px;
        transition: all 0.2s;
    }
</style>

<div id="printBox" class="bg-primary-soft p-2 rounded">
    <button class="btn btn-sm btn-block btn-indigo mb-2 text-start" onclick="window.print()"><i class="mr-2 bx bx-printer"></i> Print</button>
    <br>
    <button class="btn btn-sm btn-block btn-danger mb-2 text-start" onclick="window.close()"><i class="mr-2 bx bx-x-circle"></i> Close</button>
    <br>
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-block btn-info text-start"><i class="mr-2 bx bx-left-arrow-circle"></i> Back</a>
</div>
