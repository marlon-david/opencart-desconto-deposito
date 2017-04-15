<?php

class ControllerExtensionTotalDescontoDeposito extends Controller
{
	private $error = array();

	public function index() { 
		$this->document->setTitle('Desconto para depósito bancário');

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('desconto_deposito', $this->request->post);

			$this->session->data['success'] = 'Informações salvas com sucesso.';

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=total', true));
		}

		$data['heading_title'] = 'Desconto para depósito bancário';
		$data['text_edit'] = 'Editar módulo';

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], true),
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_total'),
			'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=total', true),
		);

		$data['breadcrumbs'][] = array(
			'text'      => $data['heading_title'],
			'href'      => $this->url->link('extension/total/desconto_deposito', 'token=' . $this->session->data['token'], true),
		);

		$data['action'] = $this->url->link('extension/total/desconto_deposito', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=total', true);

		if (isset($this->request->post['desconto_deposito_total'])) {
			$data['desconto_deposito_total'] = $this->request->post['desconto_deposito_total'];
		} else {
			$data['desconto_deposito_total'] = $this->config->get('desconto_deposito_total');
		}

		if (isset($this->request->post['desconto_deposito_valor'])) {
			$data['desconto_deposito_valor'] = $this->request->post['desconto_deposito_valor'];
		} else {
			$data['desconto_deposito_valor'] = $this->config->get('desconto_deposito_valor');
		}

		if (isset($this->request->post['desconto_deposito_shipping'])) {
			$data['desconto_deposito_shipping'] = $this->request->post['desconto_deposito_shipping'];
		} else {
			$data['desconto_deposito_shipping'] = $this->config->get('desconto_deposito_shipping'); 
		}

		if (isset($this->request->post['desconto_deposito_status'])) {
			$data['desconto_deposito_status'] = $this->request->post['desconto_deposito_status'];
		} else {
			$data['desconto_deposito_status'] = $this->config->get('desconto_deposito_status');
		}

		if (isset($this->request->post['desconto_deposito_sort_order'])) {
			$data['desconto_deposito_sort_order'] = $this->request->post['desconto_deposito_sort_order'];
		} else {
			$data['desconto_deposito_sort_order'] = $this->config->get('desconto_deposito_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/total/desconto_deposito', $data));
	}

	protected function validate()
	{
		if (!$this->user->hasPermission('modify', 'extension/total/desconto_deposito')) {
			$this->error['warning'] = 'Você não tem permissão para alterar este módulo';
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
