<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Products (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow users to create, manage
#  and display products in a variety of ways.
# 
# Version: 1.1.5
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin 
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE
if (!isset($gCms)) exit;

// setup the query
try {
  $query = new products_query();
  foreach( $params as $key => $value ) {
    try {
      $query[$key] = $value;
    }
    catch( Exception $e ) {
      // ignore this error.
    }
  }

  $results = new products_resultset($query);
  $results->curpage = $returnid;
  if( isset($params['notpretty']) ) {
    $results->notpretty = $params['notpretty'];
  }
  if( isset($params['detailpage']) ) {
    $results->detailpage = $params['detailpage'];
  }
  $entryarray = array();
  while( !$results->EOF ) {
    $entryarray[] = $results->get_product_for_display();
    $results->MoveNext();
  }

  //
  // give everything to smarty
  //
  $smarty->assign('items',$entryarray);
  $smarty->assign('itemcount',count($entryarray));
  $smarty->assign('totalcount',$results->totalrows);
  $smarty->assign('pagecount',$results->numpages);
  $smarty->assign('curpage',$query['page']);
  $page = $query['page'];
  if( $page == 1 ) {
    $smarty->assign('firstlink',$this->Lang('firstpage'));
    $smarty->assign('prevlink',$this->Lang('prevpage'));
  } else {
    $parms = $params;
    $parms['page'] = 1;
    $smarty->assign('firstlink',$this->CreateLink($id,'default',$returnid,
						  $this->Lang('firstpage'),
						  $parms));
    $smarty->assign('firstpage_url',$this->create_url($id,'default',$returnid,$parms));

    $parms['page'] = $page - 1;
    $smarty->assign('prevlink',$this->CreateLink($id,'default',$returnid,
						  $this->Lang('prevpage'),
						  $parms));
    $smarty->assign('prevpage_url',$this->create_url($id,'default',$returnid,$parms));
  }
  
  if( $page == $results->numpages ) {
    $smarty->assign('lastlink',$this->Lang('lastpage'));
    $smarty->assign('nextlink',$this->Lang('nextpage'));
  } else {
    $parms = $params;
    $parms['page'] = $results->numpages;
    $smarty->assign('lastlink',$this->CreateLink($id,'default',$returnid,
						  $this->Lang('lastpage'),
						  $parms));
    $smarty->assign('lastpage_url',$this->create_url($id,'default',$returnid,$parms));
    $parms['page'] = $page + 1;
    $smarty->assign('nextlink',$this->CreateLink($id,'default',$returnid,
						  $this->Lang('nextpage'),
						  $parms));
    $smarty->assign('nextpage_url',$this->create_url($id,'default',$returnid,$parms));
  }

  $thetemplate = 'summary_'.$this->GetPreference(PRODUCTS_PREF_DFLTSUMMARY_TEMPLATE);
  if( isset($params['summarytemplate'] ) ) {
    $thetemplate = 'summary_'.$params['summarytemplate'];
  }

  $smarty->assign('pagetext',$this->Lang('page'));
  $smarty->assign('oftext',$this->Lang('of'));
  $smarty->assign('currency_symbol',product_ops::get_currency_symbol());
  $smarty->assign('weight_units',product_ops::get_weight_units());  

  echo $this->ProcessTemplateFromDatabase($thetemplate);
}
catch( Exception $e ) {
  die($e->GetMessage());
}



#
# EOF
#
?>