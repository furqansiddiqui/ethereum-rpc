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

namespace EthereumRPC\Contracts\ERC20;

use EthereumRPC\Contracts\Contract;

/**
 * Class ERC20_Token
 * @package EthereumRPC\Contracts\ERC20
 */
class ERC20_Token extends Contract
{
    /**
     * @return string
     * @throws \EthereumRPC\Exception\ConnectionException
     * @throws \EthereumRPC\Exception\ContractABIException
     * @throws \EthereumRPC\Exception\GethException
     * @throws \Exception
     * @throws \HttpClient\Exception\HttpClientException
     */
    public function name(): string
    {
        return $this->call("name");
    }
}