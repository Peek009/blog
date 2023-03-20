<?php

declare(strict_types=1);

class Post extends Model
{
    protected $table = 'post';

    public function __construct(int $id, string $name, string $text)
    {
        $this->id = $id;
        $this->name = $name;
        $this->text = $text;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['name']))
        {
            $this->errors['name'] = 'name is required';
        }

        if (empty($data['textarea']))
        {
            $this->errors['textarea'] = 'text is required';
        }

        return empty($this->errors);
    }
}