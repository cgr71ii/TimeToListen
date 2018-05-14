<!-- Ajax Publication -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script type="text/javascript">

        $(function() {
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');  
                getArticles(url);
                window.history.pushState("", "", url);
            });

            function getArticles(url) {
                $.ajax({
                    url : url  
                }).done(function (data) {
                    $("." + "{{ $class_name }}").html(data);  
                }).fail(function () {
                    alert('{{ $object_title }} could not be loaded.');
                });
            }
        });

    </script>

    <!-- End Ajax Publication -->