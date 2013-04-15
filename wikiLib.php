<?php
/* Simple library for getting suggestions from wikipedia.
 * Search queries should be formatted (' ' -> '%20')
 * 
 * wikiExists($topic)
 * 		Used to verify whether wikipedia page exists or not.
 * 
 * wikiSuggest($term,$suggestRank)
 * 		Gets suggestRank-th suggestion from wikipedia if it exists.
 * 
 */

 include('simplehtmldom_1_5/simple_html_dom.php');
 
//Return 1 if topic page exists.
//Return 0 if page not found (404).
function wikiExists($topic){
		$url = "http://en.wikipedia.org/wiki/".$topic;
		if(@file_get_html($url))
			return 1;
		return 0;
}	

//$suggestRank denotes which Wikipedia suggestions we are reading.
function wikiSuggest($term, $suggestRank){
		$viewedResults=0;
		$url = "http://en.wikipedia.org/w/index.php?search=".$term;
		$html = file_get_html($url);

		foreach($html->find('div') as $element)
        {
				//We prioritize Wikipedia's suggestions. Always be rank 1.
                if($element->class == "searchdidyoumean" && 1==$suggestRank)
					return str_replace('Did you mean: ', '', $element->plaintext);
					
				//No spell-check suggestions for wikipedia.
                if($element->class == "mw-search-result-heading"){
					$viewedResults++;
					if($viewedResults==$suggestRank)
						return $element->plaintext;
				}
        }	
        
        //Page either exists, or page does not exist but we did not find a suggestion.
        //Use wikiExists to verify existence of Wikipedia page.
        return 0;
}

//Some simple tests.
function wikiTest(){
	$a=assert(0==wikiSuggest("Le%20Marin",1));
	$b=assert(0==wikiExists("Le%20Marhfhasin"));
	$c=assert(1==wikiExists("Le%20Marin"));
	if($a && $b && $c)
		return 1;
	return 0;
}

//print(wikiTest());
?>
