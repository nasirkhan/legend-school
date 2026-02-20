<script>
    $(".loader").show();
    const url = "{{ $pdf }}";
    let aCanvas,aContext,aRect,xPos,yPos, width, height;
    let painting = false;
    let coordinates = [];
    let allPointsAn = [];
    let allAnnotation = [];
    let allPageAnnotations = [];
    let annotationType = null;
    let currentPage, scale;
    let zoomLevel = 125;
    let detected = false;
    let annotationObjects = [];
    let toBeDelete = false;
    let totalMarkOfExam = Number({{ "50000" }});
    let hasPermission = false;
    (async function () {
        //Specified the workerSrc property
        pdfjsLib.GlobalWorkerOptions.workerSrc = "{{ asset('assets/plugins/pdfjs/build/pdf.worker.js') }}";
        //Create the PDF document
        const doc = await pdfjsLib.getDocument(url).promise;
        const minPage = 1;
        const maxPage = await doc._pdfInfo.numPages;
        currentPage = 1;
        scale = 1.25;
        await annotationInit(maxPage);
//========================Start Display First Page=================================================
        //Get page 1
        await getPage(doc, scale, currentPage);
        //Display the page number
        document.getElementById("pageNumber").innerHTML = `Page ${currentPage} of ${maxPage}`;
        //Display the zoom level
        document.getElementById("zoomLevel").innerText = `${zoomLevel} %`;
        //Goto Page Number
        document.getElementById("goToPage").value = currentPage;
        //Show Annotations From DB
        await annObjectUpdate();
        await dbAnnotation();
        await getMark();
        await checkTotalTickAndCross();
//========================End Display First Page=================================================
        //The previous button click event
        document.getElementById("previous").addEventListener('click', async () => {
            if (currentPage > minPage){
                //Get the previous page
                await clearAll();
                await getPage(doc, scale, --currentPage);
                //Display the page number
                document.getElementById("pageNumber").innerHTML = `Page ${currentPage} of ${maxPage}`;
                //Display the zoom level
                document.getElementById("zoomLevel").innerText = `${zoomLevel} %`;
                //Goto Page Number
                document.getElementById("goToPage").value = currentPage;
                //Show Annotations From DB
                await annObjectUpdate();
                await dbAnnotation();
            }
        });

        //The next button click event
        document.getElementById("next").addEventListener('click', async () => {
            if (currentPage < maxPage){
                //Get the previous page
                await clearAll();
                await getPage(doc, scale, ++currentPage);
                //Display the page number
                document.getElementById("pageNumber").innerHTML = `Page ${currentPage} of ${maxPage}`;
                //Display the zoom level
                document.getElementById("zoomLevel").innerText = `${zoomLevel} %`;
                //Goto Page Number
                document.getElementById("goToPage").value = currentPage;
                //Show Annotations From DB
                await annObjectUpdate();
                await dbAnnotation();
            }
        });

        //ZoomIn button click event
        document.getElementById("zoomIn").addEventListener('click', async () => {
            //Set new scale
            if (scale<2){
                scale += 0.25;
                zoomLevel = scale*100;
            }
            await clearAll();
            await getPage(doc, scale, currentPage);
            //Display the zoom level
            document.getElementById("zoomLevel").innerText = `${zoomLevel} %`;
            //Show Annotations From DB
            await annObjectUpdate();
            await dbAnnotation();
        });

        //ZoomOut button click event
        document.getElementById("zoomOut").addEventListener('click', async () => {
            //Set new scale
            if (scale>0.25){
                scale -= 0.25;
                zoomLevel = scale*100;
            }
            await clearAll();
            await getPage(doc, scale, currentPage);
            //Display the zoom level
            document.getElementById("zoomLevel").innerText = `${zoomLevel} %`;
            //Show Annotations From DB
            await annObjectUpdate();
            await dbAnnotation();
        });

        //GoToPage keyup event
        document.getElementById("goToPage").addEventListener('keyup', async () => {
            var goToPage = Number(document.getElementById("goToPage").value);
            if (goToPage<minPage || goToPage>maxPage){
                document.getElementById("goToPage").value = minPage;
                goToPage = minPage;
            }
            if (goToPage>=minPage && goToPage<=maxPage){
                currentPage = goToPage;
            }
            await clearAll();
            await getPage(doc, scale, currentPage);
            //Display the page number
            document.getElementById("pageNumber").innerHTML = `Page ${currentPage} of ${maxPage}`;
            //Show Annotations From DB
            await annObjectUpdate();
            await dbAnnotation();
        });

        //GoToPage click event
        document.getElementById("goToPage").addEventListener('click', async () => {
            var goToPage = Number(document.getElementById("goToPage").value);
            if (goToPage>=minPage && goToPage<=maxPage){
                currentPage = goToPage;
            }
            await clearAll();
            await getPage(doc, scale, currentPage);
            //Display the page number
            document.getElementById("pageNumber").innerHTML = `Page ${currentPage} of ${maxPage}`;
            //Show Annotations From DB
            await annObjectUpdate();
            await dbAnnotation();
        });

        //Finish Checking
        document.getElementById("finish").addEventListener('click', async () => {
            let message = 'If you want to finish checking and return this copy press OK'
            if(confirm(message)){
                $('.loader').show();
                let obj = {
                    doc_type:'hw',
                    doc_id:'{{ $hw->id }}',
                    all_page_annotations:allPageAnnotations,
                    _token:'{{ csrf_token() }}'
                };
                $.ajax({
                    type : 'POST',
                    url  : '{{ route('save-annotation-together') }}',
                    data : obj,
                    success: function (response) {
                        console.log(response)
                        if (response=='Success'){
                            window.close();
                            console.log(response);
                        }
                    }
                }).then(function () {
                    $('.loader').hide();
                });
            }
        });

        //MouseDown event on the canvas
        document.getElementById("annotation").addEventListener('mousedown', async (e) => {
            aCanvas = document.getElementById("annotation");
            aContext = aCanvas.getContext("2d");
            aRect = aCanvas.getBoundingClientRect();
            xPos = Math.round(e.clientX - aRect.left);
            yPos = Math.round(e.clientY - aRect.top);
            aContext.strokeStyle = $("#color").val();
            aContext.lineWidth = 3;
            aContext.lineCap = 'round';

            if (annotationType==null){
                @if(Session::get('teacherId'))
                alert('Select some option');
                @endif
            }else if(annotationType=='check') {
                await checkTotalTickAndCross();
                if (hasPermission){
                    await checkMark(aContext,xPos,yPos);
                    coordinates[0] = (xPos+','+yPos);
                }else{
                    return alert('You have reached the maximum limit');
                }
            }else if(annotationType=='cross') {
                await checkTotalTickAndCross();
                if (hasPermission){
                    await crossMark(aContext,xPos,yPos);
                    coordinates[0] = (xPos+','+yPos);
                }else{
                    return alert('You have reached the maximum limit');
                }
            }else if(annotationType=='pencil') {
                painting = true;
                startPosition(aContext,xPos,yPos);
            }else if(annotationType=='eraser') {
                toBeDelete = true;
            }
        });

        //Touch start event on the canvas
        document.getElementById("annotation").addEventListener('touchstart', async (e) => {
            aCanvas = document.getElementById("annotation");
            aContext = aCanvas.getContext("2d");
            aRect = aCanvas.getBoundingClientRect();
            xPos = Math.round(Number(e.touches[0].clientX-aRect.left));
            yPos = Math.round(Number(e.touches[0].clientY-aRect.top));
            aContext.strokeStyle = 'red';
            aContext.lineWidth = 3;
            aContext.lineCap = 'round';
            if (annotationType==null){
                @if(Session::get('teacherId'))
                alert('Select some option');
                @endif
            }else if(annotationType=='check') {
                await checkTotalTickAndCross();
                if (hasPermission){
                    await checkMark(aContext,xPos,yPos);
                    coordinates[0] = (xPos+','+yPos);
                }else{
                    return alert('You have reached the maximum limit');
                }
            }else if(annotationType=='cross') {
                await checkTotalTickAndCross();
                if (hasPermission){
                    await crossMark(aContext,xPos,yPos);
                    coordinates[0] = (xPos+','+yPos);
                }else{
                    return alert('You have reached the maximum limit');
                }
            }else if(annotationType=='pencil') {
                if (e.touches[0].touchType==='stylus'){
                    e.preventDefault();
                    painting = true;
                    startPosition(aContext,xPos,yPos);
                }
                // if (e.touches.length==2){
                //   $(".canvasWrapper").removeClass('position-fixed');
                // }else {
                //   $(".canvasWrapper").addClass('position-fixed');
                // }
            }else if(annotationType=='eraser') {
                toBeDelete = true;
            }
        });

        //MouseMove event on the canvas
        document.getElementById("annotation").addEventListener('mousemove', async (e) => {
            aCanvas = document.getElementById("annotation");
            aContext = aCanvas.getContext("2d");
            aRect = aCanvas.getBoundingClientRect();
            xPos = Math.round(e.clientX - aRect.left);
            yPos = Math.round(e.clientY - aRect.top);

            if (annotationType=='pencil'){
                draw(aContext,xPos,yPos);
            }else if(annotationType=='eraser') {
                if (toBeDelete){
                    let index = allPageAnnotations.findIndex(obj => {return obj.pageNumber == currentPage });
                    let currentPageAnnotations = allPageAnnotations[index].annotations;
                    for (let key in currentPageAnnotations){
                        if (currentPageAnnotations[key].ann_type != 'pencil'){
                            let SOP = currentPageAnnotations[key].annotation.split(','); //SOP = Single Order Pair
                            if (xPos >= (Number(SOP[0]) - 3) && xPos < (Number(SOP[0]) + 3) && yPos >= (Number(SOP[1]) - 3) && yPos < (Number(SOP[1]) + 3)){
                                detected = true;
                                await allPageAnnotations[index].annotations.splice(key,1);
                                await annObjectUpdate();
                                await dbAnnotation();
                                await getMark();
                                await checkTotalTickAndCross();
                            }
                        }else {
                            let AOP = currentPageAnnotations[key].annotation.split(' ');  //Array Of Points
                            for (let j=0; j<AOP.length; j++){
                                let SOP = AOP[j].split(','); //SOP = Single Order Pair
                                if (xPos >= (Number(SOP[0]) - 3) && xPos < (Number(SOP[0]) + 3) && yPos >= (Number(SOP[1]) - 3) && yPos < (Number(SOP[1]) + 3)){
                                    detected = true;
                                    await allPageAnnotations[index].annotations.splice(key,1);
                                    await annObjectUpdate();
                                    await dbAnnotation();
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        });

        document.getElementById("annotation").addEventListener('touchmove', async (e) => {
            aCanvas = document.getElementById("annotation");
            aContext = aCanvas.getContext("2d");
            aRect = aCanvas.getBoundingClientRect();
            xPos = Math.round(Number(e.touches[0].clientX-aRect.left));
            yPos = Math.round(Number(e.touches[0].clientY-aRect.top));
            if (annotationType=='pencil'){
                if (e.touches[0].touchType==='stylus'){
                    e.preventDefault();
                    draw(aContext,xPos,yPos);
                }
            }else if (annotationType=='eraser'){
                if (toBeDelete){
                    let index = allPageAnnotations.findIndex(obj => {return obj.pageNumber == currentPage });
                    let currentPageAnnotations = allPageAnnotations[index].annotations;
                    for (let key in currentPageAnnotations){
                        if (currentPageAnnotations[key].ann_type != 'pencil'){
                            let SOP = currentPageAnnotations[key].annotation.split(','); //SOP = Single Order Pair
                            if (xPos >= (Number(SOP[0]) - 3) && xPos < (Number(SOP[0]) + 3) && yPos >= (Number(SOP[1]) - 3) && yPos < (Number(SOP[1]) + 3)){
                                detected = true;
                                await allPageAnnotations[index].annotations.splice(key,1);
                                await annObjectUpdate();
                                await dbAnnotation();
                                await getMark();
                                await checkTotalTickAndCross();
                            }
                        }else {
                            let AOP = currentPageAnnotations[key].annotation.split(' ');  //Array Of Points
                            for (let j=0; j<AOP.length; j++){
                                let SOP = AOP[j].split(','); //SOP = Single Order Pair
                                if (xPos >= (Number(SOP[0]) - 3) && xPos < (Number(SOP[0]) + 3) && yPos >= (Number(SOP[1]) - 3) && yPos < (Number(SOP[1]) + 3)){
                                    detected = true;
                                    await allPageAnnotations[index].annotations.splice(key,1);
                                    await annObjectUpdate();
                                    await dbAnnotation();
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        });

        //MouseUp event on the canvas
        document.getElementById("annotation").addEventListener('mouseup', async (e) => {
            if (annotationType=='pencil'){
                aCanvas = document.getElementById("annotation");
                aContext = aCanvas.getContext("2d");
                painting = false;
                finishedPosition(aContext);
                await pushAnnotation();
                coordinates = [];
            }else if(annotationType=='check' || annotationType=='cross' ){
                if (hasPermission){
                    await pushAnnotation();
                    coordinates = [];
                    await getMark();
                    await checkTotalTickAndCross();
                }
            }else if(annotationType=='eraser'){
                toBeDelete = false;
            }else if(annotationType==null){
                @if(Session::get('teacherId'))
                alert('Select a tool !!!!!');
                @endif
            }
        });

        document.getElementById("annotation").addEventListener('touchend', async (e) => {
            if (annotationType=='pencil'){
                aCanvas = document.getElementById("annotation");
                aContext = aCanvas.getContext("2d");
                painting = false;
                finishedPosition(aContext);
                await pushAnnotation();
                coordinates = [];
                e.cancelBubble = true;
            }else if(annotationType=='check' || annotationType=='cross' ){
                if (hasPermission){
                    await pushAnnotation();
                    coordinates = [];
                    await getMark();
                    await checkTotalTickAndCross();
                }
            }else if(annotationType=='eraser'){
                toBeDelete = false;
            }else if(annotationType==null){
                @if(Session::get('teacherId'))
                alert('Select a tool !!!!!');
                @endif
            }
        });

        // document.getElementById('check').addEventListener('click', async (e) => {
        $("#check").click(async function (e) {
            annotationType = 'check';
            $('.controls button').removeClass('btn-success');
            $('#check').addClass('btn-success');
        });

        $("#cross").click(async function (e) {
            annotationType = 'cross';
            $('.controls button').removeClass('btn-success');
            $('#cross').addClass('btn-success');
        });

        $("#pencil").click(async function (e) {
            annotationType = 'pencil';
            $('.controls button').removeClass('btn-success');
            $('#pencil').addClass('btn-success');
        });

        $("#eraser").click(async function (e) {
            annotationType = 'eraser';
            $('.controls button').removeClass('btn-success');
            $('#eraser').addClass('btn-success');
        });
    })();

    async function getPage(doc, scale, pageNumber) {
        if (pageNumber >= 1 && pageNumber <= doc._pdfInfo.numPages){
            //Fetch the page
            const page = await doc.getPage(pageNumber);
            //Set the viewport
            const viewport = page.getViewport({scale: scale});

            //Set the canvas dimensions to the PDF page dimensions
            const canvas = document.getElementById("canvas");
            const context = canvas.getContext("2d");

            //This width and height will be used for annotation layer
            width = viewport.width;
            height = viewport.height;

            canvas.width = viewport.width;
            canvas.height = viewport.height;

            //Render the PDF page into the canvas context
            return await page.render({
                canvasContext: context,
                viewport: viewport
            }).promise;
        }else {
            console.log("Please specify a valid page number");
        }
    }

    async function getMark(){
        let obtainedMark = 0;
        let singlePageAnnotations;
        for (let i=0; i<allPageAnnotations.length; i++){
            singlePageAnnotations = [];
            singlePageAnnotations = allPageAnnotations[i].annotations;
            for (let x of singlePageAnnotations){
                if (x.ann_type == 'check'){
                    obtainedMark += 1;
                }
            }
        }
        let response = obtainedMark +' Out of '+totalMarkOfExam;
        $("#studentMark").html(response);
        console.log(obtainedMark);
    };

    async function checkTotalTickAndCross(){
        let tickCross = 0;
        let singlePageAnnotations;
        for (let i=0; i<allPageAnnotations.length; i++){
            singlePageAnnotations = [];
            singlePageAnnotations = allPageAnnotations[i].annotations;
            for (let x of singlePageAnnotations){
                if (x.ann_type == 'check' || x.ann_type == 'cross'){
                    tickCross += 1;
                }
            }
        }

        if (tickCross < totalMarkOfExam){
            hasPermission = true;
        }else {
            hasPermission = false;
        }
        console.log(hasPermission);
    }

    async function dbAnnotation() {
        // console.log(annotationObjects);
        aCanvas = document.getElementById("annotation");
        aCanvas.width = width;
        aCanvas.height = height;
        aContext = aCanvas.getContext("2d");
        aContext.lineWidth = 3;
        aContext.lineCap = 'round';
        aRect = aCanvas.getBoundingClientRect();
        allAnnotation = annotationObjects;
        await drawAllAnnotation(aContext);
        $(".loader").hide();
    }

    async function clearAll() {
        aCanvas = document.getElementById("annotation");
        aContext = aCanvas.getContext("2d");
        aContext.clearRect(0, 0, width, height);
    }

    //==========================================================
    //Draw a check mark
    function checkMark(ctx,x,y) {
        ctx.beginPath();
        ctx.moveTo(x-10,y-15);
        ctx.lineTo(x,y);
        ctx.lineTo(x+25,y-25);
        ctx.stroke();
    }
    //Draw a cross mark
    function crossMark(ctx,x,y) {
        ctx.beginPath();
        ctx.moveTo(x-15+2.5,y-15);
        ctx.lineTo(x+15,y+15);
        ctx.lineTo(x,y);
        ctx.lineTo(x-15,y+15);
        ctx.lineTo(x+15,y-15);
        ctx.stroke();
    }

    //Start drawing with pencil
    function startPosition(ctx,x,y) {
        ctx.beginPath();
        draw(ctx,x,y);
    }

    function draw(ctx,x,y) {
        if (!painting){ return; }
        let color = $('#color').val();
        ctx.lineWidth = 2;
        ctx.lineCap = "round";
        ctx.strokeStyle = color;
        ctx.lineTo(x,y);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(x,y);
        storeCoordinates(x,y);
        ctx.lineWidth = 3;
    }

    function drawDB(ctx,x,y,color) {
        if (!painting){ return; }
        //let color = $('#color').val();
        ctx.lineWidth = 2;
        ctx.lineCap = "round";
        ctx.strokeStyle = color;
        ctx.lineTo(x,y);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(x,y);
        ctx.lineWidth = 3;
    }

    function finishedPosition(ctx) {
        ctx.beginPath();
        allPointsAn[allPointsAn.length] = coordinates;
        // coordinates = [];
    }

    function storeCoordinates(x,y){
        if (!painting){ return; }
        let orderPair = x+','+y;
        coordinates[coordinates.length] = orderPair;
    }

    async function drawAllAnnotation(ctx) {
        for(let x of annotationObjects){
            if (x.ann_type=='pencil'){
                let annotations = x.annotation;
                let points = annotations.split(' ');
                ctx.beginPath();
                painting = true;
                for (let j=0; j<points.length; j++){
                    let point = points[j].split(',');
                    drawDB(ctx,Number(point[0]),Number(point[1]),x.ann_color);
                }
                ctx.beginPath();
                painting = false;
            }else {
                let point = x.annotation.split(',');
                if(x.ann_type=='check'){
                    ctx.strokeStyle = x.ann_color;
                    checkMark(ctx,Number(point[0]),Number(point[1]))
                }else {
                    ctx.strokeStyle = x.ann_color;
                    crossMark(ctx,Number(point[0]),Number(point[1]));
                }
            }
        }
    }

    async function pushAnnotation(){
        let index = await allPageAnnotations.findIndex(obj => obj.pageNumber == currentPage);
        let pageAnnotations = await allPageAnnotations[index].annotations;
        let annColor = $("#color").val();
        pageAnnotations[pageAnnotations.length] = {
            ann_type:annotationType,
            ann_color:annColor,
            annotation:coordinates.join(' ')
        };
    }

    async function annotationInit(totalPage) {
        await $.get("{{ route('all-page-annotations') }}",{
            doc_type:'hw',
            doc_id:'{{ $hw->id }}',
            pages:totalPage
        },function (response) {
            for (let i=0; i<response.length; i++){
                allPageAnnotations[i] = response[i];
            }
        });
    }

    async function annObjectUpdate() {
        let index = await allPageAnnotations.findIndex(obj => obj.pageNumber == currentPage);
        let pageAnnotations = await allPageAnnotations[index].annotations;
        annotationObjects = pageAnnotations;
    }

    document.addEventListener('keydown', function (e) {
        let key_press = String.fromCharCode(e.keyCode || e.which);
        if (key_press=="R"){
            annotationType = 'check';
            $('.controls button').removeClass('btn-success');
            $('#check').addClass('btn-success');
        }else if (key_press=="W"){
            annotationType = 'cross';
            $('.controls button').removeClass('btn-success');
            $('#cross').addClass('btn-success');
        }else if (key_press=="A"){
            annotationType = 'pencil';
            $('.controls button').removeClass('btn-success');
            $('#pencil').addClass('btn-success');
        }else if (key_press=="D"){
            annotationType = 'eraser';
            $('.controls button').removeClass('btn-success');
            $('#eraser').addClass('btn-success');
        }else if(key_press=="'"){
            $("#next").click();
        }else if(key_press=="%"){
            $("#previous").click();
        }
    });
</script>
