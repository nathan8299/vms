<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Channels_package extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Channels_package_model');
    } 

    /*
     * Listing of channels_packages
     */
    function index()
    {
        $data['channels_packages'] = $this->Channels_package_model->get_all_channels_packages();
        
        $data['_view'] = 'channels_package/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new channels_package
     */
    function add($chid, $pkgid)
    {   
        $this->Channels_package_model->add($chid, $pkgid);
        redirect('channel');
    }  

    function rm($chid, $pkgid)
    {
        $this->Channels_package_model->rm($chid, $pkgid);
        redirect('channel');
    }

    
}