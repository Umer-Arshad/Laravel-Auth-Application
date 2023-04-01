<script>
    $(function() {
        @if (Session::has('info-toast'))
        Toastify({

            text: "{{ Session::get('info-toast') }}",
            className: "custom-toast info-toast",
            duration: 2000,
            close: true,
            gravity: "bottom",
            position: "center",
            stopOnFocus: true
        }).showToast();
        @endif
        @if (Session::has('success-toast'))
        Toastify({

            text: "{{ Session::get('success-toast') }}",
            className: "custom-toast success-toast",
            duration: 2000,
            close: true,
            gravity: "bottom",
            backgroundColor:'#379e40',
            position: "center",
            stopOnFocus: true
        }).showToast();
        @endif
        @if (Session::has('error-toast'))
        Toastify({

            text: "{{ Session::get('error-toast') }}",
            className: "custom-toast error-toast",
            duration: 2000,
            close: true,
            gravity: "bottom",
            backgroundColor: '#b32929',
            position: "center",
            stopOnFocus: true
        }).showToast();
        @endif
        @if (Session::has('warning-toast'))
        Toastify({

            text: "{{ Session::get('warning-toast') }}",
            className: "custom-toast warning-toast",
            duration: 2000,
            close: true,
            gravity: "bottom",
            backgroundColor:'#aba115',
            position: "center",
            stopOnFocus: true
        }).showToast();
        @endif
    });
</script>

