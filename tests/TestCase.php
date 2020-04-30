<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function paginationStructure()
    {
        return [
            "to",
            "from",
            "total",
            "per_page",
            "last_page",
            "current_page",
            "last_page_url",
            "next_page_url",
            "prev_page_url",
            "first_page_url",
        ];
    }
}
