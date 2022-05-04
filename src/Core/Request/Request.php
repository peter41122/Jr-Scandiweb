<?php
namespace Highpoint\Core\Request;

use Highpoint\Core\Request\contracts\RequestInterface;

final class Request implements RequestInterface
{
    public function __construct()
    {
        $this->setProperty();
    }

    private function setProperty()
    {
        $inputs = json_decode(file_get_contents("php://input"),true);
        if ( $inputs && is_array($inputs) ) {
            foreach( $inputs as $key => $input) {
                $this->{$key} = $input;
            }
        }
    }
}