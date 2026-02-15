<?php

declare(strict_types=1);

namespace Yethee\Tiktoken\Tests\Encoder;

use Yethee\Tiktoken\Encoder;
use Yethee\Tiktoken\Encoder\NativeEncoder;
use Yethee\Tiktoken\EncoderProvider;
use Yethee\Tiktoken\Vocab\Vocab;

use function dirname;
use function sprintf;

final class NativeEncoderTest extends EncoderTestCase
{
    protected function getEncoder(string $encoding): Encoder
    {
        return new NativeEncoder(
            $encoding,
            Vocab::fromFile(dirname(__DIR__) . '/Fixtures/' . $encoding . '.tiktoken'),
            sprintf('/%s/u', EncoderProvider::ENCODINGS[$encoding]['pat']),
        );
    }
}
