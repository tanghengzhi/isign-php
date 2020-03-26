<?php


namespace MingYuanYun\AppStore\Api;


class BundleId extends AbstractApi
{
    public function all(array $params = [])
    {
        return $this->get('/bundleIds', $params);
    }

    public function register($name, $platform, $bundleId)
    {
        $data = [
            'data' => [
                'type' => 'bundleIds',
                'attributes' => [
                    'identifier' => $bundleId,
                    'name' => $name,
                    'platform' => $platform
                ]
            ]
        ];
        return $this->postJson('/bundleIds', $data);
    }

    public function drop($bId)
    {
        return $this->delete('/bundleIds/' . $bId);
    }

    public function query($bId, array $params = [])
    {
        return $this->get("/bundleIds/{$bId}/bundleIdCapabilities", $params);
    }
}