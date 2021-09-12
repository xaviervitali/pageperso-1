<h2 id="portfolio">
	Portfolio
</h2>
<section class='category portfolio'>

	<?php 
	$objPDOStatement = readLine_("work",1);
	foreach($objPDOStatement as $index => $tabLigne)
	{	
		
		extract($tabLigne);
		$title=strtoupper($title);
		$keywords	=strtoupper($keywords);
		echo 
		<<<CODEHTML
		<figure>
		<i class="fas fa-angle-double-left previousWork"></i>
		
		
		<div class="overlay animated"><img src="$workImg" alt="$title"/>
		<figcaption>
		<a href="$workUrl" target="_blank">
		<h3 class="titre">$title</h3>
		
		
		
		
		<p  class="description">$content</p>	
		<h3>Compétences mobilisée</h3>
		<h4 class="keywords">$keywords</h4>
		</a>
		</figcaption>
		</div>
		
		
		<i class="fas fa-angle-double-right nextWork"></i>
		
		</figure>

				
	

CODEHTML;

}

?>

	

</section>

