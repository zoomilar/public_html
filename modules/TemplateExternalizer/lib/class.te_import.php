<?php
class te_import
{
	

	
	
	
	
	
	
	
/* Importer tous les templates - Début ************************************** */

public function ImportAll() {
	self::ImportTemplates() ;
	// Double appel pour tenter de corriger un besoin de rafraichir 2 fois la
	// page pour voir les modifications sur les gabarits, c'est pas beau mais ça
	// fonctionne.
	self::ImportTemplates() ;
	self::ImportUDT() ;
	self::ImportCSS() ;
	self::ImportModulesTemplates() ;
	self::ImportGCB() ;
	self::ImportSitePrefs() ;
	te_base::CheckTimeOut() ;
}

/* Importer tous les templates - Fin **************************************** */









/* Importer les gabarits - Début ******************************************** */

private function ImportTemplates()
{
	
	// Sous-dossier des fichiers
	$subdir = "_Templates" ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath() ;
	
	// Date de la dernière modification
	$most_recent_edit = te_base::GetMostRecentEdit() ;
	
	// Récupération de l'extension du fichier
	$template_extension = $this->GetPreference('template_extension');
	
	// Récupération de la liste des gabarits
	$gCms = cmsms() ;
  $to =& $gCms->getTemplateOperations() ;
  $templates = $to->LoadTemplates() ;
    
  foreach($templates as $key => $template) {
    $fname = $cache_path.DIRECTORY_SEPARATOR.$subdir.DIRECTORY_SEPARATOR.te_base::escapeFilename($template->name).'.'.$template_extension;
    $ftime = @filemtime($fname);
    $most_recent_edit = max($most_recent_edit, $ftime);
		
		// Chargement du fichier seulement s'il a été modifié et si la taille est supérieure à 0
    if($ftime > $template->modified_date && ($fsize = filesize($fname)) != 0) {
      $fp = fopen($fname, 'r');
      $templates[$key]->content = fread($fp, $fsize);
			$templates[$key]->Save();
      fclose($fp);
			te_base::ResetTimeOut() ;
    }

  }

}
	
/* Importer les gabarits - Fin ********************************************** */









/* Importer les feuilles de style - Début *********************************** */

private function ImportCSS()
{
	
	// Sous-dossier des fichiers
	$subdir = "_CSS" ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath() ;
	
	// Date de la dernière modification
	$most_recent_edit = te_base::GetMostRecentEdit() ;
	
	// Récupération de l'extension du fichier
	$stylesheet_extension = $this->GetPreference('stylesheet_extension');
	
	// Récupération de la liste des gabarits
	$gCms = cmsms() ;
  $so = $gCms->getStylesheetOperations() ;
  $stylesheets = $so->LoadStylesheets() ;
    
  foreach($stylesheets as $key => $stylesheet) {
    $fname = $cache_path.DIRECTORY_SEPARATOR.$subdir.DIRECTORY_SEPARATOR.te_base::escapeFilename($stylesheet->name).'.'.$stylesheet_extension;
    $ftime = @filemtime($fname);
    $most_recent_edit = max($most_recent_edit, $ftime);

		// Chargement du fichier seulement s'il a été modifié et si la taille est supérieure à 0
    if($ftime > $stylesheet->modified_date && ($fsize = filesize($fname)) != 0) {
      $fp = fopen($fname, 'r');
      $stylesheets[$key]->value = fread($fp, $fsize);
      $stylesheets[$key]->Save();
      fclose($fp);
			te_base::ResetTimeOut() ;
    }
  }
	
}
	
/* Importer les feuilles de style - Fin ************************************* */









/* Importer les gabarits des modules - Début ******************************** */

private function ImportModulesTemplates()
{

	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath() ;
	
	// Récupération de l'extension du fichier
	$template_extension = $this->GetPreference('template_extension');

	// Récupération de la liste des modules
	$gCms = cmsms() ;
	$db = $gCms->GetDb() ;
  $mo = $gCms->GetModuleOperations() ;
	$modules = $mo->GetInstalledModules() ;
	
	// Date de la dernière modification
	$most_recent_edit = te_base::GetMostRecentEdit() ;

  foreach($modules as $modulename)
  {
		$query = 'SELECT * FROM '.cms_db_prefix().'module_templates
							WHERE module_name = ?';
		$alltemplates = $db->GetArray($query,array($modulename));
		if( !count($alltemplates) ) continue;

    foreach( $alltemplates as $onetemplate )
		{
			$fname = $cache_path.DIRECTORY_SEPARATOR.$modulename.DIRECTORY_SEPARATOR.te_base::escapeFilename($onetemplate['template_name']).'.'.$template_extension;
			if( !@file_exists($fname) ) continue;

			$ftime = filemtime($fname);
			$fsize = filesize($fname);
			$most_recent_edit = max($most_recent_edit, $ftime);
			$dbmtime = $db->UnixTimeStamp($onetemplate['modified_date']);
			$fdbtime = $db->DbTimeStamp($ftime);

			if( $ftime > $dbmtime && $fsize != 0 )
			{
				$fp = fopen($fname,'r');
				$onetemplate['content'] = fread($fp,$fsize);
				fclose($fp);

				$query = 'UPDATE '.cms_db_prefix()."module_templates SET content = ?, modified_date = $fdbtime
									WHERE module_name = ? AND template_name = ?";  
				$dbr = $db->Execute($query,
				array($onetemplate['content'], $modulename, $onetemplate['template_name']));
				te_base::ResetTimeOut() ;
			}
		}
   }

}
	
/* Importer les gabarits des modules - Fin ********************************** */









/* Importer les blocs de contenus globaux - Début *************************** */

public function ImportGCB()
{

	// Sous-dossier des fichiers
	$subdir = "_GCB" ;

	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath() ;
	
	// Récupération de l'extension du fichier
	$template_extension = $this->GetPreference('template_extension');

	// Récupération de la liste des modules
	$gCms = cmsms() ;
	$db = $gCms->GetDb() ;
  $gco = $gCms->GetGlobalContentOperations() ;
	$gcbs = $gco->LoadHtmlBlobs() ;

	// Date de la dernière modification
	$most_recent_edit = te_base::GetMostRecentEdit() ;

  foreach($gcbs as $key => $gcb) {
    $fname = $cache_path.DIRECTORY_SEPARATOR.$subdir.DIRECTORY_SEPARATOR.te_base::escapeFilename($gcb->name).'.'.$template_extension;
    $ftime = @filemtime($fname);
    $most_recent_edit = max($most_recent_edit, $ftime);

		// Chargement du fichier seulement s'il a été modifié et si la taille est supérieure à 0
    if($ftime > $gcb->modified_date && ($fsize = filesize($fname)) != 0) {
      $fp = fopen($fname, 'r');
      $gcb->content = fread($fp, $fsize);
			$result = $gco->UpdateHtmlBlob($gcb);
      fclose($fp);
			te_base::ResetTimeOut() ;
    }
  }

}
	
/* Importer les blocs de contenus globaux - Fin ***************************** */









/* Importer les préférences du site - Début ********************************* */

private function ImportSitePrefs()
{

	// Sous-dossier des fichiers
	$subdir = "_SitePrefs" ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath() ;
	
	// Récupération de l'extension du fichier
	$template_extension = $this->GetPreference('template_extension');

	// Récupération de la liste des modules
	$gCms = cmsms() ;
	$db = $gCms->GetDb() ;
  
	// Charger quelques SitePrefs et les sauver dans des fichiers
	$query = 'SELECT * FROM '.cms_db_prefix().'siteprefs';
	$allsiteprefs = $db->GetAll($query);
	
	// Date de la dernière modification
	$most_recent_edit = te_base::GetMostRecentEdit() ;
	
	foreach( $allsiteprefs as $onesiteprefs )
	{
	
		if ($onesiteprefs['sitepref_name'] == 'sitedownmessage' OR
				$onesiteprefs['sitepref_name'] == 'metadata' OR
				$onesiteprefs['sitepref_name'] == 'page_metadata' OR
				$onesiteprefs['sitepref_name'] == 'defaultpagecontent')
		{
			$fname = $cache_path.DIRECTORY_SEPARATOR.$subdir.DIRECTORY_SEPARATOR.te_base::escapeFilename($onesiteprefs['sitepref_name']).'.'.$template_extension;
			if( !@file_exists($fname) ) continue;

			$ftime = filemtime($fname);
			$fsize = filesize($fname);
			$most_recent_edit = max($most_recent_edit, $ftime);
			$dbmtime = $db->UnixTimeStamp($onesiteprefs['modified_date']);
			$fdbtime = $db->DbTimeStamp($ftime);

			if( $ftime > $dbmtime && $fsize != 0 )
			{
				$fp = fopen($fname,'r');
				$onesiteprefs['sitepref_value'] = fread($fp,$fsize);
				fclose($fp);

				$query = 'UPDATE '.cms_db_prefix()."siteprefs SET sitepref_value = ?, modified_date = $fdbtime
									WHERE sitepref_name = ?";  
				$dbr = $db->Execute($query,
				array($onesiteprefs['sitepref_value'], $onesiteprefs['sitepref_name']));
				te_base::ResetTimeOut() ;
			}
		
		}
	}
	
}
	
/* Importer les préférences du site - Fin *********************************** */









/* Importer les balises utilisateurs - Début ******************************** */

private function ImportUDT()
{
	
	// Création du sous-dossier
	$subdir = "_UDT" ;
	te_base::CreateSubDir($subdir) ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath() ;
	
	// Récupération de l'extension du fichier
	$template_extension = $this->GetPreference('template_extension');

	// Récupération de la liste des GCB
	$gCms = cmsms() ;
	$db = $gCms->GetDb() ;
	$uto = $gCms->GetUserTagOperations() ;
	$udts = $uto->ListUserTags() ;
	
	if(count($udts) > 0)
	{
	
		// Date de la dernière modification
		$most_recent_edit = te_base::GetMostRecentEdit() ;

		foreach( $udts as $udt )
		{
		
			$udt = $uto->GetUserTag($udt) ;

			$fname = $cache_path.DIRECTORY_SEPARATOR.$subdir.DIRECTORY_SEPARATOR.te_base::escapeFilename($udt['userplugin_name']).'.'.$template_extension;
			if( !@file_exists($fname) ) continue;

			$ftime = filemtime($fname);
			$fsize = filesize($fname);
			$most_recent_edit = max($most_recent_edit, $ftime);
			$dbmtime = $db->UnixTimeStamp($udt['modified_date']);
			$fdbtime = $db->DbTimeStamp($ftime);

			if( $ftime > $dbmtime && $fsize != 0 )
			{
				$fp = fopen($fname,'r');
				$udt['code'] = fread($fp,$fsize);
				fclose($fp);

				$uto->SetUserTag($udt['userplugin_name'], $udt['code']) ;
				te_base::ResetTimeOut() ;
			}
		
		}
		
	}
	
}
	
/* Importer les balises utilisateurs - Fin ********************************** */









}
?>