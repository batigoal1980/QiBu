</div>
<div id="up_footer">
<div id="footer">

	<p>

    	<a href="learn-more.php">Learn More </a> | <a href="manifesto.php">Manual</a> | <a href="faq.php">FAQ</a> | <a href="contact.php">Contacts</a> | <a href="abuse.php">Report Abuse</a><br />

		Copyright Guruscript 2010 | <a href="terms.php">Terms and Conditions</a> | <a href="privacy.php">Privacy</a> | <a href="credits.php">Credits</a></p>

</div>
</div>
<script src="js/default.js?t=29" type="text/javascript"></script>

<script type="text/javascript" src="js/addthis_widget.js?pub=project"></script>

<script type="text/javascript">

//<![CDATA[



    Number.prototype.formatMoney = function(c, d, t){

	    var n = this, c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;

	    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");

    };

    

    function formatCurrency(value) {

        return value.formatMoney(0, '.', ',');

    }

    

    var COOKIE = '_c';

    var MIN_INCREMENT = 1;

    var MAX_INCREMENT = 5;

    var DELTA_START = 500;

    var DELTA_MAX = 200;

    var MIN_TIMEOUT = 1000;

    var MAX_TIMEOUT = 2000;



    function random(min, max)

    {

        return Math.floor(Math.random() * max + min);

    }



    function getTimeout() {

        var value = random(MIN_TIMEOUT, MAX_TIMEOUT);

        MAX_TIMEOUT += 100;

        return value;

    }

    

    function getValue(control)

    {

        return parseInt(control.text().replace(',', ''));

    }

    

    function updateCounter(control, max) {

        var n = getValue(control);

        n += random(MIN_INCREMENT, MAX_INCREMENT);

        n = Math.min(max, n);



        control

	        //.fadeOut(50)

	        //.fadeIn(200)

	        .text(formatCurrency(n));



        $.cookie(COOKIE, n.toString(), { expires: 1, path: '/', domain: 'gurudonation.com' });

        

        if (n < max) {

            window.setTimeout(function() { updateCounter(control, max); }, getTimeout());

        }

    }



    function startCounter(control) {

        var max = getValue(control);

        var start = max - DELTA_START;



        var prevValue = 0;

        if ($.cookie(COOKIE)) {

            try { prevValue = parseInt($.cookie(COOKIE)); } catch (e) { }            

        }

        if (isNaN(prevValue)) prevValue = 0;

        start = Math.max(Math.min(prevValue, max), start);       



        if (start >= max)

            start = max - (DELTA_MAX);

            

        if (start < 1)

            start = 1;

            

        control.text(formatCurrency(start));

        control.css('visibility', 'visible');

        

        window.setTimeout(function() { updateCounter(control, max); }, getTimeout());

    }

    

    $(function() {



        startCounter($('#counter_money'));

        

        $('.text_amount input')

            .attr('autocomplete', 'off')

            .focus()

            .keypress(function(e) {

                if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {

                    $('input.start').click();

                    e.preventDefault();

                }

            });



        $('#featured ul')

            .css('visibility', 'visible')

            .jcarousel({

                vertical: true,

                auto: 4,

                scroll: 1,

                visible: 3,

                animation: 5000

            });

    });



//]]>

</script>



<script type="text/javascript">

//<![CDATA[

    $(function() {

        if ($.browser.mozilla)

            $('span.inline').css('display', '-moz-inline-box');



        $('.number').numeric();

        $('.currency').numeric();



        $('#q')

            .keypress(function(e) {

                if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {

                    // $('').click();

                    return false;

                } else {

                    return true;

                }

            });



        $('.watermark input:text')

            .each(function() { if (this.value == '') this.value = this.title; })

            .focus(function() { if (this.value == this.title) this.value = ''; })

            .blur(function() { if (this.value == '') this.value = this.title; });



        $('.watermark input:image, .watermark input:button, .watermark input:submit').click(function() {

            $(this.form.elements).each(function() {

                if (this.type == 'text' || this.type == 'textarea' || this.type == 'password') {

                    if (this.value == this.title && this.title != '') {

                        this.value = '';

                    }

                }

            });

        });

    });

//]]>          

</script>

</body>

</html>