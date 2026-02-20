<div class="controls">
    <button id="previous" class="previous">Previous</button>
    <p id="pageNumber">Page 1 of 1</p>
    <button id="next" class="next">Next</button>
    <button id="zoomIn" class="zoom"><i class="fa fa-search-plus"></i></button><span id="zoomLevel" class="zoomLevel"></span>
    <button id="zoomOut" class="zoom"><i class="fa fa-search-minus"></i></button>
    <label for="goToPage">Go to page</label>
    <input type="number" id="goToPage" class="goToPage" value="1" min="1"/>
    @if(Session::get('teacherId'))
        <button id="check" class="check" title="Press R"><i class="fa fa-check"></i></button>
        <button id="cross" class="cross" title="Press W"><i class="fa fa-times"></i></button>
        <button id="pencil" class="pencil" title="Press A"><i class="fa fa-pencil-alt"></i></button>
        <button id="eraser" class="eraser" title="Press E"><i class="fa fa-eraser"></i></button>
        <input type="color" id="color" class="color" value="#ff0000"/>
        <button id="finish" class="finish">Save & Close</button>
{{--        <button id="" class="close" onclick="window.close()"><i class="fa fa-times-circle"></i> Close</button>--}}
        <p id="studentMark" style="display: none !important;"></p>
    @endif
</div>
