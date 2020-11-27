<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        ajax: {
          url: "{{ route('community.api.search') }}",
          // processResults: function (data) {
          //   // Transforms the top-level key of the response object from 'items' to 'results'
          //   return {
          //     results: data.items
          //   };
          // }
        }
    });
});
</script>
