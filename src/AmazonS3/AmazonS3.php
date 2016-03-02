<?php

namespace AmazonS3;

use Aws\S3\S3Client;

/**
 * Description of AmazonS3
 *
 * @author andregavazzoni
 */
class AmazonS3
{   const DOMAIN_S3 = 's3.amazonaws.com';
    const TYPE_DIR = 'Directory';
    const TYPE_FILE = 'File';
    
    private $key;
    private $secret;
    private $s3Client;

    public function __construct()
    {
        $args = [
            'version' => 'latest',
            'region' => 'sa-east-1',
        ];

        if ($this->key && $this->secret) {
            $args['credentials'] = [
                'key' => $this->key,
                'secret' => $this->secret,
            ];
        }

        $this->s3Client = new S3Client($args);

    }

    public function listBuckets()
    {
        $buckets = $this->s3Client->listBuckets();

        return $buckets->search('Buckets[].Name');
    }

    public function listObjects($bucketName, $prefix)
    {
        $objects = $this->s3Client->listObjects([
            'Bucket' => $bucketName,
            'Delimiter' => '/',
            'Prefix' => $prefix
        ]);

        if ($objects->hasKey('CommonPrefixes')) {
            $expression = 'CommonPrefixes[].Prefix';
            $type = self::TYPE_DIR;
        } else {
            $expression = 'Contents[].Key';
            $type = self::TYPE_FILE;
        }

        $return = ['type' => $type, 'content' => $objects->search($expression)];

        return $return;
    }

    public function getBucketLocation($bucketName)
    {
        $location = $this->s3Client->getBucketLocation(['Bucket' => $bucketName]);

        return $location->search('LocationConstraint');
    }
}