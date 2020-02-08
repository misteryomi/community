<script src="{{ asset('assets/js/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>tinymce.init({
  selector:'#textarea',
  plugins: 'autoresize bbcode autolink code image anchor emoticons code media',
  toolbar: 'formatselect | bold italic underline strikethrough  | media alignleft aligncenter alignright alignjustify |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | emoticons | code',
  menubar: false,
  branding: false,
  height: 500
  });
</script>
