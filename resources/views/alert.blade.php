<script>
    $(document).ready(function() {
        @if (session('success'))
            $.notify({
                icon: 'fas fa-check-circle',
                title: 'Berhasil!',
                message: '{{ session('success') }}'
            }, {
                type: 'success',
                placement: {
                    from: "top",
                    align: "right"
                },
                time: 4000,
                delay: 0
            });
        @endif

        @if (session('error'))
            $.notify({
                icon: 'fas fa-exclamation-circle',
                title: 'Gagal!',
                message: '{{ session('error') }}'
            }, {
                type: 'danger',
                placement: {
                    from: "top",
                    align: "right"
                },
                time: 4000,
                delay: 0
            });
        @endif

        @if (session('warning'))
            $.notify({
                icon: 'fas fa-exclamation-triangle',
                title: 'Perhatian!',
                message: '{{ session('warning') }}'
            }, {
                type: 'warning',
                placement: {
                    from: "top",
                    align: "right"
                },
                time: 4000,
                delay: 0
            });
        @endif

        @if (session('info'))
            $.notify({
                icon: 'fas fa-info-circle',
                title: 'Informasi',
                message: '{{ session('info') }}'
            }, {
                type: 'info',
                placement: {
                    from: "top",
                    align: "right"
                },
                time: 4000,
                delay: 0
            });
        @endif
    });
</script>
