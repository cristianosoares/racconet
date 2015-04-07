<?php
class ControllerInformationTechnicalInformationEpis extends Controller {
	public function index() {
		$this->load->language('information/technical-information-epis');
                
                if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
                
                $data['dominio'] = $server . 'catalog/view/theme/default/image/';
                
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
                
                $data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_information_epis'),
			'href' => $this->url->link('information/technical-information-epis')
		);

                $data['footer'] = $this->load->controller('common/footer');
                $data['header'] = $this->load->controller('common/header');

                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/technical-information-epis.tpl')) {
                        $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/technical-information-epis.tpl', $data));
                } else {
                        $this->response->setOutput($this->load->view('default/template/information/technical-information-epis.tpl', $data));
                }
        }
}