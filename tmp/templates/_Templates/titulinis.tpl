{assign var="titulinis" value=1}

{cms_include tpl="header"}
{*}
{Titulinis kategorija="foto" kalba=$kalba}
{News summarytemplate="title_page" detailpage=$smarty.config.mews_inside_page category="`$kalba` *"}
{Titulinis kategorija="blokai" kalba=$kalba}
{*}

{cms_include tpl="footer"}
 
