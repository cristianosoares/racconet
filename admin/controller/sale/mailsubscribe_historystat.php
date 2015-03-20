<?php 
class ControllerSaleMailsubscribeHistoryStat extends Controller {
	public function	index(){
		$this->load->language('sale/mailsubscribe_historystat');
		
		$this->load->model('sale/mailsubscribe_historystat');
		
		$this->getList();
		
	}
	private function getList(){
		
		if (isset($this->request->get['filter_date'])) {
            $filter_date = $this->request->get['filter_date'];
        } else {
            $filter_date = NULL;
        }

        if (isset($this->request->get['filter_subject'])) {
            $filter_subject = $this->request->get['filter_subject'];
        } else {
            $filter_subject = NULL;
        }

        if (isset($this->request->get['filter_store'])) {
            $filter_store = $this->request->get['filter_store'];
        } else {
            $filter_store = NULL;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'history_id';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['filter_date'])) {
            $url .= '&filter_date=' . $this->request->get['filter_date'];
        }

        if (isset($this->request->get['filter_subject'])) {
            $url .= '&filter_subject=' . $this->request->get['filter_subject'];
        }

        if (isset($this->request->get['filter_store'])) {
            $url .= '&filter_store=' . $this->request->get['filter_store'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['heading_title'] = $this->language->get('heading_title');
				
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		
		$data['column_date'] = $this->language->get('column_date');
		$data['column_subject'] = $this->language->get('column_subject');
		$data['column_recipients'] = $this->language->get('column_recipients');
		$data['column_views'] = $this->language->get('column_views');
		$data['column_failed'] = $this->language->get('column_failed');
		$data['column_store'] = $this->language->get('column_store');
		$data['column_actions'] = $this->language->get('column_actions');
		
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_default'] = $this->language->get('text_default');
		
		$data['token'] = $this->session->data['token'];
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/mailsubscribe_historystat', 'token=' . $this->session->data['token'], 'SSL'),
   		);
		
		$data['delete'] = $this->url->link('sale/mailsubscribe_historystat/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$data2 = array(
            'filter_date'		=> $filter_date,
            'filter_subject'	=> $filter_subject,
            'filter_store'		=> $filter_store,
            'sort'				=> $sort,
            'order'				=> $order,
            'start'				=> ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'				=> $this->config->get('config_limit_admin')
        );
		
		$history_total = $this->model_sale_mailsubscribe_historystat->getHistoryTotal($data2);
		
		$results = $this->model_sale_mailsubscribe_historystat->getHistory($data2);
		
		$this->load->model('setting/store');
		
		$stores = $this->model_setting_store->getStores();
		
		$data['stores'] = $stores;
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $data['store_url'] = (defined('HTTPS_CATALOG') ? HTTPS_CATALOG : HTTP_CATALOG);
        } else {
            $data['store_url'] = HTTP_CATALOG;
        }
		$data['view_url'] =  'index.php?route=mailsubscribe/show&history_id=';

		$data['newsletter_history'] = array();
		
		foreach($results as $result){
			$data['newsletter_history'][] = array(
				'history_id' 	=> $result['history_id'],
				'datetime' 		=> $result['datetime'],
				'subject' 		=> $result['subject'],
				'recipients' 	=> ($result['queue'] == $result['recipients']) ? $result['recipients'] : sprintf($this->language->get('text_queued'), $result['queue'], $result['recipients']),
				'views' 		=> $result['views'],
				'failed' 		=> $result['failed'],
				'store_id' 		=> $result['store_id'],
				'selected' => isset($this->request->post['selected']) && is_array($this->request->post['selected']) && in_array($result['history_id'], $this->request->post['selected']),
				
				
				'text'		=> $this->language->get('text_details'),
				'href'		=> $this->url->link('sale/mailsubscribe_historystat/details', 'token=' . $this->session->data['token'].'&history_id='.$result['history_id'], 'SSL')
				
			);
		}
		$url = '';

        if (isset($this->request->get['filter_date'])) {
            $url .= '&filter_date=' . $this->request->get['filter_date'];
        }

        if (isset($this->request->get['filter_subject'])) {
            $url .= '&filter_subject=' . $this->request->get['filter_subject'];
        }

        if (isset($this->request->get['filter_store'])) {
            $url .= '&filter_store=' . $this->request->get['filter_store'];
        }

        if ($order == 'ASC') {
            $url .= '&order=' .  'DESC';
        } else {
            $url .= '&order=' .  'ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_date'] = $this->url->link('sale/mailsubscribe_historystat', 'token=' . $this->session->data['token'] . '&sort=mh.datetime' . $url, 'SSL');
        $data['sort_subject'] = $this->url->link('sale/mailsubscribe_historystat', 'token=' . $this->session->data['token'] . '&sort=mh.subject' . $url, 'SSL');
        $data['sort_recipients'] = $this->url->link('sale/mailsubscribe_historystat', 'token=' . $this->session->data['token'] . '&sort=ms.queue' . $url, 'SSL');
        $data['sort_views'] = $this->url->link('sale/mailsubscribe_historystat', 'token=' . $this->session->data['token'] . '&sort=ms.views' . $url, 'SSL');
        $data['sort_failed'] = $this->url->link('sale/mailsubscribe_historystat', 'token=' . $this->session->data['token'] . '&sort=ms.failed' . $url, 'SSL');
		$data['sort_store'] = $this->url->link('sale/mailsubscribe_historystat', 'token=' . $this->session->data['token'] . '&sort=mh.store_id' . $url, 'SSL');
        $url = '';

        if (isset($this->request->get['filter_date'])) {
            $url .= '&filter_date=' . $this->request->get['filter_date'];
        }

        if (isset($this->request->get['filter_subject'])) {
            $url .= '&filter_subject=' . $this->request->get['filter_subject'];
        }

        if (isset($this->request->get['filter_store'])) {
            $url .= '&filter_store=' . $this->request->get['filter_store'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }
		

		$pagination = new Pagination();
        $pagination->total = $history_total;
		$pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('sale/mailsubscribe_historystat', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();
		
		$data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($history_total - $this->config->get('config_limit_admin'))) ? $history_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $history_total, ceil($history_total / $this->config->get('config_limit_admin')));
		
		$data['filter_date'] = $filter_date;
        $data['filter_subject'] = $filter_subject;
        $data['filter_store'] = $filter_store;

        $data['sort'] = $sort;
        $data['order'] = $order;
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/mailsubscribe_historystat.tpl', $data));		
		
	}
	public function delete(){
		$this->load->language('sale/mailsubscribe_historystat');
		
		$this->load->model('sale/mailsubscribe_historystat');
		
		if (isset($this->request->post['selected']) && ($this->validateDelete())) {
			foreach ($this->request->post['selected'] as $history_id) {
				$this->model_sale_mailsubscribe_historystat->deleteHistory($history_id);
             	 
			}
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['filter_date'])) {
				$url .= '&filter_date=' . $this->request->get['filter_date'];
			}
	
			if (isset($this->request->get['filter_subject'])) {
				$url .= '&filter_subject=' . $this->request->get['filter_subject'];
			}
	
			if (isset($this->request->get['filter_store'])) {
				$url .= '&filter_store=' . $this->request->get['filter_store'];
			}
	
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
	
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			$this->response->redirect($this->url->link('sale/mailsubscribe_historystat', 'token=' . $this->session->data['token']. $url, 'SSL'));
    	}
		$this->getList();	
	}
	protected function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'sale/mailsubscribe_historystat')) {
			$this->error['warning'] = $this->language->get('error_permission');
    	}

		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
}
?>