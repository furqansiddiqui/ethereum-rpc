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

/**
 * Class Eth
 * @package EthereumRPC
 */
class Eth
{
    /** @var EthereumRPC */
    private $client;

    /**
     * Eth constructor.
     * @param EthereumRPC $ethereumRPC
     */
    public function __construct(EthereumRPC $ethereumRPC)
    {
        $this->client = $ethereumRPC;
    }

    /**
     * @return int
     * @throws Exception\ConnectionException
     * @throws GethException
     * @throws \HttpClient\Exception\HttpClientException
     */
    public function blockNumber(): int
    {
        $request = $this->client->jsonRPC("eth_blockNumber");
        $blockNumber = $request->get("result");
        if (!is_string($blockNumber) || !preg_match('/^(0x)?[a-f0-9]{2,}$/', $blockNumber)) {
            throw GethException::unexpectedResultType("eth_blockNumber", "hexadec", gettype($blockNumber));
        }

        return hexdec($blockNumber);
    }


    /**
     * @return array
     * @throws Exception\ConnectionException
     * @throws GethException
     * @throws \HttpClient\Exception\HttpClientException
     */
    public function accounts(): array
    {
        $request = $this->client->jsonRPC("eth_accounts");
        $list = $request->get("result");
        if (!is_array($list)) {
            throw GethException::unexpectedResultType("eth_accounts", "array", gettype($list));
        }

        return $list;
    }

    /**
     * Alias of accounts() method
     *
     * @return array
     * @throws Exception\ConnectionException
     * @throws GethException
     * @throws \HttpClient\Exception\HttpClientException
     */
    public function list(): array
    {
        return $this->accounts();
    }

    /**
     * @param string $txId
     * @return array
     * @throws Exception\ConnectionException
     * @throws GethException
     * @throws \HttpClient\Exception\HttpClientException
     */
    public function getTransaction(string $txId): array
    {
        $request = $this->client->jsonRPC("eth_getTransactionByHash", null, [$txId]);
        $transaction = $request->get("result");
        if (!is_array($transaction)) {
            throw GethException::unexpectedResultType("eth_getTransactionByHash", "array", gettype($transaction));
        }

        return $transaction;
    }
}