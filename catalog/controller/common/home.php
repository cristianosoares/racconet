<?php

class ControllerCommonHome extends Controller {

    public function index() {
        $this->document->setTitle($this->config->get('config_meta_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->setKeywords($this->config->get('config_meta_keyword'));

        if (isset($this->request->get['route'])) {
            $this->document->addLink(HTTP_SERVER, 'canonical');
        }
        $this->load->language('product/manufacturer');
        $this->load->language('common/home');

        $data['text_marca'] = $this->language->get('text_marcas');
        $data['text_all'] = $this->language->get('text_all');
        $data['text_category'] = $this->language->get('text_category');


        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');


        // Menu
        $this->load->model('catalog/category');

        $this->load->model('catalog/product');

        $data['categories'] = array();
        
        $categories = $this->model_catalog_category->getCategories(0);
       

        foreach ($categories as $category) {
                if ($category['top']) {
                        // Level 2
                        $children_data = array();

                        $children = $this->model_catalog_category->getCategories($category['category_id']);

                        foreach ($children as $child) {
                                $filter_data = array(
                                        'filter_category_id'  => $child['category_id'],
                                        'filter_sub_category' => true
                                );

                                $children_data[] = array(
                                        'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
                                        'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
                                );
                        }

                        // Level 1
                        $data['categories'][] = array(
                                'name'     => $category['name'],
                                'children' => $children_data,
                                'column'   => $category['column'] ? $category['column'] : 1,
                                'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
                        );
                }
        }
	
        $this->load->model('catalog/manufacturer');
        $data['categorias'] = array();
        $results = $this->model_catalog_manufacturer->getManufacturers();
        
        foreach ($results as $result) {
            if (is_numeric(utf8_substr($result['name'], 0, 1))) {
                $key = '0 - 9';
            } else {
                $key = utf8_substr(utf8_strtoupper($result['name']), 0, 1);
            }

            if (!isset($data['categorias'][$key])) {
                $data['categorias'][$key]['name'] = $key;
            }

            $data['categorias'][$key]['manufacturer'][] = array(
                'name' => $result['name'],
                'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id'])
            );
        }

        $this->load->model('catalog/product');

        $data['filter_groups'] = array();

        $data['filter_groups'] = $this->model_catalog_category->getAllCategoryFilters(2);


        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
        }
    }

}