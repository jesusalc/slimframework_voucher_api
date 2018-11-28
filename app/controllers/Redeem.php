<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;
use App\Models\VoucherCodes;

class Redeem {

    /**
     * @var VoucherCodes
     */
    private $voucher_code;

    public function __construct(VoucherCodes $voucher_code)
    {

        $this->voucher_code = $voucher_code;
    }

    public function validateVoucher(ServerRequestInterface $request, Response $response, $args)
    {
        $voucher = $args['voucher_code'];
        $email = $args['email'];
        $voucher_code = $this->voucher_code->validateVoucherCode($voucher);

        return $response->withJson($voucher_code);
    }
}