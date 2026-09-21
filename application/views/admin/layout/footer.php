    </div> <!-- End of Content -->
</div> <!-- End of Wrapper -->

<!-- Core Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function () {
        // Toggle Sidebar
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('collapsed');
        });

        // Initialize Summernote WYSIWYG
        if ($('.summernote').length > 0) {
            $('.summernote').summernote({
                placeholder: 'Write your full SEO-rich blog article here...',
                tabsize: 2,
                height: 380,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'italic', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        }

        // Live Character Counter for SEO Meta Fields
        $('#meta_title').on('input', function() {
            var len = $(this).val().length;
            $('#meta_title_count').text(len);
            if (len > 60) {
                $('#meta_title_count').addClass('text-danger').removeClass('text-success');
            } else {
                $('#meta_title_count').addClass('text-success').removeClass('text-danger');
            }
        });

        $('#meta_description').on('input', function() {
            var len = $(this).val().length;
            $('#meta_desc_count').text(len);
            if (len > 160) {
                $('#meta_desc_count').addClass('text-danger').removeClass('text-success');
            } else {
                $('#meta_desc_count').addClass('text-success').removeClass('text-danger');
            }
        });

        // Auto Slug Generation from Title
        $('#post_title').on('keyup change', function() {
            if ($('#post_slug').data('touched') !== true) {
                var title = $(this).val();
                var slug = title.toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
                $('#post_slug').val(slug);
                $('#canonical_preview').text('https://thecellphonedoctor.com/blog/' + slug);
                if ($('#canonical_url').val() === '') {
                    $('#canonical_url').val('https://thecellphonedoctor.com/blog/' + slug);
                }
            }
        });

        $('#post_slug').on('input', function() {
            $(this).data('touched', true);
            var slug = $(this).val();
            $('#canonical_preview').text('https://thecellphonedoctor.com/blog/' + slug);
        });
    });
</script>
</body>
</html>
