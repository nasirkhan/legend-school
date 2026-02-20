<style>
    /*Loader Section Start*/
    #overlay{}
    .loader{
        width:100px;
        height:100px;
        background-color:transparent;
        position:fixed;
        left:50%;
        top:50%;
        margin-left:-50px;
        margin-top:-50px;
        z-index: 99999999;
        display: none;
    }
    /*Loader Section End*/
</style>

<div class="loader">
    <img src="{{ asset('assets/images/loader.gif') }}" alt="">
</div>
