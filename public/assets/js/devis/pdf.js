document.getElementById('btnPdf').addEventListener('click',function(){
    var opt = {
        margin:       1,
        filename:     'devis.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' },
        pagebreak: { before: '.beforeClass', after: ['#pdf', '#pdfFin'], avoid: 'img' }
      };
      html2pdf().set(opt).from(document.getElementById('pdf')).save();

})