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

/**
 * Interface ERC20Interface
 * @package EthereumRPC\Contracts\ERC20
 */
interface ERC20Interface
{
    /**
     * ERC20 token's name
     * @return string
     */
    public function name(): string;

    /**
     * ERC20 token's symbol
     * @return string
     */
    public function symbol(): string;

    /**
     * ERC20 token's decimal/scale value
     * @return string
     */
    public function decimals(): string;

    /**
     * ERC20 token's total supply
     * @return int
     */
    public function totalSupply(): int;

    /**
     * ERC20 token balance of an address
     * @param string $address
     * @return int
     */
    public function balanceOf(string $address): int;

    /**
     * transfer ERC20 token
     * @param string $address
     * @param int $value
     * @return bool
     */
    public function transfer(string $address, int $value): bool;
}