<script>
    // const url = 'path/to/your-file.pdf'; // Replace this with your PDF file URL
    const url = {{ asset($hw->attachment_url) }}; // Replace this with your PDF file URL

    let pdfDoc = null,
        pageNum = 1,
        canvas = document.getElementById('pdf-render'),
        ctx = canvas.getContext('2d'),
        isAnnotating = false,
        annotations = [], // Store annotations
        brushColor = '#FF0000',  // Default brush color
        brushSize = 3;   // Default brush size

    // Load PDF.js document
    pdfjsLib.GlobalWorkerOptions.workerSrc = "{{ asset('assets/plugins/pdfjs/build/pdf.worker.js') }}";
    pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
        pdfDoc = pdfDoc_;
        renderPage(pageNum);
    });

    // Render the current page
    function renderPage(num) {
        pdfDoc.getPage(num).then(page => {
            const viewport = page.getViewport({ scale: 1.5 });
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render the page on the canvas
            const renderCtx = {
                canvasContext: ctx,
                viewport: viewport
            };
            page.render(renderCtx);
        });
    }

    // Annotating logic
    canvas.addEventListener('mousedown', (e) => {
        isAnnotating = true;
        annotations.push({
            color: brushColor,
            size: brushSize,
            path: [{ x: e.offsetX, y: e.offsetY }]
        });
    });

    canvas.addEventListener('mousemove', (e) => {
        if (!isAnnotating) return;

        let currentPath = annotations[annotations.length - 1].path;
        currentPath.push({ x: e.offsetX, y: e.offsetY });

        redraw();
    });

    canvas.addEventListener('mouseup', () => {
        isAnnotating = false;
    });

    function redraw() {
        // Clear the canvas and re-render the PDF page
        renderPage(pageNum);

        // Draw existing annotations
        annotations.forEach(annotation => {
            ctx.strokeStyle = annotation.color;
            ctx.lineWidth = annotation.size;
            ctx.beginPath();
            let path = annotation.path;
            ctx.moveTo(path[0].x, path[0].y);
            for (let i = 1; i < path.length; i++) {
                ctx.lineTo(path[i].x, path[i].y);
            }
            ctx.stroke();
        });
    }

    // Clear annotations
    document.getElementById('clear').addEventListener('click', () => {
        annotations = [];
        redraw();
    });

    // Change brush color
    document.getElementById('color').addEventListener('change', (e) => {
        brushColor = e.target.value;
    });

    // Change brush size
    document.getElementById('size').addEventListener('input', (e) => {
        brushSize = e.target.value;
    });
</script>
