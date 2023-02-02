<select name="nrc_name" class="w-100 niceSelect" id="">
    <option value="">nrc-name</option>
    @foreach ($nrc_names as $nrc_name)
        <option value="{{ $nrc_name }}">{{ $nrc_name }}</option>
    @endforeach
</select>
