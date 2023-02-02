<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>teste</title>
</head>

<body>
	 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
         <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
                        <a class="navbar-brand" href="https://www.codexworld.com/">
                <img src="https://www.codexworld.com/wp-content/uploads/2014/09/codexworld-logo.png" alt="CodexWorld">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="social_btn nav navbar-nav navbar-left">
                <li class="flike"><iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Ffacebook.com%2Fcodexworld&width=85&layout=button_count&action=like&show_faces=false&share=false&height=21&appId=1602134356668306" width="85" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></li>
                <li class="tflow"><iframe allowtransparency="true" data-show-count="true" frameborder="0" scrolling="no" src="//platform.twitter.com/widgets/follow_button.html?screen_name=codexworldblog" style="width:300px; height:20px;"></iframe></li>
            </ul>
             
            <ul class="nav navbar-nav navbar-right">
                        	<li>
                    <a href="http://www.codexworld.com/downloads/convert-html-to-pdf-using-javascript-jspdf">Download</a>
                </li>
                        
                        	<li>
                    <a href="https://www.codexworld.com/convert-html-to-pdf-using-javascript-jspdf/">Tutorial</a>
                </li>
                        </ul>
                    </div>
        <!-- /.navbar-collapse -->
          	</div>
</nav>
<div class="bar-header">
	<!-- CodexWorld_Demo_HeaderTop -->
	<ins class="adsbygoogle"
		 style="display:block"
		 data-ad-client="ca-pub-5750766974376423"
		 data-ad-slot="8179048472"
		 data-ad-format="auto"
		 data-full-width-responsive="true"></ins>
	<script>
		 (adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>
<div class="demo-title"><h4>DEMO BY <span class="one">CODEX</span><span class="two">WORLD</span>: Convert HTML to PDF using JavaScript</h4></div>
        <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <div>
            	<button onclick="generatePDF();">Click to Generate PDF</button>
				<button onclick="convert_HTML_To_PDF();">Convert HTML to PDF</button>
				
				<!-- HTML content for PDF creation -->
				<div id="contnet">
					<h1>What is Lorem Ipsum?</h1>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				</div>
				<div id="elementH"></div>
            </div>
        </div>
    </div>

</div>
    <!-- /.container -->
	    	<div class="bar-footer">
			<!-- CodexWorld_Demo_PageBottom -->
			<ins class="adsbygoogle"
				 style="display:block"
				 data-ad-client="ca-pub-5750766974376423"
				 data-ad-slot="1397129652"
				 data-ad-format="auto"
				 data-full-width-responsive="true"></ins>
			<script>
				 (adsbygoogle = window.adsbygoogle || []).push({});
			</script>
        </div>
        	<!-- JavaScript -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     	        <script src="http://demos.codexworld.com/includes/js/bootstrap.js"></script>
        <!-- Place this tag in your head or just before your close body tag. -->
        <!--<script src="https://apis.google.com/js/platform.js" async defer></script>-->
    	

<!-- jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

<script>
/*
 * Generate 2 pages PDF document
 */
function generatePDF() {
	var doc = new jsPDF();
	
	doc.text(20, 20, 'Hello world!');
	doc.text(20, 30, 'This is client-side Javascript to generate a PDF.');
	
	doc.text(20, 40, 'This is the default font.');
	
	doc.setFont("courier");
	doc.setFontType("normal");
	doc.text(20, 50, 'This is courier normal.');
	
	doc.setFont("times");
	doc.setFontType("italic");
	doc.text(20, 60, 'This is times italic.');
	
	doc.setFont("helvetica");
	doc.setFontType("bold");
	doc.text(20, 70, 'This is helvetica bold.');
	
	doc.setFont("courier");
	doc.setFontType("bolditalic");
	doc.text(20, 80, 'This is courier bolditalic.');
	
	doc.addPage();
	
	doc.setFontSize(24);
	doc.text(20, 20, 'This is a title');
	
	doc.setFontSize(16);
	doc.text(20, 30, 'This is some normal sized text underneath.');
	
	doc.setTextColor(100);
	doc.text(20, 40, 'This is gray.');
	
	doc.setTextColor(150);
	doc.text(20, 50, 'This is light gray.');
	
	doc.setTextColor(255,0,0);
	doc.text(20, 60, 'This is red.');
	
	doc.setTextColor(0,255,0);
	doc.text(20, 70, 'This is green.');
	
	doc.setTextColor(0,0,255);
	doc.text(20, 80, 'This is blue.');
	
	// Save the PDF
	doc.save('document.pdf');
}

/*
 * Convert HTML content to PDF
 */
function convert_HTML_To_PDF() {
	var doc = new jsPDF();
	var elementHTML = $('#contnet').html();
	var specialElementHandlers = {
		'#elementH': function (element, renderer) {
			return true;
		}
	};
	doc.fromHTML(elementHTML, 15, 15, {
        'width': 170,
        'elementHandlers': specialElementHandlers
    });
	
	// Save the PDF
	doc.save('sample-document.pdf');
}
</script>
</body>
</html>
