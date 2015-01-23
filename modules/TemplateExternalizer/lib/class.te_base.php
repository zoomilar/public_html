<?php
class te_base
{









/* Changer le mode de développement - Début ********************************* */

public function ChangeStatus()
{

	if (self::GetStatus() == false)
		{
			return self::SetStatus(true) ;
		} else {
			return self::SetStatus(false) ;
		}
}

/* Changer le mode de développement - Fin *********************************** */









/* Retourner le status du mode de développement - Début ********************* */

public function GetStatus()
{

	return $this->GetPreference("dev_mode") ;

}

/* Retourner le status du mode de développement - Fin *********************** */









/* Modifier le status du mode de développement - Début ********************** */

public function SetStatus($status)
{

	if ($status == false)
	{
		self::DeleteCachePath() ;
	}

	$this->SetPreference("dev_mode", $status) ;
	return true ;

}

/* Modifier le status du mode de développement - Fin ************************ */









/* Modifier le CHMOD en écriture - Début ************************************ */

public function SetCHMOD($chmod)
{

	$this->SetPreference("chmod", $chmod) ;
	return true ;

}

/* Modifier le CHMOD en écriture - Fin ************************************** */









/* Récupérer le CHMOD en écriture - Début *********************************** */

public function GetCHMOD()
{

	return $this->GetPreference("chmod") ;

}

/* Récupérer le CHMOD en écriture - Fin ************************************* */









/* Modifier l'extension des gabarits - Début ******************************** */

public function SetTemplateExtension($extension)
{

	$this->SetPreference("template_extension", $extension) ;
	return true ;

}

/* Modifier l'extension des gabarits - Fin ********************************** */









/* Modifier l'extension des feuilles de style - Début *********************** */

public function SetStylesheetExtension($extension)
{

	$this->SetPreference("stylesheet_extension", $extension) ;
	return true ;

}

/* Modifier l'extension des feuilles de style - Fin ************************* */









/* Chemin de dossier d'exportation - Début ********************************** */
public function GetCachePath()
{

	// Récupérer et traiter la préférence du dossier
	$cache_path = $this->GetPreference("cache_path") ;
	
	// Si la préférence commence par un "/" alors l'enlever
	if (startswith($cache_path, DIRECTORY_SEPARATOR))
	{
		$cache_path = substr($cache_path, 1);
	}
	
	// Si la préférence termine par un "/" alors l'enlever
	if (endswith($cache_path, DIRECTORY_SEPARATOR))
	{
		$cache_path = substr($cache_path, -1, 1);
	}
	
	// Ajouter à la préférence le chemin complet
	$config = $this->GetConfig() ;
	$cache_path = $config['root_path'] . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . $cache_path ;
	return $cache_path ;

}
/* Chemin de dossier d'exportation - Fin ************************************ */









/* Création du dossier d'exportation - Début ******************************** */

public function CreateBaseDir()
{

	$cache_path = self::GetCachePath() ;
	
	// Vérifier si le dossier existe, si non, alors le créer
  if (!file_exists($cache_path))
	{
    if(mkdir($cache_path))
		{
			$chmod = self::GetCHMOD() ;
      chmod($cache_path, octdec($chmod));
    }
		else
		{
      $this->DisplayErrorPage($id, $params, $returnid, $this->Lang('unable_create_cache_path').$cache_path);
			return false ;
    }
  
	// Si le dossier existe, vérifier qu'il dispose des droits d'écriture
  }
	elseif(!is_writable($cache_path))
	{
    $this->DisplayErrorPage($id, $params, $returnid, $this->Lang('unable_write_cache_path').$cache_path);
		return false ;
  }
  
  // Réinitialiser le timeout
  self::ResetTimeOut() ;
	
	// Création d'un fichier index.html vide
	self::CreateIndex($cache_path) ;
	
	return true ;
	
}

/* Création du dossier d'exportation - Fin ********************************** */









/* Création un sous-dossier du dossier d'exportation - Début **************** */

public function CreateSubDir($dirname)
{

	$cache_path = self::GetCachePath() ;
	$dirname = $cache_path . DIRECTORY_SEPARATOR . $dirname ;
	
	// Vérifier si le dossier existe, si non, alors le créer
  if (!file_exists($dirname))
	{
    if(@mkdir($dirname))
		{
			$chmod = self::GetCHMOD() ;
      chmod($dirname, octdec($chmod));
    }
		else
		{
      $this->DisplayErrorPage($id, $params, $returnid, $this->Lang('unable_create_subdir').$dirname);
			return false ;
    }
  
	// Si le dossier existe, vérifier qu'il dispose des droits d'écriture
  }
	elseif(!is_writable($dirname))
	{
		$this->DisplayErrorPage($id, $params, $returnid, $this->Lang('unable_write_subdir').$dirname);
		return false ;
  }
	
	// Création d'un fichier index.html vide
	self::CreateIndex($dirname) ;
	
	return true ;
	
}

/* Création un sous-dossier du dossier d'exportation - Fin ****************** */









/* Créer d'un fichier index.html vide - Début ******************************* */
private function CreateIndex($dirname)
{
	$dummy = $dirname.DIRECTORY_SEPARATOR.'index.html';
  if(!file_exists($dummy))
	{
		if(@touch($dummy))
		{
		} else
		{
			$this->DisplayErrorPage($id, $params, $returnid,  $this->Lang('unable_write_index'));
			return false ;
		}
	}
}
/* Créer d'un fichier index.html vide - Début ******************************* */









/* Vider le dossier d'exportation - Début *********************************** */
public function DeleteCachePath()
{
	$cache_path = self::GetCachePath() ;
	@recursive_delete($cache_path) ;
}
/* Vider le dossier d'exportation - Fin ************************************* */









/* Récupérer la date de modification la plus récente - Début **************** */

public function GetMostRecentEdit ()
{
	
	$cache_path = self::GetCachePath() ;
	
	return @filemtime($cache_path);
	
}
	
/* Récupérer la date de modification la plus récente - Fin ****************** */









/* Vérifier le TimeOut - Début ********************************************** */

public function CheckTimeOut()
{
	
	$timeout = $this->GetPreference('timeout') ;
	if ($timeout == 0)
	{
		return -1 ;
	}
	$most_recent_edit	= self::GetMostRecentEdit() ;
	
	if (self::GetStatus() == true)
	{
		$timeoutleft = $timeout*60 - (time() - $most_recent_edit) ;
	}
	else
	{
		$timeoutleft = 0 ;
	}

	if($timeoutleft <= 0 AND self::GetStatus() == true)
	{
    self::SetStatus(false);
		self::DeleteCachePath();
    $this->Audit(0, $this->Lang('friendlyname'), $this->Lang('dev_mode_timedout'));
  }

	return $timeoutleft ;
	
}
	
/* Vérifier le TimeOut - Fin ************************************************ */









/* Réinitialiser le TimeOut - Début ***************************************** */

public function ResetTimeOut()
{
	
	$cache_path = self::GetCachePath() ;
	touch($cache_path);
	return true ;
	
}
	
/* Réinitialiser le TimeOut - Fin ******************************************* */









/* Traiter le nom du fichier - Début **************************************** */
public function escapeFilename($fname)
{
	/* Merci à Mathieu Muths - www.airelibre.fr */
	$fname = cms_htmlentities($fname, ENT_IGNORE) ;

	return strtr($fname, ":+/?\\", "-----") ;
}
/* Traiter le nom du fichier - Fin ****************************************** */









/* Traiter le nom du fichier - Début **************************************** */
public function escapeContent($content)
{
	return str_replace("\r\n", "\n", $content) ;
}
/* Traiter le nom du fichier - Fin ****************************************** */









}
?>