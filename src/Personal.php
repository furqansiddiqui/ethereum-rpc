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

namespace EthereumRPC;

use EthereumRPC\Exception\GethException;
use HttpClient\Response\JSONResponse;

/**
 * Class Personal
 * @package EthereumRPC
 */
class Personal
{
    /** @var EthereumRPC */
    private $client;

    /**
     * Personal constructor.
     * @param EthereumRPC $ethereum
     */
    public function __construct(EthereumRPC $ethereum)
    {
        $this->client = $ethereum;
    }

    /**
     * @param string $command
     * @param array|null $params
     * @return JSONResponse
     * @throws Exception\ConnectionException
     * @throws GethException
     * @throws \HttpClient\Exception\HttpClientException
     */
    private function accountsRPC(string $command, ?array $params = null): JSONResponse
    {
        return $this->client->jsonRPC($command, null, $params);
    }

    /**
     * @return array
     * @throws Exception\ConnectionException
     * @throws GethException
     * @throws \HttpClient\Exception\HttpClientException
     */
    public function getList(): array
    {
        $request = $this->accountsRPC("eth_accounts");
        $list = $request->get("result");
        if (!is_array($list)) {
            throw GethException::unexpectedResultType("eth_accounts", "array", gettype($list));
        }

        return $list;
    }
}