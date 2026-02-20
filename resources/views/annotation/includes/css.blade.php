<style>
    .canvasWrapper{
        position: relative;
        width: 90%;
        margin: 0 auto;
        margin-top: 50px;
    }
    .controls{
        position: fixed;
        /*position: sticky;*/
        top: 10px;
        margin-bottom: 10px;
        z-index: 100;
    }
    #canvas{
        display: block;
        margin: 0 auto;
        border: 1px solid #444444;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        z-index: 5;
    }
    #annotation{
        display: block;
        margin: 0 auto;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        z-index: 15;
        background-color: transparent;
    }
    #pageNumber{
        display: inline;
    }
    .previous{
        display: inline;
        background-color: #ffffff;
        color: #000000;
        margin-left: 5px;
        padding: 0px 5px;
        border-radius: 4px;
        font-size: 14px;
    }

    .next{
        display: inline;
        background-color: #42A047;
        color: white;
        padding: 0px 5px;
        border-radius: 4px;
        font-size: 14px;
    }

    #pageNumber{
        border-radius: 5px;
    }

    .goToPage{
        width: 50px;
        text-align: center;
        padding: 0;
        font-size: 14px;
    }

    .zoom{
        border-radius: 5px;
        /*border: 1px solid #444444;*/
    }

    .zoomLevel{
        margin: 0px 0px;
        margin-left: 4px;
        display: inline-block;
        padding: 0px 3px;
        border: 1px solid #444444;
        border-radius: 3px;
        font-size: 15px;
        /*height: 20px;*/
    }

    .check,.cross,.pencil,.eraser,.finish,.close,.question,.mark-scheme,.refresh,.zoom{
        border-radius: 5px;
        width: 30px;
        /*height: 22px;*/
        font-size: 13px;
        display: inline-block;
        padding: 1px 0px 1px 0px !important;
    }
    .finish{
        width: auto;
        background-color: red;
        color: white;
        /*border: none;*/
        padding: 1px 3px !important;
        font-weight: bold;
        font-size: 13px;
        border-radius: 3px;
        cursor: pointer;
    }
    .close{
        width: auto;
        border-radius: 3px;
        padding: 1px 3px !important;
    }
    #studentName, #studentMark{
        display: inline;
        border: 1px solid #444444;
        margin-bottom: 0px;
        padding: 0px 5px 1px 5px;
        border-radius: 3px;
        background-color: #444444;
        color: #ffffff;
        font-weight: bold;
        font-family: Rockwell;
        font-size: 15px;
    }
    #studentMark{
        background-color: darkgreen;
    }
    .color {
        width: 30px;
        border-radius: 3px;
        padding: 0px;
        height: 20px;
        vertical-align: baseline;
        border: 2px solid;
    }

    .btn-success{
        background-color: #42A047;
        color: #ffffff;
    }

    .position-fixed{
        position: fixed;
    }
    .question,.mark-scheme{
        width: 40px;
        border: 1px solid #444444;
        margin-bottom: 0px;
        padding: 0px 5px 1px 5px;
        border-radius: 3px;
        background-color: #444444;
        color: #ffffff;
        font-weight: bold;
        font-family: Rockwell;
        font-size: 13px;
    }
</style>
