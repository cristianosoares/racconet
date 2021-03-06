<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		$data['title'] = $this->document->getTitle();

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');
		$data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		$data['name'] = $this->config->get('config_name');
                
                $data['contact'] = $this->url->link('information/contact');

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

		$data['text_home'] = $this->language->get('text_home');
		$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');
                $data['text_funcionamento'] = $this->language->get('text_funcionamento');
                $data['text_navProdutos']   =  $this->language->get('text_navProdutos');
                $data['text_navServicos']   =  $this->language->get('text_navServicos');
                $data['text_navInfoseg']    =  $this->language->get('text_navInfoseg');
                $data['text_navContato']    =  $this->language->get('text_navContato');
                $data['text_navQuemSomos']  =  $this->language->get('text_navQuemSomos');
                $data['text_navTrabalhe']   =  $this->language->get('text_navTrabalhe');
                $data['text_navRevendedor']   =  $this->language->get('text_navRevendedor');

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['register'] = $this->url->link('account/register', '', 'SSL');
		$data['login'] = $this->url->link('account/login', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$data['download'] = $this->url->link('account/download', '', 'SSL');
		$data['logout'] = $this->url->link('account/logout', '', 'SSL');
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		$data['contact'] = $this->url->link('information/contact');
                $data['work'] = $this->url->link('information/work-with-us');
                $data['dealer'] = $this->url->link('information/dealer');
                $data['infoseg'] = $this->url->link('information/infoseg');
                $data['about'] = $this->url->link('information/about-us');
                $data['services'] = $this->url->link('information/services');
                
		$data['telephone'] = $this->config->get('config_telephone');

		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}
                
                $data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
		}

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

		// For page specific css and header
		if (isset($this->request->get['route'])) {
                    
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
                        
                        // Carrega a header Interna
                        if ($this->request->get['route'] !='common/home'){
                            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header_inter.tpl')) {
                                return $this->load->view($this->config->get('config_template') . '/template/common/header_inter.tpl', $data);
                            } else {
                                    return $this->load->view('default/template/common/header_inter.tpl', $data);
                            }
                        }
                        else{
							$classes = 'col-md-3 col-sm-4 col-xs-6';
                            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
                                return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
                            } else {
                                    return $this->load->view('default/template/common/header.tpl', $data);
                            }
                        }
                        
		} else {
			$data['class'] = 'common-home';
                        
                        // Carrega a header default
                        
                        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
                            return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
                        } else {
                                return $this->load->view('default/template/common/header.tpl', $data);
                        }
		}

		
	}
}