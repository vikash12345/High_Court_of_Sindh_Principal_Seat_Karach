<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';
$BaseLink = 'http://202.61.43.40:8082/cases/search-result?CasesSearch%5BCASENAMECODE%5D=&CasesSearch%5BCASENO%5D=&CasesSearch%5BCASEYEAR%5D=&CasesSearch%5BCIRCUITCODE%5D=1&CasesSearch%5BMATTERCODE%5D=&CasesSearch%5BPARTY%5D=&CasesSearch%5BGOVT_AGENCY_CODE%5D=&CasesSearch%5BFIRNO%5D=&CasesSearch%5BFIRYEAR%5D=&CasesSearch%5BPOLICESTATIONCODE%5D=&CasesSearch%5BADVOCATECODE%5D=&CasesSearch%5BisPending%5D=3&page=';
//2&per-page=15
for($i = 1; $i < 2; $i++)
{
$Newlink = $BaseLink . $i. '&per-page=15';
$link = file_get_html($Newlink);  
  foreach($link->find("//[@id='w1-container']/table/tbody/tr") as $element){
  echo  $num        = $element->find('td[1]',0)->plaintext;
    $casename    = $element->find('td[2]',0)->plaintext;
    $caseno        = $element->find('td[3]',0)->plaintext;
    $casey = $element->find('td[4]',0)->plaintext;
    $bench = $element->find('td[5]',0)->plaintext;
    $court = $element->find('td[6]',0)->plaintext;
    $casetitle = $element->find('td[7]',0)->plaintext;
    $matter = $element->find('td[8]',0)->plaintext;
    $last = $element->find('td[9]',0)->plaintext;
    $nextdate = $element->find('td[10]',0)->plaintext;
    echo "----------------------------------";
    
   
  }

}




// // Read in a page
// $html = scraperwiki::scrape("http://foo.com");
//
// // Find something on the page using css selectors
// $dom = new simple_html_dom();
// $dom->load($html);
// print_r($dom->find("table.list"));
//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")

// You don't have to do things with the ScraperWiki library.
// You can use whatever libraries you want: https://morph.io/documentation/php
// All that matters is that your final data is written to an SQLite database
// called "data.sqlite" in the current working directory which has at least a table
// called "data".
?>
