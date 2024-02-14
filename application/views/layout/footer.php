<a href="#" class="scrollToTop"><img src="images/backtotop.png" /></a>
<script>
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
    $(document).ready(function () {

        //Check to see if the window is top if not then display button
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollToTop').fadeIn();
            } else {
                $('.scrollToTop').fadeOut();
            }
        });

        //Click event to scroll to top
        $('.scrollToTop').click(function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

    });
</script>
</body>
<!--{elapsed_time} - {memory_usage}-->
</html>