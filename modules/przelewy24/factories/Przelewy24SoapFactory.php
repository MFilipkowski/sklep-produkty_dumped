<?php
/**
 * Class Przelewy24SoapFactory
 *
 * @author Przelewy24
 * @copyright Przelewy24
 * @license https://www.gnu.org/licenses/gpl.html
 *
 */

/**
 * One of factories for Przelewy24 plugin.
 *
 * The class is aware of the whole configuration.
 *
 */
class Przelewy24SoapFactory
{
    /**
     * Create instance of Przelewy24Soap.
     *
     * @param string $suffix Money suffix.
     * @return Przelewy24Soap
     * @throws Exception
     */
    public static function buildForSuffix($suffix)
    {
        $merchantId = (int)Configuration::get('P24_MERCHANT_ID' . $suffix);
        $posId = (int)Configuration::get('P24_SHOP_ID' . $suffix);
        $salt = Configuration::get('P24_SALT' . $suffix);
        $testMode = (bool)Configuration::get('P24_TEST_MODE' . $suffix);

        return self::buildFromParams($merchantId, $posId, $salt, $testMode);
    }

    /**
     * Create instance of Przelewy24Soap.
     *
     * @param int $merchantId
     * @param int $posId
     * @param string $salt
     * @param bool $testMode
     * @return Przelewy24Soap
     * @throws SoapFault
     * @throws Exception
     */
    public static function buildFromParams($merchantId, $posId, $salt, $testMode)
    {
        $merchantId = (int)$merchantId;
        $posId = (int)$posId;
        $salt = (string)$salt;
        $testMode = (bool)$testMode;
        $p24Class = Przelewy24ClassFactory::buildFromParams($merchantId, $posId, $salt, $testMode);

        return new Przelewy24Soap($p24Class, $merchantId, $posId, $salt, $testMode);
    }
}
