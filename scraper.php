<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';
error_reporting(0);

$Link = 'http://202.61.43.40:8082/cases/search-result?CasesSearch%5BCASENAMECODE%5D=&CasesSearch%5BCASENO%5D=&CasesSearch%5BCASEYEAR%5D=&CasesSearch%5BCIRCUITCODE%5D=1&CasesSearch%5BMATTERCODE%5D=&CasesSearch%5BPARTY%5D=&CasesSearch%5BGOVT_AGENCY_CODE%5D=&CasesSearch%5BFIRNO%5D=&CasesSearch%5BFIRYEAR%5D=&CasesSearch%5BPOLICESTATIONCODE%5D=&CasesSearch%5BADVOCATECODE%5D=&CasesSearch%5BisPending%5D=3&page=1&per-page=15';

$link =	file_get_html($Link);
$loopnumberforpagintion = $link->find("//[@id='w1']/div/div[1]/div[1]/div/b[2]",0)->plaintext;
$text = str_replace(',', '', $loopnumberforpagintion);
$paginations = $text  / 15 + 1;
$loop =  (int)$paginations;


for($i = 1; $i <= $loop; $i++)
{
	$Newlink = 'http://202.61.43.40:8082/cases/search-result?CasesSearch%5BCASENAMECODE%5D=&CasesSearch%5BCASENO%5D=&CasesSearch%5BCASEYEAR%5D=&CasesSearch%5BCIRCUITCODE%5D=1&CasesSearch%5BMATTERCODE%5D=&CasesSearch%5BPARTY%5D=&CasesSearch%5BGOVT_AGENCY_CODE%5D=&CasesSearch%5BFIRNO%5D=&CasesSearch%5BFIRYEAR%5D=&CasesSearch%5BPOLICESTATIONCODE%5D=&CasesSearch%5BADVOCATECODE%5D=&CasesSearch%5BisPending%5D=3&page=' .$i. '&per-page=15';
	
	$link = file_get_html($Newlink);  
	if($link)
		{
			foreach($link->find("//[@id='w1-container']/table/tbody/tr") as $element)
			{	
				$num        = $element->find('td[1]',0)->plaintext;
				if($num != null)
					{
						$num        = $element->find('td[1]',0)->plaintext;
						echo '<br\>'.$num;
						$casename    = $element->find('td[2]',0)->plaintext;
						$caseno        = $element->find('td[3]',0)->plaintext;
						$casey = $element->find('td[4]',0)->plaintext;
						$bench = $element->find('td[5]',0)->plaintext;
						$court = $element->find('td[6]',0)->plaintext;
						$casetitle = $element->find('td[7]',0)->plaintext;
						$matter = $element->find('td[8]',0)->plaintext;
						$last = $element->find('td[9]',0)->plaintext;
						$nextdate = $element->find('td[10]',0)->plaintext;
						$href = $element->find('td[11]/a',0)->href;
						$profilelink = 'http://202.61.43.40:8082'.$href;

						scraperwiki::save_sqlite(array('num'), array('num' => $num,
															 'casename' => $casename,
															 'caseno' => $caseno, 
															 'casey' => $casey, 
															 'bench' => $bench, 
															 'court' => $court, 
															 'casetitle' => $casetitle, 
															 'matter' => $matter, 
															 'last' => $last, 
															 'nextdate' => $nextdate, 
															 'href' => $href,    
															 'profilelink' => $profilelink, 
															 'link' => $Newlink
															 ));
					}
			}
				
		}
	
}


?>
