<?php

namespace App\Controller;

use App\Entity\UploadedFile;
use App\Entity\WellBeingQuestion;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UploadController extends AbstractController
{
    /** @var ValidatorInterface */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @Route("/csv/upload", name="question_stats_upload")
     *
     * @throws \Throwable
     */
    public function readFile(Request $request, FileUploader $file_uploader): JsonResponse
    {
        $file = $request->files->get('file');

        //Validate the file which will be uploaded
        $uploadedFile = new UploadedFile($file);
        $errors = $this->validator->validate($uploadedFile);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new JsonResponse($errorsString, Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
        }

        $file_name = $file_uploader->upload($file);

        if (null !== $file_name) {
            // Path
            $directory = $file_uploader->getTargetDirectory();
            $full_path = $directory.'/'.$file_name;

            // Open the file
            $file = fopen($full_path, 'r');
            $fileread = fread($file, filesize($full_path));
            fclose($file);

            $rows = [];
            $rows = explode("\n", $fileread);

            $label = $this->extractLabelFromCSV($rows);
            $output = $this->parseAndFilterCSV($rows);

            $question = new WellBeingQuestion($label, $output);
            $result = $question->computeValues();

            return new JsonResponse($result, Response::HTTP_OK);
        }
    }

    private function parseAndFilterCSV(array $rows): array
    {
        return array_filter($rows, function ($value) {
            return preg_match('/^\\d+.\\d+$/', $value);
        });
    }

    private function extractLabelFromCSV(array $rows): string
    {
        return !empty($rows[0]) ? $rows[0] : 'There is no question';
    }
}
