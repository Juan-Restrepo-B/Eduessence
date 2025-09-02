<?php
require __DIR__ . '/../../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$s3Client = new S3Client([
    'version' => 'latest',
    'region' => 'us-east-1', 
    'credentials' => [
        'key'    => '',
        'secret' => '',
    ],
]);

$bucketName = "";

function generarUrlFirmada($bucket, $key)
{
    return "https://{$bucket}.s3.amazonaws.com/{$key}";
}

function listarArchivos($s3Client, $bucketName, $prefix = "")
{
    try {
        $result = $s3Client->listObjectsV2([
            'Bucket' => $bucketName,
            'Prefix' => $prefix
        ]);

        $archivos = [];
        if (isset($result['Contents'])) {
            foreach ($result['Contents'] as $objeto) {
                $archivos[] = [
                    'key' => $objeto['Key'],
                    'url' => generarUrlFirmada($bucketName, $objeto['Key'])
                ];
            }
        }
        return $archivos;
    } catch (AwsException $e) {
        echo "Error al listar archivos: " . $e->getMessage();
        return [];
    }
}
?>