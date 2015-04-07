<?php
class ControllerModuleCategory extends Controller {
	public function index() {
		$this->load->language('module/category');

		$data['heading_title'] = $this->language->get('heading_title');
                
                //link do mini banner estatico
                $data['epis'] = $this->url->link('information/technical-information-epis');

		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['category_id'] = $parts[0];
		} else {
			$data['category_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}
                
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();
		
		if (isset($this->request->get['route'])) { 
			if ($this->request->get['route'] !='common/home'){
				$classes = '';
			}
			else{
				$classes = 'col-md-3 col-sm-4 col-xs-6';
			}
		  } else {
				$classes = 'col-md-3 col-sm-4 col-xs-6';
		  }
		$data['class'] = $classes;

		$categories = $this->model_catalog_category->getCategories(0);
                
                if (isset($this->request->get['route'])) { 
                    if ($this->request->get['route'] !='common/home'){
                        $classes = '';
                    }
                    else{
                        $classes = 'col-md-3 col-sm-4 col-xs-6';
                    }
                  } else {
                        $classes = 'col-md-3 col-sm-4 col-xs-6';
                  }
                $data['class'] = $classes;    
		
                foreach ($categories as $category) {
			$children_data = array();

			if ($category['category_id'] == $data['category_id']) {
				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach($children as $child) {
					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);

					$children_data[] = array(
						'category_id' => $child['category_id'], 
						'name' => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''), 
						'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}
			}

			$filter_data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true
			);

			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
				'children'    => $children_data,
                                'category'    => $category['name'],
				'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/category.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/category.tpl', $data);
		} else {
			return $this->load->view('default/template/module/category.tpl', $data);
		}
	}
}
