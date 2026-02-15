<?php

declare(strict_types=1);

namespace Yethee\Tiktoken\Tests\Benchmark;

use RuntimeException;
use Yethee\Tiktoken\Encoder;
use Yethee\Tiktoken\EncoderProvider;

use function dirname;
use function sprintf;

/** @psalm-api */
final class LibEncoderBench extends EncoderBench
{
    protected function getEncoder(string $encoding): Encoder
    {
        Encoder\LibEncoder::init(dirname(__DIR__, 2) . '/target/release');
        $provider = new EncoderProvider(true);
        $provider->setVocabCache(dirname(__DIR__, 2) . '/.cache/vocab');
        $encoder = $provider->get($encoding);
        if (! $encoder instanceof Encoder\LibEncoder) {
            throw new RuntimeException(sprintf(
                'Was expected an instance of %s but got %s.',
                Encoder\LibEncoder::class,
                get_class($encoder),
            ));
        }
        return $encoder;
    }
}
