//set start to date your site was published
$startCopyRight='2004';

// check if start year is this year
if(date('Y') == $startCopyRight){
// it was, just print this year
    echo $startCopyRight;
}else{
// it wasnt, print startyear and this year delimited with a dash
    echo $startCopyRight.'-'. date('Y');
}