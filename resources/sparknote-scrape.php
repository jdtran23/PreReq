
<?php
// example of how to use basic selector to retrieve HTML contents
require_once('simplehtmldom_1_5/simple_html_dom.php');
 
	$sparknotes = file_get_html('http://www.sparknotes.com/sparknotes/');
	foreach($sparknotes->find('div.subjects') as $subject_list)
	{
		foreach($subject_list->find('li') as $subject) 
		{
			$subject_text = $subject->innertext;
			$half_trimmed = substr($subject_text, strpos($subject_text, "\"")+1);
			$trimmed = substr($half_trimmed, 0, strpos($half_trimmed, "\""));
			//echo $trimmed . '<br>';
			if($trimmed != "")
			{
				scrape_super_sub_skills($trimmed);
			}
		}
	}
 
	//scrape_super_sub_skills('http://www.sparknotes.com/cs/');
	//scrape_super_sub_skills('http://www.sparknotes.com/biology/');
 
 
 function scrape_super_sub_skills($html_link)
{ 
	// get DOM from URL or file
	$html = file_get_html($html_link);

	// find all link

        foreach($html->find('div') as $element)
        {
                if($element->class == "entry odd")
                {                
                        foreach($element->find('p.authorTitle') as $element_subskill)
                        {
                                foreach($element->find('span') as $element_superskill)
                                {
									$element_subskill_string = $element_subskill->plaintext;
									if(strpos($element_subskill_string , 'Introduction') === false && strpos($element_subskill_string , 'Review') === false)  //replace with fact there's no wikipedia for it
									{ 
										echo '<b>Subskill: </b>' . $element_subskill->plaintext  . ' <b>for SuperSkill: </b>' . $element_superskill->innertext . '<br><br>' ;
									}
								
								}
                        }
                        
                }
        }
}

?>

