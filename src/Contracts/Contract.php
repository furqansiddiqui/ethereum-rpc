<?php
/**
 * This file is a part of "furqansiddiqui/ethereum-rpc" package.
 * https://github.com/furqansiddiqui/ethereum-rpc
 *
 * Copyright (c) 2018 Furqan A. Siddiqui <hello@furqansiddiqui.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code or visit following link:
 * https://github.com/furqansiddiqui/ethereum-rpc/blob/master/LICENSE
 */

declare(strict_types=1);

namespace EthereumRPC\Contracts;

use EthereumRPC\EthereumRPC;
use EthereumRPC\Exception\ContractsException;
use EthereumRPC\Validator;

/**
 * Class Contract
 * @package EthereumRPC\Contracts
 */
class Contract
{
    /** @var EthereumRPC */
    private $client;
    /** @var ABI */
    private $abi;
    /** @var string */
    private $address;

    /**
     * Contract constructor.
     * @param EthereumRPC $client
     * @param ABI $abi
     * @param string $addr
     * @throws ContractsException
     */
    public function __construct(EthereumRPC $client, ABI $abi, string $addr)
    {
        if (!Validator::Address($addr)) {
            throw new ContractsException('Invalid contract Ethereum address');
        }

        $this->client = $client;
        $this->abi = $abi;
        $this->address = $addr;
    }
}