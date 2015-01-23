<?php
#-------------------------------------------------------------------------
# Module: Gallery
# Method: Install
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2008 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#-------------------------------------------------------------------------

if (!isset($gCms)) exit;


// setup directories and/or check if writable
$dirs = array( 'modules/Gallery/templates', 'modules/Gallery/templates/css', 'uploads/images', DEFAULT_GALLERY_PATH, DEFAULT_GALLERYTHUMBS_PATH);
foreach ( $dirs as $dir )
{
	if( !is_dir('../'.$dir) )
	{
		mkdir(str_replace('/', DIRECTORY_SEPARATOR, '../'.$dir));
	}
	if( !is_writable('../'.$dir) )
	{
		//return error to ModuleManager
		$tmp = lang('errordirectorynotwritable'). ' > ' . $dir;
		return $tmp;
	}
}


$db = $this->GetDb();

// mysql-specific, but ignored by other database
$taboptarray = array('mysql' => 'ENGINE=MyISAM');
$dict = NewDataDictionary($db);

// table schema description
$flds = "
	fileid I KEY AUTO,
	filename C(255),
	filepath C(255),
	filedate " . CMS_ADODB_DT . ",
	fileorder I,
	active I,
	defaultfile I,
	galleryid I,
	title C(255),
	comment X
";

$sqlarray = $dict->CreateTableSQL( cms_db_prefix()."module_gallery",
	$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$flds = "
	fileid I KEY,
	templateid I,
	hideparentlink I,
	feugroups C(255),
	editors C(255)
";

$sqlarray = $dict->CreateTableSQL( cms_db_prefix()."module_gallery_props",
	$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// maxlength -> properties
$flds = "
	fieldid I KEY AUTO,
	name C(255),
	type C(20),
	properties C(255),
	dirfield L,
	sortorder I,
	public L
";

$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_gallery_fielddefs",
	$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$flds = "
	fileid I KEY NOT NULL,
	fieldid I KEY NOT NULL,
	value X
";

$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_gallery_fieldvals",
	$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$flds = "
	templateid I KEY AUTO,
	template C(255),
  version C(20),
	about X,
	thumbwidth I,
	thumbheight I,
	resizemethod C(10),
	maxnumber I,
	sortitems C(255),
	visible I
";

$sqlarray = $dict->CreateTableSQL( cms_db_prefix()."module_gallery_templateprops",
	$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// create a permission
$this->CreatePermission('Use Gallery', 'Use Gallery');
$this->CreatePermission('Gallery - Add subgalleries', 'Gallery - Add subgalleries');
$this->CreatePermission('Gallery - Edit all galleries', 'Gallery - Edit all galleries');

// setup templates
$templates = array( 'AE-Gallery', 'Cycle', 'Fancybox', 'gallerytree', 'Lightbox', 'prettyPhoto', 'Slimbox');

foreach ( $templates as $template )
{
	$fn = dirname(__FILE__).DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'Gallery-tpl-'.$template.'.xml';
	if( file_exists( $fn ) )
	{
		$xml = @file_get_contents($fn);
		include 'function.importtemplate.php';
		if ( $template == 'prettyPhoto' )
		{
			$this->SetPreference('default_template_contents',$templatecode);
			$this->SetPreference('current_template',$template);
		}
	}
}

// create preferences
$this->SetPreference('singleimg_template', 'prettyPhoto');
$this->SetPreference('singleimg_template_html', '<a class="group" href="{$image->file|escape:\'url\'|replace:\'%2F\':\'/\'}" title="{$image->title}" rel="prettyPhoto"><img src="{$image->thumb|escape:\'url\'|replace:\'%2F\':\'/\'}" alt="{$image->title}" /></a>');
$this->SetPreference('urlprefix', 'gallery');
$this->SetPreference('allowed_extensions', 'jpg,jpeg,gif,png');
$this->SetPreference('maximagewidth', 800);
$this->SetPreference('maximageheight', 640);
$this->SetPreference('imagejpgquality', 80);
$this->SetPreference('thumbjpgquality', 80);
$this->SetPreference('use_permissions', false);
$this->SetPreference('newgalleries_active', true);
$this->SetPreference('use_comment_wysiwyg', false);
$this->SetPreference('editdirdates', false);
$this->SetPreference('editfiledates', false);
$this->SetPreference('fe_folderpath', 'modules/Gallery/images/folder.png');
$this->SetPreference('be_folderpath', 'modules/Gallery/images/foldersmall.png');

// register an event that the Gallery will issue.
// $this->CreateEvent( 'OnGalleryPreferenceChange' );

$this->AddEventHandler( 'Core', 'ContentPostRender', false );

// insert defaults
$query = "INSERT INTO " . cms_db_prefix() . "module_gallery (filename, filepath, filedate, fileorder, active, defaultfile, galleryid, title, comment) VALUES (?,?,?,-1,1,0,0,?,?)";
$db->Execute($query, array('', '', date("Y-m-d H:i:s", filemtime('../uploads/images/Gallery')), cms_html_entity_decode($this->Lang('friendlyname')), cms_html_entity_decode($this->Lang('defaultgallerycomment'))));
$query = "INSERT INTO " . cms_db_prefix() . "module_gallery_props (fileid,templateid,hideparentlink) VALUES (?,?,?)";
$db->Execute($query, array(1, 0, 1));

?>