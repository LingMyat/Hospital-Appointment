
@if ($message = Session::get('success'))
   <script>
      toastr.success("{{ $message }}",
        {timeOut: 4000},
        {
            "positionClass": "toast-top-center",
            "closeButton": true
        }
      )
   </script>
@endif

@if ($message = Session::get('error'))
   <script>
      toastr.warning("{{ $message }}",
      {timeOut: 4000},
      {"closeButton": true}
      )
   </script>
@endif
