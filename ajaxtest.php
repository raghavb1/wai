
<!DOCTYPE html> 
<html> 
    <head> 
        <title>Home</title> 
        <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
        <link type="text/css" href="styles.css" rel="stylesheet"> 
        <script type="text/javascript"> 
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-56538-1']);
            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
            })();
        </script> 
<script type="text/javascript" src="jquery.min.js"></script>
        <script type="text/javascript" src="jquery.address-1.3.min.js?state=/ajaxtest"></script> 
        <script type="text/javascript"> 
 
            $.address.init(function(event) {
 
                // Initializes the plugin
                $('.nav a').address();
                
            }).change(function(event) {
 
                var value = $.address.state().replace(/^\/$/, '') + event.value;
                
                // Selects the proper navigation link
                $('.nav a').each(function() {
                    if ($(this).attr('href') == value) {
                        $(this).addClass('selected').focus();
                    } else {
                        $(this).removeClass('selected');
                    }
                });
 
                // Loads and populates the page data
                $.ajax({
                    cache: false,
                    complete: function(XMLHttpRequest, textStatus) {
                        var data = $.parseJSON(XMLHttpRequest.responseText);
                        $.address.title(data.title);
                        $('.content').html(data.content);
                        $('.page').show();
                    },
                    url: value
                });
            });
 
            // Hides the page during initialization
            document.write('<style type="text/css"> .page { display: none; } </style>');
            
        </script> 
    </head> 
    <body> 
        <div class="page"> 
            <h1>jQuery Address Express</h1> 
            <ul class="nav"> 
            
                <li><a href="/jquery/address/samples/express/" class="selected">Home</a></li> 
            
                <li><a href="/jquery/address/samples/express/about">About</a></li> 
            
                <li><a href="/jquery/address/samples/express/portfolio">Portfolio</a></li> 
            
                <li><a href="/jquery/address/samples/express/contact">Contact</a></li> 
            
            </ul> 
            <div class="content">Home content.</div> 
        </div> 
    </body> 
</html> 
 
 