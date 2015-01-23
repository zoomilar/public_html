<?php

/**
 * Tools for Extended Content Blocks CMS Made Simple module 
 *
 * @author @kuzmany
 */
class ecb_tools {

    private $block_name = '';
    private $value = '';
    private $adding = false;
    private $options = array();
    private $alias = '';
    private $field = '';
    private $txt = '';
    private $is_color_picker_lib_load = false;
    private $is_datepicker_lib_load = false;

    /**
     *
     * @param stribng $blockName
     * @param string $value
     * @param array $params
     * @param boolean $adding 
     */
    public function __construct($blockName, $value, $params, $adding) {

        $this->block_name = $blockName;
        $this->alias = munge_string_to_url($blockName, true);
        $this->value = $value;
        $this->adding = $adding;

        $this->get_extra_options($params);

        if ($adding == true && isSet($this->options["default_value"]) && empty($value) == true)
            $this->value = $params["default_value"];
    }

    /**
     *  get content block
     * @return string 
     */
    public function get_content_block_input() {
        $function = 'get_' . $this->field;
        return $this->$function();
    }

    /**
     *
     * @return string 
     */
    private function get_textarea() {
        $tmp = '<textarea name="%s" rows="%d" cols="%d">%s</textarea>';
        return sprintf($tmp, $this->block_name, $this->options["rows"], $this->options["cols"], $this->value);
    }

    /**
     *
     * @return string 
     */
    private function get_pages() {
        $contentops = cmsms()->GetContentOperations();        
        return $contentops->CreateHierarchyDropdown('', $this->value, $this->block_name, 1, 1);
    }

    /**
     *
     * @return string 
     */
    private function get_editor() {
        $mod = cms_utils::get_module('ECB');
        return $mod->CreateTextArea(true, '', $this->value, $this->block_name, '', '', '', '', $this->options["cols"], $this->options["rows"]);
    }

    /**
     *
     * @return string 
     */
    private function get_input() {
        $tmp = '<input type="text" name="%s" size="%d" maxlength="%d" value="%s"/>';
        return sprintf($tmp, $this->block_name, $this->options["size"], $this->options["max_length"], $this->value);
    }

    /**
     *
     * @return string 
     */
    private function get_timepicker() {
        $tmp = $this->get_datepicker_lib();
        $tmp .= '<input type="text" class="timepicker"  name="%s" size="%d" maxlength="%d" value="%s"/>';
        return sprintf($tmp, $this->block_name, $this->options["size"], $this->options["max_length"], $this->value);
    }

    /**
     *
     * @return string 
     */
    private function get_datepicker() {
        $tmp = $this->get_datepicker_lib();
        $tmp .= '<input type="text" class="datepicker"  name="%s" size="%d" maxlength="%d" value="%s"/>';
        return sprintf($tmp, $this->block_name, $this->options["size"], $this->options["max_length"], $this->value);
    }

    private function get_datepicker_lib() {
        if ($this->is_datepicker_lib_load)
            return;
        $mod = cms_utils::get_module('ECB');
        $config = cmsms()->GetConfig();
        $tmp = "
        <script language=\"javascript\" field=\"text/javascript\" src=\"" . $config["root_url"] . "/modules/" . $mod->GetName() . "/lib/js/jquery-ui-timepicker-addon.js\"></script>
        <script type=\"text/javascript\">
		$(function() {
			$('.datepicker')." . (isset($this->options["time"]) ? 'datetimepicker' : 'datepicker' ) . " ({
				" . (isset($this->options["date_format"]) ? "dateFormat: '" . $this->options["date_format"] . "'" : "") . ",				
                                " . (isset($this->options["time_format"]) ? "timeFormat: '" . $this->options["time_format"] . "'" : "") . ",				
				showOtherMonths: true,
				selectOtherMonths: true
			});
			$('.timepicker').timepicker ({
				timeFormat: '" . $this->options["time_format"] . "'				
			});

		});
</script>";
        $this->is_datepicker_lib_load = true;
        return $tmp;
    }

    /**
     *
     * @return string 
     */
    private function get_color_picker() {

        $txt = '';
        $first = cms_utils::get_app_data(__FUNCTION__);
        $config = cmsms()->GetConfig();
        $mod = cms_utils::get_module('ECB');
        if (!$first){
            $txt.= '<script language="javascript" field="text/javascript" src="' . $config["root_url"] . '/modules/' . $mod->GetName() . '/lib/js/mColorPicker.min.js"></script>';
            $txt.= '<script>
$.fn.mColorPicker.defaults.imageFolder = " '. $config["root_url"] . '/modules/' . $mod->GetName() . '/lib/js/images/";
</script>';
        }

        $tmp = '<input  type="color" data-hex="true" name="%s" id="%s" size="' . $this->options["size"] . '" value="%s"/>';
        $txt .= sprintf($tmp, $this->block_name, $this->alias, $this->value);

        cms_utils::set_app_data(__FUNCTION__, 1);

        return $txt;
    }

    /**
     *
     * @return string 
     */
    private function get_checkbox() {

        $mod = cms_utils::get_module('ECB');
        return $mod->CreateInputHidden('', $this->block_name, 0) . $mod->CreateInputCheckbox('', $this->block_name, 1, $this->value);
    }

    /**
     *
     * @return string 
     */
    private function get_file_selector() {

        $mod = cms_utils::get_module('ECB');
        $config = cmsms()->GetConfig();
        // 1.  Get the directory contents
        $adddir = get_site_preference('contentimage_path');
        if ($this->options['dir'])
            $adddir = $this->options['dir'];


        $dir = cms_join_path($config['uploads_path'], $adddir);
        $filetypes = $this->options['filetypes'];
        if ($filetypes != '') {
            $filetypes = explode(',', $filetypes);
            for ($i = 0; $i < count($filetypes); $i++) {
                $filetypes[$i] = '*.' . $filetypes[$i];
            }
        }
        $excludes = $this->options['excludeprefix'];
        if ($excludes != '') {
            $excludes = explode(',', $excludes);
            for ($i = 0; $i < count($excludes); $i++) {
                $excludes[$i] = $excludes[$i] . '*';
            }
        }
        $fl = cge_dir::recursive_glob($dir, $filetypes, 'FILES', $excludes, $this->options['recurse']);

        // 2.  Remove prefix
        for ($i = 0; $i < count($fl); $i++) {
            $fl[$i] = str_replace($dir, '', $fl[$i]);
        }

        // 2.  Sort
        if (is_array($fl) && $this->options['sortfiles']) {
            sort($fl);
        }

        $opts = array();
        $url_prefix = $adddir;
        for ($i = 0; $i < count($fl); $i++) {
            $opts[$fl[$i]] = $url_prefix . $fl[$i];
        }
        $opts = array('' => '') + $opts;

        $default_content_id = ContentOperations::get_instance()->GetDefaultContent();
        $parms = array();
        $parms = $this->options;
        $parms['field'] = 'file_selector';
        $parms['block_name'] = $this->block_name;
        $parms['value'] = $this->value;
        $parms['adding'] = $this->adding;
        $parms['showtemplate'] = 'false';
        $refresh_url = $mod->Createlink('cntnt01', 'refresh', $default_content_id, '', $parms, '', true);
        $refresh = '<a href="' . $refresh_url . '&showtemplate=false" class="file_selector_refresh">
<img src="../modules/' . $mod->GetName() . '/icons/ajax-refresh-icon.gif" alt="' . $mod->Lang('refresh') . '">            
</a>';

        $script = '';
        if (!cms_utils::get_app_data(__FUNCTION__)) {
            $script = "
                <script>
$(document).ready(function(){
$('.file_selector_refresh').live('click', function(){
 var url = $(this).attr('href');
 $(this).prev().css('opacity',0.3);
 $(this).parent().parent().load(url, '', function(html){            
});
return false;
})

$('.file_selector_select select').change(function(){
var imgtag = $(this).parent().next();
imgtag.attr('src', imgtag.data('uploadsurl')+'/'+$(this).val());
})
})              
</script>
";

            cms_utils::set_app_data(__FUNCTION__, 1);
        }

        $preview = '';
        if ($this->options['preview']) {
            if ($this->value)
                $preview = '<img style"max-width:200px;" class="file_selector_preview" data-uploadsurl="' . $config["uploads_url"] . '"   src="' . $config["uploads_url"] . '/' . $this->value . '" alt="">';
            else
                $preview = '<img style"max-width:200px;" class="file_selector_preview" alt="" data-uploadsurl="' . $config["uploads_url"] . '">';
        }




        return '<div class="file_selector_select">' . $mod->CreateInputDropdown('', $this->block_name, $opts, -1, $this->value) . $refresh . $script . '</div>' . $preview;
    }

    /**
     *
     * @return string 
     */
    private function get_text() {

        if (!$this->options["text"])
            return;
        return $this->options["text"];
    }

    /**
     *
     * @return string 
     */
    private function get_hr() {
        return '<hr style="display:block; border:0 none; background:#ccc;" />';
    }

    /**
     *
     * @return string 
     */
    private function get_link() {

        if (!$this->options["link"] || !$this->options["text"])
            return;

        $mod = cms_utils::get_module('ECB');
        return '<a target="' . $this->options["target"] . '" href="' . $this->options["link"] . '">' . $this->options["text"] . '</a>';
    }

    /**
     *
     * @return string 
     */
    private function get_module_link() {
        if (!$this->options["mod"] || !$this->options["text"])
            return;

        $mod = cms_utils::get_module($this->options["mod"]);

        if (!is_object($mod))
            return;

        $userid = get_userid();
        $userops = cmsms()->GetUserOperations();
        $adminuser = $userops->UserInGroup($userid, 1);

        return $mod->CreateLink('', 'defaultadmin', '', $this->options["text"], array(), '', false, 0, 'target="' . $this->options["target"] . '"')
                .
                ($this->options["default_value"] ? '<br /><input id="mt_' . $this->block_name . '" ' . ( $adminuser ? 'type="text"' : 'type="hidden"') . ' name="' . $this->block_name . '" value="' . ($this->value ? $this->value : $this->options["default_value"]) . '"/>' : '');
    }

    /**
     * DEPRECATED
     * @return string 
     */
    private function get_dropdown_from_module() {
        if (!$this->options["mod"])
            return;

        $mod = cms_utils::get_module('ECB');
        $data = $mod->ProcessTemplateFromData('{' . $this->options["mod"] . '}');

        $options = array();
        $optionsarray = explode(',', $data);
        if (empty($optionsarray))
            return;

        foreach ($optionsarray as $option) {
            $key_val = explode('=', $option);
            $options[$key_val[0]] = $key_val[1];
        }
        if (empty($this->options['default_value']) == false)
            $options = array($this->options['default_value'] => '') + $options;

        return $mod->CreateInputDropdown('', $this->block_name, $options, -1, $this->value);
    }

    /**
     *
     * @return string 
     */
    private function get_dropdown() {
        if (!$this->options["values"])
            return;
        $mod = cms_utils::get_module('ECB');
        $smarty = cmsms()->GetSmarty();

        $options = array();

        $optionsarray = explode(',', $this->options["values"]);
        if (empty($optionsarray))
            return;

        foreach ($optionsarray as $option) {
            $key_val = explode('=', $option);
            $options[$key_val[0]] = $key_val[1];
        }
        if (empty($this->options['first_value']) == false)
            $options = array($this->options['first_value'] => '') + $options;

        if ($this->options['multiple']) {
            $selecteditems = explode(',', $this->value);
            $script = '';
            if (!cms_utils::get_app_data(__FUNCTION__)) {
                $script = "
                <script>
$(document).ready(function(){
$('.ecb_mutliple_select select').change(function(){
$(this).prev().val(($(this).val().join(','))); 
})              
})              
</script>
";
                cms_utils::set_app_data(__FUNCTION__, 1);
            }

            return $script . '<div class="ecb_mutliple_select">' . $mod->CreateInputHidden('', $this->block_name, $this->value) . $mod->CreateInputSelectList('', $this->block_name . '_tmp', $options, $selecteditems, $this->options["size"]) . '</div>';
        } else {

            return $mod->CreateInputDropdown('', $this->block_name, $options, -1, $this->value);
        }
    }

    /**
     *
     * @return string 
     */
    private function get_dropdown_from_udt() {
        if (!$this->options["udt"])
            return;
        $mod = cms_utils::get_module('ECB');
        $smarty = cmsms()->GetSmarty();

        $tmp = array();
        $options = UserTagOperations::get_instance()->CallUserTag($this->options["udt"], $tmp);

        if (empty($this->options['first_value']) == false)
            $options = array($this->options['first_value'] => '') + $options;

        if ($this->options['multiple']) {
            $selecteditems = explode(',', $this->value);
            $script = '';
            if (!cms_utils::get_app_data(__FUNCTION__)) {
                $script = "
                <script>
$(document).ready(function(){
$('.ecb_mutliple_select_udt select').change(function(){
$(this).prev().val(($(this).val().join(','))); 
})              
})              
</script>
";
                cms_utils::set_app_data(__FUNCTION__, 1);
            }

            return $script . '<div class="ecb_mutliple_select_udt">' . $mod->CreateInputHidden('', $this->block_name, $this->value) . $mod->CreateInputSelectList('', $this->block_name . '_tmp', $options, $selecteditems, $this->options["size"]) . '</div>';
        } else {

            return $mod->CreateInputDropdown('', $this->block_name, $options, -1, $this->value);
        }
    }

    /**
     *
     * @return string 
     */
    private function get_module() {

        $modops = cmsms()->GetModuleOperations();
        $modules = $modops->GetInstalledModules();
        $modulesarray = array();
        foreach ($modules as $module) {
            $mod = cms_utils::get_module($module);
            if (is_object($mod))
                $modulesarray[$mod->GetName()] = $module;
        }

        $mod = cms_utils::get_module('ECB');
        return $mod->CreateInputDropdown('', $this->block_name, $modulesarray, -1, $this->value);
    }

    private function get_extra_options(array $params) {

        if (!isSet($params["field"]))
            return;

        $options = array();
        $default_options = array();
        switch (strtolower($params["field"])) {
            case "color_picker":
                $default_options["size"] = 10;
                $default_options["default_value"] = '';
                break;
            case "module_link":
                $default_options["mod"] = '';
                $default_options["text"] = '';
                $default_options["target"] = '_self';
                $default_options["default_value"] = '_self';
                break;
            case "link":
                $default_options["text"] = '';
                $default_options["target"] = '_self';
                $default_options["link"] = '';
                break;
            case "module":
                $default_options["default_value"] = '';
                $default_options["text"] = '';
                $default_options["link"] = '';
                break;
            case "dropdown_from_module":
                $default_options["mod"] = '';
                $default_options["default_value"] = '';
                $default_options["first_value"] = '';
                break;
            case "file_selector":
                $default_options["filetypes"] = '';
                $default_options["excludeprefix"] = '';
                $default_options["recurse"] = '';
                $default_options["sortfiles"] = '';
                $default_options["dir"] = '';
                $default_options["preview"] = '';
            case "dropdown":
                $default_options["size"] = 5;
                $default_options["multiple"] = '';
                $default_options["values"] = '';
                $default_options["default_value"] = '';
                $default_options["first_value"] = '';
            case "dropdown_from_udt":
                $default_options["size"] = 5;
                $default_options["multiple"] = '';
                $default_options["values"] = '';
                $default_options["default_value"] = '';
                $default_options["first_value"] = '';
                $default_options["udt"] = '';
            case "textarea":
                $default_options["default_value"] = '';
                $default_options["rows"] = 20;
                $default_options["cols"] = 80;
            case "editor":
                $default_options["default_value"] = '';
                $default_options["rows"] = 20;
                $default_options["cols"] = 80;
                break;
            case "input":
                $default_options["default_value"] = '';
                $default_options["size"] = 30;
                $default_options["max_length"] = 255;
                break;
            case "text":
                $default_options["text"] = '';
                $default_options["execute"] = '';
                break;
            case "pages":
                $default_options["default_value"] = '';
                break;
            case "checkbox":
                $default_options["default_value"] = '';
                break;

            case "hr":
            case "image_picker":
            case 'timepicker':
                $default_options["size"] = 10;
                $default_options["max_length"] = 10;
                $default_options["time_format"] = 'HH:mm';
                break;
            case 'datepicker':
                $default_options["size"] = 20;
                $default_options["max_length"] = 20;
                $default_options["date_format"] = 'yy-mm-dd';
                $default_options["time_format"] = 'HH:mm';
                $default_options["time"] = '';
                break;
        }

        $this->field = $params["field"];

        if (empty($params) == false) {
            foreach ($params as $key => $param) {
                if (isSet($default_options[$key]) && empty($param) == false)
                    $default_options[$key] = $param;
            }
        }


        $this->options = $default_options;
    }

}

?>
