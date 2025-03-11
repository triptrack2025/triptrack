<div class="dark-transparent sidebartoggler"></div>
<script src="{{asset('assets/admin/js/vendor.min.js')}}"></script>

  <!-- Import Js Files -->
  <script src="{{asset('assets/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/admin/libs/simplebar/dist/simplebar.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/theme/app.init.js')}}"></script>
  <script src="{{asset('assets/admin/js/theme/theme.js')}}"></script>
  <script src="{{asset('assets/admin/js/theme/app.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/theme/sidebarmenu.js')}}"></script>

  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

  <!-- highlight.js (code view) -->
  <script src="https://bootstrapdemos.adminmart.com/modernize/dist/assets/js/highlights/highlight.min.js"></script>
  <script>
  hljs.initHighlightingOnLoad();


  document.querySelectorAll("pre.code-view > code").forEach((codeBlock) => {
    codeBlock.textContent = codeBlock.innerHTML;
  });
</script>
  <script src="https://bootstrapdemos.adminmart.com/modernize/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="https://bootstrapdemos.adminmart.com/modernize/dist/assets/js/datatable/datatable-basic.init.js"></script>

  <!-- <script src="{{asset('assets/admin/libs/quill/dist/quill.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/forms/dist/quill-init.js')}}"></script> -->

  <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    
  
<script>
    $('#alt_pagination_paginate').hide();
    $('#alt_pagination_length').hide();
    $('.dataTables_info').show();
    $('#alt_pagination_info').hide();
</script>

<style>
    @media (max-width: 575px) {
    .pagination {
        justify-content: center;
        flex-direction: row; 
    }
    .d-none.flex-sm-fill.d-sm-flex.align-items-sm-center.justify-content-sm-between{
        display: block !important;
    }
    .d-flex.justify-content-between.flex-fill.d-sm-none{
        display:none !important;
    }
}
</style>
</body>

</html>