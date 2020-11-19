<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Breadcrumb {

	private $breadcrumbs = array();
	
	function __construct() { }

	function add($title, $href){		
		if (!$title OR !$href) return;
		$this->breadcrumbs[] = array('title' => $title, 'href' => $href);
	}
	
	function render()
	{
		$output = '';
		$count = count($this->breadcrumbs)-1;
		foreach($this->breadcrumbs as $index => $breadcrumb){
		
			if($index == $count){
				$output .= '<li class="breadcrumb-item">';
				$output .= $breadcrumb['title'];
				$output .= '</li>';
			}else{
				$output .= '<li class="breadcrumb-item">';
				$output .= '<a class="text-muted" href="'.$breadcrumb['href'].'">';
				$output .= $breadcrumb['title'];
				$output .= '</a>';
				$output .= '</li>';
			}
			
		}	

		return $output;
	}

}