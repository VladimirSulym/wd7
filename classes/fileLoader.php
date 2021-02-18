<?php

class fileLoader
{
    const FILE_MAX_SIZE = 5242880;
    protected $availableTypes = [
        'image/jpeg',
        'image/gif',
        'image/png',
        'image/webp',
        'image/xml+svg'
    ];

    protected function validateFile()
    {
        if (((int) $_FILES['img']['size']) > self::FILE_MAX_SIZE) {
            throw new Exception('Too large size of file');
        }
        if (!in_array($_FILES['img']['type'], $this->availableTypes)) {
            throw new Exception('Wrong filetype');
        }
    }

    protected function getNewName()
    {
        $extension = explode('.', $_FILES['img']['name']);
        $extension = end($extension);
        return md5_file($_FILES['img']['tmp_name']) . '.' . $extension;
    }

    public function save($path)
    {
        try {
            $this->validateFile();
        } catch (Exception $e) {
            die($e->getMessage());
        }

        $arr = [
            'origin_name'   => $_FILES['img']['name'],
            'size'          => $_FILES['img']['size'],
            'type'          => $_FILES['img']['type'],
            'save_name'     => $this->getNewName()
        ];

        move_uploaded_file($_FILES['img']['tmp_name'], rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $arr['save_name']);

        return $arr;
    }
}
