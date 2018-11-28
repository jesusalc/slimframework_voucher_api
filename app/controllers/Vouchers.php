<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;
use App\Models\VoucherCodes;

class Vouchers {

    /**
     * @var VoucherCodes
     */
    private $voucher_code;

    public function __construct(VoucherCodes $voucher_code)
    {

        $this->voucher_code = $voucher_code;
    }

    public function showVouchers(ServerRequestInterface $request, Response $response, $args)
    {
        $email = $args['email'];
        $voucher_code = $this->voucher_code->findAllByEmail($email);
//        print_r($voucher_code);die();

        return $response->withJson($voucher_code);
    }
}