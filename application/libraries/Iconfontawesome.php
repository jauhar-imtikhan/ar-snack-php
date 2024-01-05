<?php


class Iconfontawesome
{
    protected $ci;

    public function __construct()
    {

        $this->ci = &get_instance();
    }

    public static function getIcon(string $keyword): array
    {

        $data = file_get_contents(__DIR__ . '/fontawesome.json');
        $results = array_filter(json_decode($data, true), function ($icon) use ($keyword) {
            return stripos($icon, $keyword) !== false;
        });

        if ($results > 0) {
            return $results;
        } else {
            return array(
                'message' => 'Icon not found',
            );
        }
    }
}
