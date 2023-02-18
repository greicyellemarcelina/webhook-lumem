<?php

namespace App\Services;

use App\Models\Company;

class BKOMessage
{
    const BKO_URL = "your_url";
    private TypeFormService $typeForm;

    public function __construct(TypeFormService $typeForm)
    {
        $this->typeForm = $typeForm;
    }

    public function toString() {
        $cause = implode(",",$this->typeForm->getCause());

        $text = <<<EOT
Motivo: $cause
Nota: {$this->typeForm->getRecommendationNote()}
Comentário: {$this->typeForm->getComment()}
Pedido: {$this->getOrderUrl()}
Parceiro: {$this->getCompanyName()}
Motorista: {$this->getDriverUrl()}
Rota: {$this->getRouteUrl()}
EOT;

    return $text;

    }
    private function getUrl($path) {
        return  self::BKO_URL . $path;
    }

    private function getOrderUrl() {
        return $this->getUrl("your_order_url");
    }

    private function getDriverUrl() {
        return $this->getUrl("your_driver_url");
    }


    private function getRouteUrl() {
        return $this->getUrl("ryour_route_url");
    }

    private function getCompanyName() {
        $company = Company::find($this->typeForm->getCompany());
        if ($company) {
            return $company->name;
        }

        return "Partner not found";
    

    }
}
