<?php

if(!class_exists('ACFF')):

class ACFF{
    
    // Version
    var $acff_version = '0.1';
    
    // ACF
    var $acf = false;

    function __construct(){
        
        $path = apply_filters('acff/path', plugin_dir_path(__FILE__) . 'acf/');
        $url = apply_filters('acff/url', plugin_dir_url(__FILE__).'acf/');
    
        // Constants
        $this->define('ACFF_PATH',          plugin_dir_path(__FILE__));
        $this->define('ACFF_DIR',           plugin_dir_path(__DIR__));
        
        $this->define('ACFF_ACF_PATH',      $path);
        $this->define('ACFF_ACF_URL',       $url);
        $this->define('ACFF_ACF_FILE',      ACFF_ACF_PATH.'acf.php');
        
        $this->define('ACFF_ACF_PRO_PATH',  plugin_dir_path(__FILE__) . 'acf-pro/');
        $this->define('ACFF_ACF_PRO_URL',   plugin_dir_url(__FILE__).'acf-pro/');
        $this->define('ACFF_ACF_PRO_FILE',  ACFF_ACF_PRO_PATH.'acf.php');
    
        if(!$this->has_acf()){
            
            
            $show_admin = (bool) apply_filters('acff/show_admin', false);
            
            // Hide admin
            if(!$show_admin){
    
                add_filter('acf/settings/show_admin', '__return_false');
                
            }
            
            // ACF Pro
            if(file_exists(ACFF_ACF_PRO_FILE)){
    
                include_once(ACFF_ACF_PRO_FILE);
    
                add_filter('acf/settings/url', function(){
                    return ACFF_ACF_PRO_URL;
                });
                
            // ACF Free
            }else{
    
                include_once(ACFF_ACF_FILE);
    
                add_filter('acf/settings/url', function(){
                    return ACFF_ACF_URL;
                });
                
                
            }
        
        }
    
        add_filter('acf/settings/load_json', array($this, 'load_json'));
        
    }
    
    function load_json($paths){
        
        if(is_dir(ACFF_DIR.'acf-json/')){
    
            $paths[] = ACFF_DIR.'acf-json/';
            
        }
        
        if(is_dir(ACFF_PATH.'acf-json/')){
    
            $paths[] = ACFF_PATH.'acf-json/';
            
        }
        
        
        return $paths;
        
    }
    
    function define($name, $value = true){
        
        if(!defined($name))
            define($name, $value);
        
    }
    
    function has_acf(){
        
        if($this->acf)
            return true;
        
        $this->acf = class_exists('ACF');
        
        return $this->acf;
        
    }
    
}

new ACFF();

endif;