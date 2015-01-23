<?php
if (!isset($gCms)) exit;

if (! $this->CheckAccess())
{
	return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}









/* Récupération des données - Début ***************************************** */

if (isset($params['utilisation_submit']) OR isset($params['refresh_submit'])) {
	
	// Activation ou désactivation du module
	if (isset($params['utilisation_submit']))
	{
		te_base::ChangeStatus() ;
	}
	
	// Si le mode de développement est actif
	if (te_base::GetStatus() == true OR isset($params['refresh_submit'])) {
		te_base::DeleteCachePath() ;
		te_export::ExportAll() ;
	}
	
	if (isset($params['refresh_submit']))
	{
		$this->Redirect($id, 'defaultadmin', $returnid, array('active_tab' => "utilisation", 'module_message' => $this->Lang('refreshed')));
	}
	
	unset($params) ;
	
}

/* Récupération des données - Fin ******************************************* */









/* Création du formulaire - Début ******************************************* */

$smarty->assign('formstart_utilisation',
		$this->CreateFormStart($id,'defaultadmin',$returnid,
					 $params,false,'post','multipart/form-data'));
$smarty->assign('formend_utilisation',$this->CreateFormEnd());

if (te_base::GetStatus() == false)
{
	$smarty->assign('utilisation_submit', $this->CreateInputSubmit($id, 'utilisation_submit', $this->lang('enable_submit')));
} else
{
	$smarty->assign('utilisation_submit', $this->CreateInputSubmit($id, 'utilisation_submit', $this->lang('disable_submit')));
	$smarty->assign('refresh_submit', $this->CreateInputSubmit($id, 'refresh_submit', $this->lang('refresh_submit')));
}

/* Création du formulaire - Fin ********************************************* */









/* Traitement du temps restant - Début ************************************** */

$timeoutleft = te_base::CheckTimeOut() ;
if ($timeoutleft >= 0)
{
	$timeoutleft = ceil($timeoutleft / 60) ;
}
$smarty->assign("timeoutleft", $timeoutleft) ;

/* Traitement du temps restant - Fin **************************************** */









/* Afficher le template - Début ********************************************* */

$smarty->assign("status", te_base::GetStatus()) ;
$smarty->assign_by_ref('mod',$this);
echo $this->ProcessTemplate('defaultadmin.tab.utilisation.tpl');

/* Afficher le template - Fin *********************************************** */
?>