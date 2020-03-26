<?php


namespace MingYuanYun\AppStore\Api;


class BundleIdCapability extends AbstractApi
{
    public function enable($bId, $capability)
    {
        $data = [
            'data' => [
                'type' => 'bundleIdCapabilities',
                'relationships' => [
                    'bundleId' => [
                        'data' => [
                            'type' => 'bundleIds',
                            'id' => $bId
                        ]
                    ],
                ],
                'attributes' => [
                    'capabilityType' => $capability
                ],
            ]
        ];

        return $this->postJson('/bundleIdCapabilities', $data);
    }

    public function disable($bcId)
    {
        return $this->delete('/bundleIdCapabilities/' . $bcId);
    }
}