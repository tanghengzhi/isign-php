<?php


namespace MingYuanYun\AppStore\Utils;


use MingYuanYun\AppStore\Exceptions\RuntimeException;

class JWT
{
    private $header;

    private $payload;

    private $secret;

    public function __construct(array $payload, array $header, string $secret)
    {
        $this->payload = json_encode($payload);
        $this->header = json_encode($header);
        $this->secret = $secret;
    }

    public static function encode(array $payload, array $header, string $secret)
    {
        $jwt = new JWT($payload, $header, $secret);
        return $jwt->create();
    }

    public function create()
    {
        $header = $this->prepare($this->header);

        $claims = $this->prepare($this->payload);

        $signature = $this->prepare(
            $this->sign("$header.$claims")
        );

        return $header . '.' . $claims . '.' . $signature;
    }

    protected function sign($data)
    {
        if (!openssl_sign($data, $signature, $this->secret, OPENSSL_ALGO_SHA256)) {
            throw new RuntimeException('openssl加密失败');
        }

        return static::fromDER($signature, 64);
    }

    private function prepare($data)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }

    private static function fromDER(string $der, int $partLength): string
    {
        $hex = \unpack('H*', $der)[1];
        if ('30' !== \mb_substr($hex, 0, 2, '8bit')) { // SEQUENCE
            throw new RuntimeException();
        }
        if ('81' === \mb_substr($hex, 2, 2, '8bit')) { // LENGTH > 128
            $hex = \mb_substr($hex, 6, null, '8bit');
        } else {
            $hex = \mb_substr($hex, 4, null, '8bit');
        }
        if ('02' !== \mb_substr($hex, 0, 2, '8bit')) { // INTEGER
            throw new RuntimeException();
        }
        $Rl = \hexdec(\mb_substr($hex, 2, 2, '8bit'));
        $R = static::retrievePositiveInteger(\mb_substr($hex, 4, $Rl * 2, '8bit'));
        $R = \str_pad($R, $partLength, '0', STR_PAD_LEFT);
        $hex = \mb_substr($hex, 4 + $Rl * 2, null, '8bit');
        if ('02' !== \mb_substr($hex, 0, 2, '8bit')) { // INTEGER
            throw new RuntimeException();
        }
        $Sl = \hexdec(\mb_substr($hex, 2, 2, '8bit'));
        $S = static::retrievePositiveInteger(\mb_substr($hex, 4, $Sl * 2, '8bit'));
        $S = \str_pad($S, $partLength, '0', STR_PAD_LEFT);
        return \pack('H*', $R.$S);
    }

    private static function retrievePositiveInteger(string $data): string
    {
        while ('00' === \mb_substr($data, 0, 2, '8bit') && \mb_substr($data, 2, 2, '8bit') > '7f') {
            $data = \mb_substr($data, 2, null, '8bit');
        }
        return $data;
    }
}