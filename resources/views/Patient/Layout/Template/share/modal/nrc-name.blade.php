<select name="nrc_name" class="w-100 niceSelect" id="nrc_name_select">
    <option value="">nrc-name</option>
    @foreach ($nrc_names as $nrc_name)
        <option value="{{ $nrc_name }}">{{ $nrc_name }}</option>
    @endforeach
</select>
<script>
    $('#nrc_name_select').niceSelect();
</script>
