<?php


namespace MingYuanYun\AppStore\Api;


class Device extends AbstractApi
{
    public function all(array $params = [])
    {
        return $this->get('/devices', $params);
    }

    public function register($name, $platform, $udid)
    {
        $data = [
            'data' => [
                'type' => 'devices',
                'attributes' => [
                    'name' => $name,
                    'platform' => strtoupper($platform),
                    'udid' => $udid,
                ]
            ]
        ];
        return $this->postJson('/devices', $data);
    }
}