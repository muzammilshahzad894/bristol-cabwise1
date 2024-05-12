</div>


{{-- dynamic slots here for scripts --}}
@isset($scripts)
    {{ $scripts }}
@endisset
<script>
    $(document).ready(function() {

        $('#dataTable').DataTable();
    });
</script>
</body>

</html>
