@if (session('success'))

    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'تم التسجيل بنجاح',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 4000
        })
    </script>

@endif
