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

declare(strict_types=0);

namespace EthereumRPC;

/**
 * Class BcMath
 * @package EthereumRPC
 */
class BcMath
{
    /**
     * @param $hex
     * @return string
     */
    public static function HexDec($hex): string
    {
        if (strlen($hex) == 1) {
            return strval(hexdec($hex));
        } else {
            $remain = substr($hex, 0, -1);
            $last = substr($hex, -1);
            return bcadd(bcmul(16, self::HexDec($remain)), hexdec($last));
        }
    }

    /**
     * @param $dec
     * @return string
     */
    public static function DecHex($dec): string
    {
        $last = bcmod($dec, 16);
        $remain = bcdiv(bcsub($dec, $last), 16);

        if ($remain == 0) {
            return dechex($last);
        } else {
            return self::DecHex($remain) . dechex($last);
        }
    }
}