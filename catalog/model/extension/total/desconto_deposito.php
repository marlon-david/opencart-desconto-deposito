<?php

class ModelExtensionTotalDescontoDeposito extends Model {
	public function getTotal($total) {
		if (isset($this->session->data['payment_method']['code'])) {
			$payment_code = $this->session->data['payment_method']['code'];
		} else {
			$payment_code = '';
		}

		if ($payment_code
			&& $payment_code == 'bank_transfer'
			&& ($this->cart->getSubTotal() >= $this->config->get('desconto_deposito_total'))
			&& ($this->cart->getSubTotal() > 0)) {

			$desconto = (float)$this->config->get('desconto_deposito_valor');

			if ($desconto > 0) {
				$frete = 0;

				if ($this->config->get('desconto_deposito_shipping')) {
					if (!empty($this->session->data['shipping_method']['cost'])) {
						$frete = $this->session->data['shipping_method']['cost'];
					}
				}

				$valor = ($this->cart->getTotal() + $frete) * ($desconto / 100);
				$valor = 0 - $valor;

				$total['totals'][] = array( 
					'code'       => 'desconto_deposito',
					'title'      => 'Desconto ' . $desconto . '%',
					'value'      => $valor,
					'sort_order' => $this->config->get('desconto_deposito_sort_order')
				);

				$total['total'] += $valor;
			}
		}
	}
}
