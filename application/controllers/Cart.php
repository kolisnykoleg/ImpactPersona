<?php

class Cart extends CI_Controller
{
    private function update($assessments, $currency)
    {
        $assessments = array_map(function ($assessment) use ($currency) {
            if (!isset($assessment->Price)) {
                $assessment->Price = $assessment->{$currency};
                unset(
                    $assessment->Price_AUD,
                    $assessment->Price_USD
                );
            }
            return $assessment;
        }, $assessments);

        $total = $this->total($assessments);

        $this->session->set_userdata('cart', [
            'assessments' => $assessments,
            'total' => $total,
        ]);
    }

    private function total($assessments)
    {
        $sum = array_reduce($assessments, function ($total, $assessment) {
            return $total + $assessment->Price;
        }, 0);
        return is_float($sum)
            ? number_format($sum, 2)
            : $sum;
    }

    public function get()
    {
        if (!$this->session->has_userdata('cart')) {
            $this->update([], 'Price_USD');
        }
        echo "<div class='ph-m'>";
        foreach ($this->session->cart['assessments'] as $assessment) {
            echo
            "<div class='Cart-item pb-s'>
                <h3 class='g'><span>$assessment->Name</span><button data-id='$assessment->ID' class='cart-delete'>Delete</button><span class='Cart-itemPrice'>$assessment->Price</span></h3>
                <p>$assessment->Description_Short</p>
            </div>";
        }
        $total = $this->session->cart['total'];
        echo "</div><div class='Cart-summary pv-xs ph-m'>Sub total: <b>$<span id='cartTotal'>$total</span></b></div>";
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $assessments = $this->session->cart['assessments'];
        foreach ($assessments as $i => $assessment) {
            if ($assessment->ID == $id) {
                unset($assessments[$i]);
                break;
            }
        }
        $assessments = array_values($assessments);

        $total = $this->total($assessments);

        $this->session->set_userdata('cart', [
            'assessments' => $assessments,
            'total' => $total,
        ]);
    }

    public function currency()
    {
        $currency = $this->input->post('country') == 'AU'
            ? 'Price_AUD'
            : 'Price_USD';

        $this->update($this->session->cart['assessments'], $currency);
    }

    public function add($url = null)
    {
        $assessment = $this->assessment->get_by_url($url);
        if (isset($assessment) && $assessment->Active_Status) {
            $this->update(array_merge($this->session->cart['assessments'], [$assessment]), 'Price_USD');
        }
        redirect('/');
    }
}
