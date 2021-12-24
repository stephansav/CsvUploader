<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @internal
 * @coversNothing
 */
class DumbTest extends WebTestCase
{
    //@return array
    /*
    public function dumbData()
    {
        return [
            'coucou hibou' => [__DIR__.'/csv/my-test-file.csv'],
        ];
    }

    //dataProvider dumbData
    public function testDumb(string $fileName)
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/question-stats/csv/upload',
            [],
            ['file' => new UploadedFile($fileName, 'file.csv')]
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    */

    /**
     * @return array
     */
    public function dataSuccess()
    {
        return [
            'test success' => [__DIR__.'/csv/my-test-file3.csv'],
        ];
    }

    /**
     * @return array
     */
    public function dataFail()
    {
        return [
            'test fail' => [__DIR__.'/csv/fichier.pdf'],
        ];
    }

    /**
     * @dataProvider dataSuccess
     */
    public function testUploadSuccess(string $fileName)
    {
        // For the test, we add a key which is file because it is usefull if we use a Postman like util
        $client = static::createClient();
        $result = $client->request(
            'POST',
            '/csv/upload',
            [],
            ['file' => new UploadedFile($fileName, 'file.csv')]
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @dataProvider dataFail
     */
    public function testUploadFail(string $fileName)
    {
        // For the test, we add a key which is file because it is usefull if we use a Postman like util
        $client = static::createClient();
        $result = $client->request(
            'POST',
            '/csv/upload',
            [],
            ['file' => new UploadedFile($fileName, 'file.pdf')]
        );

        $this->assertEquals(415, $client->getResponse()->getStatusCode());
    }
}
