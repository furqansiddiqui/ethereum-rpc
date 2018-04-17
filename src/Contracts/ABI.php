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

use EthereumRPC\Contracts\ABI\Method;
use EthereumRPC\Exception\ContractABIException;

/**
 * Class ABI
 * https://github.com/ethereum/wiki/wiki/Ethereum-Contract-ABI
 * @package EthereumRPC\Contracts
 */
class ABI
{
    /** @var null|Method */
    private $constructor;
    /** @var null|Method */
    private $fallback;
    /** @var array */
    private $functions;
    /** @var array */
    private $events;

    /**
     * ABI constructor.
     * @param array $abi
     */
    public function __construct(array $abi)
    {
        $this->functions = [];
        $this->events = [];

        $index = 0;
        foreach ($abi as $block) {
            try {
                if (!is_array($block)) {
                    throw new ContractABIException(
                        sprintf('Unexpected data type "%s" at ABI array index %d, expecting Array', gettype($block), $index)
                    );
                }

                $type = $block["type"] ?? null;
                switch ($type) {
                    case "constructor":
                    case "function":
                    case "fallback":
                        $method = new Method($block);
                        switch ($method->type) {
                            case "constructor":
                                $this->constructor = $method;
                                break;
                            case "function":
                                $this->functions[$method->name] = $method;
                                break;
                            case "fallback":
                                $this->fallback = $method;
                                break;
                        }
                        break;
                    case "event":
                        // Todo: parse events
                        break;
                    default:
                        throw new ContractABIException(
                            sprintf('Bad/Unexpected value for ABI block param "type" at index %d', $index)
                        );
                }
            } catch (ContractABIException $e) {
                // Trigger an error instead of throwing exception if a block within ABI fails,
                // to make sure rest of ABI blocks will work
                trigger_error(sprintf('[%s] %s', get_class($e), $e->getMessage()));
            }

            $index++;
        }
    }
}